<template>
	<notifications position="bottom left" />
	<div>
		<div class="bg-slate-100 min-h-screen">
			<nav
				:class="
					$page.props.app.env !== 'production'
						? 'bg-slate-200'
						: 'bg-white'
				"
				class="shadow">
				<div class="sm:px-6 lg:px-8 max-w-screen-xl px-4 mx-auto">
					<div class="flex justify-between h-16">
						<div class="flex">
							<div class="shrink-0 flex items-center pl-4">
								<Link :href="route('one.day.view')">
									<BreezeApplicationLogo
										class="h-9 block w-auto" />
								</Link>
							</div>

							<div
								class="md:-my-px md:ml-8 md:flex hidden space-x-8">
								<BreezeNavLink
									:href="route('one.day.view')"
									:active="route().current('one.day.view')">
									One day view
								</BreezeNavLink>
								<BreezeNavLink
									:href="route('date-range-view')"
									:active="
										route().current('date-range-view')
									">
									Date range view
								</BreezeNavLink>
								<BreezeNavLink
									:href="route('manifest.index')"
									:active="route().current('manifest.index')">
									Manifest
								</BreezeNavLink>
								<BreezeNavLink
									:href="route('metrics')"
									:active="route().current('metrics')">
									Metrics
								</BreezeNavLink>
								<BreezeNavLink
									v-if="
										$page.props.auth.user.permission.manager
									"
									:href="route('growth')"
									:active="route().current('growth')">
									Growth
								</BreezeNavLink>
							</div>
						</div>

						<div class="md:flex md:items-center sm:ml-6 hidden">
							<!-- Settings Dropdown -->
							<div class="relative ml-3">
								<BreezeDropdown
									align="right"
									width="48">
									<template #trigger>
										<span class="inline-flex rounded-md">
											<button
												type="button"
												class="hover:text-slate-700 focus:outline-none text-slate-500 inline-flex items-center px-3 py-2 text-sm font-medium leading-4 transition duration-150 ease-in-out bg-white border border-transparent rounded-md">
												{{
													$page.props.auth.user
														.full_name
												}}
												<svg
													class="ml-2 -mr-0.5 h-4 w-4"
													xmlns="http://www.w3.org/2000/svg"
													viewBox="0 0 20 20"
													fill="currentColor">
													<path
														fill-rule="evenodd"
														d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
														clip-rule="evenodd" />
												</svg>
											</button>
										</span>
									</template>

									<template #content>
										<BreezeDropdownLink
											v-if="
												$page.props.auth.user.permission
													.admin
											"
											:href="route('admin.users.index')"
											:active="
												route().current(
													'admin.users.index'
												)
											"
											as="button"
											class="flex items-center gap-2">
											<i-tabler-users />
											Users
										</BreezeDropdownLink>
										<BreezeDropdownLink
											:href="route('concierges.index')"
											:active="
												route().current(
													'concierges.index'
												)
											"
											as="button"
											class="flex items-center gap-2">
											<i-tabler-friends />
											Tour concierges
										</BreezeDropdownLink>
										<BreezeDropdownLink
											v-if="
												$page.props.auth.user.permission
													.admin
											"
											:href="
												route(
													'admin.activity-logs.index'
												)
											"
											:active="
												route().current(
													'admin.activity-logs.index'
												)
											"
											as="button"
											class="flex items-center gap-2">
											<i-tabler-file-analytics />
											Activity logs
										</BreezeDropdownLink>
										<BreezeDropdownLink
											v-if="
												$page.props.auth.user.permission
													.admin
											"
											href="/log-viewer"
											active="'/log-viewer'"
											as="button"
											class="flex items-center gap-2">
											<i-tabler-file-analytics />

											App logs
										</BreezeDropdownLink>
										<BreezeDropdownLink
											v-if="
												$page.props.auth.user.permission
													.admin
											"
											:href="
												route('admin.settings.index')
											"
											:active="
												route().current(
													'admin.settings.index'
												)
											"
											as="button"
											class="flex items-center gap-2">
											<i-tabler-settings />
											Settings
										</BreezeDropdownLink>
										<BreezeDropdownLink
											:href="route('profile.edit')"
											as="button"
											class="flex items-center gap-2">
											<i-tabler-user />
											Profile
										</BreezeDropdownLink>
										<BreezeDropdownLink
											:href="route('logout')"
											method="post"
											as="button"
											class="flex items-center gap-2">
											<i-tabler-logout />
											Log Out
										</BreezeDropdownLink>
									</template>
								</BreezeDropdown>
							</div>
						</div>

						<!-- Hamburger -->
						<div class="md:hidden flex items-center -mr-2">
							<button
								@click="showMobMenu = !showMobMenu"
								class="hover:text-slate-500 hover:bg-slate-100 focus:outline-none focus:bg-slate-100 focus:text-slate-500 text-slate-400 inline-flex items-center justify-center p-2 transition duration-150 ease-in-out rounded-md">
								<svg
									class="w-6 h-6"
									stroke="currentColor"
									fill="none"
									viewBox="0 0 24 24">
									<path
										:class="{
											'hidden': showMobMenu,
											'inline-flex': !showMobMenu
										}"
										stroke-linecap="round"
										stroke-linejoin="round"
										stroke-width="2"
										d="M4 6h16M4 12h16M4 18h16" />
									<path
										:class="{
											'hidden': !showMobMenu,
											'inline-flex': showMobMenu
										}"
										stroke-linecap="round"
										stroke-linejoin="round"
										stroke-width="2"
										d="M6 18L18 6M6 6l12 12" />
								</svg>
							</button>
						</div>
					</div>
				</div>

				<!-- Responsive Navigation Menu -->

				<div>
					<TransitionRoot
						as="template"
						:show="showMobMenu">
						<Dialog
							as="div"
							class="md:hidden relative z-40"
							@close="showMobMenu = false">
							<TransitionChild
								as="template"
								enter="transition-opacity ease-linear duration-300"
								enter-from="opacity-0"
								enter-to="opacity-100"
								leave="transition-opacity ease-linear duration-300"
								leave-from="opacity-100"
								leave-to="opacity-0">
								<div
									class="bg-slate-600 fixed inset-0 bg-opacity-75" />
							</TransitionChild>

							<div class="fixed inset-0 z-40 flex">
								<TransitionChild
									as="template"
									enter="transition ease-in-out duration-300 transform"
									enter-from="-translate-x-full"
									enter-to="translate-x-0"
									leave="transition ease-in-out duration-300 transform"
									leave-from="translate-x-0"
									leave-to="-translate-x-full">
									<DialogPanel
										class="relative flex flex-col flex-1 w-full max-w-xs pt-5 pb-4 bg-white">
										<TransitionChild
											as="template"
											enter="ease-in-out duration-300"
											enter-from="opacity-0"
											enter-to="opacity-100"
											leave="ease-in-out duration-300"
											leave-from="opacity-100"
											leave-to="opacity-0">
											<div
												class="absolute top-0 right-0 pt-2 -mr-12">
												<button
													type="button"
													class="flex items-center justify-center w-10 h-10 ml-1"
													@click="
														showMobMenu = false
													">
													<span class="sr-only"
														>Close sidebar</span
													>
													<i-tabler-circle-x
														class="w-6 h-6 text-white" />
												</button>
											</div>
										</TransitionChild>
										<div
											class="flex items-center flex-shrink-0 px-6">
											<Link
												:href="route('one.day.view')"
												class="flex items-center gap-4">
												<BreezeApplicationLogo
													class="h-9 block w-auto" />

												<span class="text-gray-500">{{
													$page.props.app.name
												}}</span>
											</Link>
										</div>
										<div
											class="flex-1 h-0 mt-5 overflow-y-auto">
											<nav
												class="px-2 space-y-1"
												aria-label="nav">
												<BreezeResponsiveNavLink
													:href="
														route('one.day.view')
													"
													:active="
														route().current(
															'one.day.view'
														)
													"
													@click="
														showMobMenu = false
													">
													One day view
												</BreezeResponsiveNavLink>

												<BreezeResponsiveNavLink
													:href="
														route('date-range-view')
													"
													:active="
														route().current(
															'date-range-view'
														)
													"
													@click="
														showMobMenu = false
													">
													Date range view
												</BreezeResponsiveNavLink>

												<BreezeResponsiveNavLink
													:href="
														route('manifest.index')
													"
													:active="
														route().current(
															'manifest.index'
														)
													"
													@click="
														showMobMenu = false
													">
													Manifest
												</BreezeResponsiveNavLink>

												<BreezeResponsiveNavLink
													:href="route('metrics')"
													:active="
														route().current(
															'metrics'
														)
													"
													@click="
														showMobMenu = false
													">
													Metrics
												</BreezeResponsiveNavLink>
												<BreezeResponsiveNavLink
													v-if="
														$page.props.auth.user
															.permission.manager
													"
													:href="route('growth')"
													:active="
														route().current(
															'growth'
														)
													">
													Growth
												</BreezeResponsiveNavLink>

												<hr />

												<BreezeResponsiveNavLink
													v-if="
														$page.props.auth.user
															.permission.admin
													"
													:href="
														route(
															'admin.users.index'
														)
													"
													:active="
														route().current(
															'admin.users.index'
														)
													"
													@click="showMobMenu = false"
													class="flex gap-2">
													<i-tabler-users />
													Users
												</BreezeResponsiveNavLink>

												<BreezeResponsiveNavLink
													:href="
														route(
															'concierges.index'
														)
													"
													:active="
														route().current(
															'concierges.index'
														)
													"
													as="button"
													class="flex items-center gap-2">
													<i-tabler-friends />
													Tour concierges
												</BreezeResponsiveNavLink>
												<BreezeResponsiveNavLink
													v-if="
														$page.props.auth.user
															.permission.admin
													"
													:href="
														route(
															'admin.activity-logs.index'
														)
													"
													:active="
														route().current(
															'admin.activity-logs.index'
														)
													"
													@click="showMobMenu = false"
													class="flex gap-2">
													<i-tabler-file-analytics />
													Activity logs
												</BreezeResponsiveNavLink>

												<BreezeResponsiveNavLink
													v-if="
														$page.props.auth.user
															.permission.admin
													"
													href="/log-viewer"
													:active="null"
													as="button"
													class="flex gap-2">
													<i-tabler-file-analytics />
													App logs
												</BreezeResponsiveNavLink>

												<BreezeResponsiveNavLink
													v-if="
														$page.props.auth.user
															.permission.admin
													"
													:href="
														route(
															'admin.settings.index'
														)
													"
													:active="
														route().current(
															'admin.settings.index'
														)
													"
													@click="showMobMenu = false"
													class="flex gap-2">
													<i-tabler-settings />
													Settings
												</BreezeResponsiveNavLink>

												<hr />

												<BreezeResponsiveNavLink
													:href="
														route('profile.edit')
													"
													class="flex gap-2"
													@click="
														showMobMenu = false
													">
													<i-tabler-user />
													{{
														$page.props.auth.user
															.email
													}}
												</BreezeResponsiveNavLink>

												<BreezeResponsiveNavLink
													:href="route('logout')"
													method="post"
													class="flex gap-2"
													as="button">
													<i-tabler-logout />Log Out
												</BreezeResponsiveNavLink>
											</nav>
										</div>
									</DialogPanel>
								</TransitionChild>
								<div
									class="w-14 flex-shrink-0"
									aria-hidden="true"></div>
							</div>
						</Dialog>
					</TransitionRoot>
				</div>
			</nav>

			<!-- Page Heading -->
			<header
				class="bg-white shadow"
				v-if="$slots.header">
				<div class="max-w-7xl px-4 py-6 mx-auto">
					<slot name="header" />
				</div>
			</header>

			<!-- Page Content -->
			<main>
				<div class="py-6">
					<div class="max-w-screen-xl px-4 mx-auto">
						<slot />
					</div>
				</div>
			</main>
		</div>
	</div>
	<GoTop />
</template>
<script setup>
	import { watch, ref } from 'vue';
	import GoTop from '@/Components/GoTop.vue';
	import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
	import BreezeDropdown from '@/Components/Dropdown.vue';
	import BreezeDropdownLink from '@/Components/DropdownLink.vue';
	import BreezeNavLink from '@/Components/NavLink.vue';
	import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
	import { Link } from '@inertiajs/inertia-vue3';
	import { notify } from '@kyvg/vue3-notification';
	import { usePage } from '@inertiajs/inertia-vue3';
	import {
		Dialog,
		DialogPanel,
		TransitionChild,
		TransitionRoot
	} from '@headlessui/vue';

	const showMobMenu = ref(false);

	const flash = computed(() => usePage().props.value.flash);

	watch(flash, (newVal) => {
		if (newVal) {
			for (const [key, value] of Object.entries(newVal)) {
				if (value !== null) {
					notify({
						title: value,
						type: key
					});
				}
			}
		}
	});
</script>
