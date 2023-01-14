<template>
	<Authenticated>
		<Head title="User" />
		<div class="mt-5">
			<div class="lg:grid-cols-12 grid gap-6">
				<aside class="lg:col-span-3">
					<div class="space-y-1">
						<Link
							v-if="$page.props.auth.user.permission.admin"
							:href="route('admin.users.index')"
							class="hover:text-indigo-600 flex gap-1 mb-4">
							<i-tabler-chevron-left />
							Users
						</Link>
						<h3
							class="text-slate-900 text-lg font-medium leading-6">
							{{ $props.action ? 'Profile' : 'User' }} Information
						</h3>
						<p class="text-slate-600 text-sm">
							You can update
							{{
								$props.action
									? 'your profile'
									: 'user information'
							}}
							in this section.
						</p>
					</div>
				</aside>
				<div class="sm:px-6 lg:px-0 lg:col-span-9 space-y-6">
					<section>
						<form @submit.prevent="submit">
							<div class="overflow-hidden rounded-lg shadow">
								<div class="sm:p-6 px-4 py-6 bg-white">
									<div class="grid grid-cols-6 gap-6">
										<div class="sm:col-span-3 col-span-6">
											<InputBase
												v-model="form.first_name"
												:error="errors.first_name"
												label="First Name" />
										</div>

										<div class="sm:col-span-3 col-span-6">
											<InputBase
												v-model="form.last_name"
												:error="errors.last_name"
												label="Last Name" />
										</div>

										<div class="sm:col-span-3 col-span-6">
											<InputBase
												v-model="form.email"
												:error="errors.email"
												label="Email"
												type="email" />
										</div>

										<div class="sm:col-span-3 col-span-6">
											<InputBase
												v-model="form.password"
												:error="errors.password"
												label="Password"
												type="password" />
										</div>

										<div
											class="flex items-start justify-start col-span-6 gap-6">
											<Select
												title="Only admin can change it"
												:disabled="
													!$page.props.auth.user
														.permission.admin
												"
												:error="errors.role"
												label="Role"
												v-model="form.role">
												<option
													v-for="(role, key) in roles"
													:key="key"
													:value="key">
													{{ role }}
												</option>
											</Select>

											<div
												class="space-y-3"
												title="Only admin can change it">
												<div
													class="text-slate-700 block text-sm font-medium">
													Purchaser
												</div>
												<Toggle
													:disabled="
														!$page.props.auth.user
															.permission.admin
													"
													name="purchaser"
													v-model="form.purchaser" />
											</div>
										</div>
									</div>
								</div>
								<div
									class="bg-slate-50 sm:px-6 flex items-center justify-between px-4 py-3 text-right">
									<div>
										<Toggle
											v-if="
												$page.props.auth.user.permission
													.admin
											"
											label="User On"
											name="is_on"
											v-model="form.is_on" />
									</div>

									<BreezeButton
										:class="{
											'opacity-25': form.processing
										}"
										:disabled="form.processing">
										Save
									</BreezeButton>
								</div>
							</div>
						</form>
					</section>
				</div>
			</div>
		</div>
	</Authenticated>
</template>

<script>
	import { Link } from '@inertiajs/inertia-vue3';
	import BreezeButton from '@/Components/Button.vue';
	import BreezeInput from '@/Components/Input.vue';
	import Select from '@/Components/Select.vue';
	import BreezeLabel from '@/Components/Label.vue';
	import BreezeCheckbox from '@/Components/Checkbox.vue';
	import Toggle from '@/Components/Toggle.vue';
	import { useForm } from '@inertiajs/inertia-vue3';
	import InputBase from '@/Components/InputBase.vue';

	export default {
		props: {
			user: Object,
			errors: Object,
			action: String,
			roles: Object
		},
		data: function () {
			return {
				form: useForm({
					first_name: this.$props.user.first_name,
					last_name: this.$props.user.last_name,
					email: this.$props.user.email,
					password: null,
					password_confirmation: null,
					role: this.$props.user.role,
					is_on: this.$props.user.is_on,
					purchaser: this.$props.user.purchaser
				})
			};
		},
		components: {
			BreezeLabel,
			BreezeInput,
			BreezeCheckbox,
			BreezeButton,
			InputBase,
			Toggle,
			Select
		},
		methods: {
			submit: function () {
				if (this.$props.action) {
					this.form.post(this.$props.action);
				} else if (this.$props.user.id) {
					this.form.put(
						route('admin.users.update', this.$props.user.id)
					);
				} else {
					this.form.post(route('admin.users.store'));
				}
			}
		}
	};
</script>
