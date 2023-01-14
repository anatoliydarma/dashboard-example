<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Storage;
use Spatie\Backup\Events\BackupWasSuccessful;

class BackupIsDone
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Spatie\Backup\Events\BackupWasSuccessful $event
     * @return void
     */
    public function handle(BackupWasSuccessful $event)
    {
        $files = scandir(storage_path('app/backup'), SCANDIR_SORT_DESCENDING);
        $newest_file = $files[0];
        $filePath = storage_path('app/backup/') . $newest_file;
        $fileInfo = pathinfo($filePath);

        Storage::disk('google')->putFileAs('statue_ticketing', $filePath, $fileInfo['basename']);

        Storage::disk('local')->delete('backup/'. $newest_file);
    }
}
