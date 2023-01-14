<template>
	<Authenticated>
		<Head title="Users" />

		<PageTitle>Users</PageTitle>

		<div class="grid gap-4">
			<div class="flex items-center justify-between gap-4 pt-4">
				<div class="w-full max-w-sm">
					<BreezeInput
						type="search"
						placeholder="Search"
						v-model="search" />
				</div>

				<Link
					:href="route('admin.users.create')"
					class="flex items-center gap-2">
					<div
						class="hover:bg-indigo-600 p-3 text-white bg-indigo-500 rounded-lg">
						<i-tabler-plus class="w-6 h-6" />
					</div>
				</Link>
			</div>

			<div class="-mx-px -my-2 overflow-x-auto">
				<div class="inline-block min-w-full px-px py-2 align-middle">
					<div
						class="ring-1 ring-black ring-opacity-5 overflow-hidden rounded-lg shadow"
						v-if="users.data.length">
						<table class="divide-slate-300 min-w-full divide-y">
							<thead class="bg-slate-50">
								<tr
									class="text-slate-900 relative text-sm font-semibold text-left">
									<th class="py-3 pl-4 pr-3">Name</th>
									<th class="p-3">Email</th>
									<th class="p-3">Role</th>
									<th class="p-3">On</th>
									<th class="p-3">Purchaser</th>
									<th class="py-3 pl-3 pr-4"></th>
								</tr>
							</thead>
							<tbody class="divide-slate-200 bg-white divide-y">
								<tr
									v-for="(item, i) in users.data"
									:key="i"
									class="hover:bg-slate-100 group text-slate-500 text-sm transition duration-300 ease-in-out bg-white border-b">
									<td
										class="whitespace-nowrap py-3 pl-4 pr-3">
										{{ item.first_name }}
										{{ item.last_name }}
									</td>
									<td class="whitespace-nowrap p-3">
										{{ item.email }}
									</td>
									<td class="whitespace-nowrap p-3">
										<div v-for="(item_role, key) in roles">
											<span v-if="item.role === key">{{
												item_role
											}}</span>
										</div>
									</td>
									<td class="p-3 text-center">
										<div
											class="w-2 h-2 rounded-full"
											:class="{
												'bg-green-500': item.is_on,
												'bg-red-500': !item.is_on
											}"></div>
									</td>
									<td class="p-3 text-center">
										<div
											class="w-2 h-2 rounded-full"
											:class="{
												'bg-green-500': item.purchaser,
												'bg-red-500': !item.purchaser
											}"></div>
									</td>
									<td
										class="whitespace-nowrap py-3 pl-3 pr-4">
										<div
											class="group-hover:visible flex items-center justify-end invisible gap-4">
											<Link
												class="focus:outline-none focus:shadow-outline-gray hover flex items-center justify-between text-sm font-medium leading-5 text-indigo-600 rounded-lg"
												:href="
													route(
														'admin.users.edit',
														item.id
													)
												">
												<i-tabler-pencil />
											</Link>
											<button
												@click="onDelete(item)"
												class="focus:outline-none focus:shadow-outline-gray hover flex items-center justify-between text-sm font-medium leading-5 text-indigo-600 rounded-lg"
												aria-label="Delete">
												<i-tabler-trash />
											</button>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
						<Pagination :items="users" />
					</div>
					<div v-else>No users found</div>
				</div>
			</div>
		</div>

		<ModalConfirm
			:submit="onSubmit"
			ref="deleteModal"
			size="md" />
	</Authenticated>
</template>

<script setup>
	import Pagination from '@/Components/Pagination.vue';
	import { Inertia } from '@inertiajs/inertia';
	import BreezeInput from '@/Components/Input.vue';
	import ModalConfirm from '@/Components/ModalConfirm.vue';

	const props = defineProps({
		users: Object,
		filters: Object,
		roles: Object
	});

	let itemToDelete = ref(null);
	const deleteModal = ref();

	let search = ref(props.filters.search);
	let searchDebounced = refDebounced(search, 600);

	const onDelete = function (item) {
		itemToDelete = item.id;
		deleteModal.value.open = !deleteModal.value.open;
	};

	const onSubmit = function () {
		Inertia.delete(route('admin.users.destroy', itemToDelete), {
			preserveScroll: true
		});
		deleteModal.value.open = false;
	};

	watch(searchDebounced, (value) => {
		let params = { search: value };
		if (!value) params = {};

		Inertia.get(route('admin.users.index'), params, {
			preserveState: true,
			replace: true
		});
	});
</script>
