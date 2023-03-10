@setup
require __DIR__.'/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);

try {
$dotenv->load();
$dotenv->required(['APP_NAME', 'DEPLOY_SERVER', 'DEPLOY_REPOSITORY', 'DEPLOY_PATH', 'LOG_SLACK_WEBHOOK_URL'])->notEmpty();
} catch ( Throwable $e ) {
echo $e->getMessage();
exit;
}

$env = isset($env) ? $env : "production";
$app = env('APP_NAME') . ' | ' . $env ?? 'app';
$php = env('DEPLOY_PHP_CMD') ?? 'php';
$composer = env('DEPLOY_COMPOSER_CMD') ?? 'composer';
$php_fpm = env('DEPLOY_PHP_FPM') ?? null;
$server = env('DEPLOY_SERVER') ?? null;
$repo = env('DEPLOY_REPOSITORY') ?? null;
$path = env('DEPLOY_PATH') ?? null;
$restartQueue = env('DEPLOY_RESTART_QUEUE') ?? false;
$slackWebhook = env('LOG_SLACK_WEBHOOK_URL') ?? null;

if ( substr($path, 0, 1) !== '/' ) throw new Throwable('Careful - your deployment path does not begin with /');

$date = ( new DateTime )->format('YmdHis');

if ($env === 'dev') {
$path = $path.'-dev';
}

$branch = isset($branch) ? $branch : "main";
$path = rtrim($path, '/');
$releases = $path.'/releases';
$release = $releases.'/'.$date;
@endsetup

@servers(['local' => '127.0.0.1', 'prod' => $server])

@task('init', ['on' => 'prod', 'confirm' => true])
if [ ! -d {{ $path }} ]; then
echo "directory {{ $path }} doesn't exist"
mkdir -p {{ $path }}
echo "directory created"
fi
if [ ! -d {{ $path }}/storage ]; then
cd {{ $path }}
git clone {{ $repo }} --branch={{ $branch }} --depth=1 -q {{ $release }}
echo "Repository cloned"
mv {{ $release }}/storage {{ $path }}/storage
ln -s {{ $path }}/storage {{ $release }}/storage
sudo chown -R www-data:www-data {{ $path }}/storage
echo "Storage directory set up"
cp {{ $release }}/.env.example {{ $path }}/.env
ln -s {{ $path }}/.env {{ $release }}/.env
echo "Environment file set up"
rm -rf {{ $release }}
echo "Deployment path initialised. Edit {{ $path }}/.env then run 'envoy run deploy'."
else
echo "Deployment path already initialised (storage directory exists)!"
fi
@endtask

@story('deploy')
deployment_start
deployment_links
deployment_composer
npm_install
npm_build
move_bundles_from_local
deployment_migrate
deployment_symlink
cache
deployment_reload
deployment_finish
deployment_cleanup
@endstory

@story('deploy_backend_only')
deployment_start
deployment_links
deployment_composer
move_bundles
deployment_migrate
deployment_symlink
cache
deployment_reload
deployment_finish
deployment_cleanup
@endstory

@story('rollback')
deployment_rollback
deployment_reload
@endstory

@task('deployment_start', ['on' => 'prod'])
cd {{ $path }}
echo "Deployment ({{ $date }}) started"
git clone {{ $repo }} --branch={{ $branch }} --depth=1 -q {{ $release }}
echo "Repository cloned"
@endtask

@task('deployment_links', ['on' => 'prod'])
cd {{ $path }}
rm -rf {{ $release }}/storage
ln -s {{ $path }}/storage {{ $release }}/storage
echo "Storage directories set up"
ln -s {{ $path }}/.env {{ $release }}/.env
echo "Environment file set up"
@endtask

@task('deployment_composer', ['on' => 'prod'])
echo "Installing composer dependencies..."
cd {{ $release }}
{{ $composer }} install --no-interaction --quiet --no-dev --prefer-dist --optimize-autoloader
@endtask

@task('deployment_migrate', ['on' => 'prod'])
{{ $php }} {{ $release }}/artisan migrate --env={{ $env }} --force --no-interaction
@endtask

@task('npm_install', ['on' => 'local'])
echo "NPM install"
npm install --silent --no-progress > /dev/null
@endtask

@task('npm_build', ['on' => 'local'])
echo "NPM run build"
npm run build
@endtask

@task('move_bundles_from_local', ['on' => 'local'])
echo "Move bundles to production server"
scp -qr public/build {{ $server }}:{{ $release }}/public
@endtask

@task('move_bundles', ['on' => 'prod'])
echo "Copy bundles to new release"
cp -R {{ $path }}/current/public/build {{ $release }}/public/
@endtask

@task('cache', ['on' => 'prod'])
{{ $php }} {{ $path }}/current/artisan optimize:clear --quiet
{{ $php }} {{ $path }}/current/artisan optimize --quiet
echo "Cache cleared and created"
@endtask

@task('deployment_symlink', ['on' => 'prod'])
ln -nfs {{ $release }} {{ $path }}/current
echo "Deployment [{{ $release }}] symlinked to [{{ $path }}/current]"
@endtask

@task('deployment_reload', ['on' => 'prod'])
#{{ $php }} {{ $path }}/current/artisan storage:link
@if ( $restartQueue === 'horizon' )
@elseif ( $restartQueue != false )
{{ $php }} {{ $path }}/current/artisan queue:restart --quiet
echo "Queue daemon restarted"
@endif
@if ( $php_fpm )
sudo -S service {{ $php_fpm }} reload
echo "PHP-FPM restarted"
@endif
@endtask

@task('deployment_finish', ['on' => 'prod'])
@if ( isset($down) && $down )
cd {{ $path }}/current
php artisan up
@endif
echo "Deployment ({{ $date }}) finished"
@endtask

@task('deployment_cleanup', ['on' => 'prod'])
cd {{ $releases }}
find . -maxdepth 1 -name "20*" | sort | head -n -4 | xargs rm -Rf
echo "Cleaned up old deployments"
@endtask

@task('deployment_option_cleanup', ['on' => 'prod'])
cd {{ $releases }}
@if ( isset($cleanup) && $cleanup )
find . -maxdepth 1 -name "20*" | sort | head -n -4 | xargs rm -Rf
echo "Cleaned up old deployments"
@endif
@endtask

@task('deployment_rollback', ['on' => 'prod'])
cd {{ $releases }}
ln -nfs {{ $releases }}/$(find . -maxdepth 1 -name "20*" | sort | tail -n 2 | head -n1) {{ $path }}/current
echo "Rolled back to $(find . -maxdepth 1 -name "20*" | sort | tail -n 2 | head -n1)"
@endtask

@success
@slack($slackWebhook, '#logger', 'Deploy SUCCESSFUL for ' . $app)
echo "Envoy deployment script finished.\r\n";
@endsuccess

@error
echo "Envoy deployment script got a error.\r\n";
@slack($slackWebhook, '#logger', 'Deploy ERROR for ' . $app)
@enderror
