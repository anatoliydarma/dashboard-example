<template>
	<Authenticated>
		<Head title="Tour Concierges" />

		<PageTitle>Tour Concierges</PageTitle>

		<div class="grid gap-4">
			<div class="flex items-center justify-between gap-4 pt-4">
				<div class="w-full max-w-sm">
					<Input
						type="search"
						placeholder="Search"
						v-model="search" />
				</div>

				<Button @click="create()">
					<i-tabler-plus class="w-6 h-6" />
				</Button>
			</div>

			<div class="-mx-px -my-2 overflow-x-auto">
				<div class="inline-block min-w-full px-px py-2 align-middle">
					<div
						class="ring-1 ring-black ring-opacity-5 overflow-hidden rounded-lg shadow"
						v-if="concierges.data.length">
						<table class="divide-slate-300 min-w-full divide-y">
							<thead class="bg-slate-50">
								<tr
									class="text-slate-900 relative text-sm font-semibold text-left">
									<th class="py-3 pl-4 pr-3">Initials</th>
									<th class="p-3">Name</th>
									<th class="p-3">Email</th>
									<th class="py-3 pl-3 pr-4"></th>
								</tr>
							</thead>
							<tbody class="divide-slate-200 bg-white divide-y">
								<tr
									v-for="(item, i) in concierges.data"
									:key="i"
									class="hover:bg-slate-100 group text-slate-500 text-sm transition duration-300 ease-in-out bg-white border-b">
									<td
										class="whitespace-nowrap py-3 pl-4 pr-3">
										{{ item.initials }}
									</td>
									<td class="whitespace-nowrap p-3">
										{{ item.name }}
									</td>
									<td class="whitespace-nowrap p-3">
										{{ item.email }}
									</td>
									<td
										class="whitespace-nowrap py-3 pl-3 pr-4">
										<div
											class="group-hover:visible flex items-center justify-end invisible gap-4">
											<button
												@click="edit(item)"
												class="hover text-indigo-600"
												aria-label="Edit">
												<i-tabler-pencil />
											</button>
											<button
												@click="onDelete(item)"
												class="hover text-indigo-600"
												aria-label="Delete">
												<i-tabler-trash />
											</button>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div v-else>No concierges found</div>
				</div>
			</div>
			<Pagination
				:items="concierges"
				v-if="concierges.data.length > 20" />
		</div>

		<ModalConfirm
			:submit="destroy"
			ref="deleteModal"
			size="md" />

		<Offcanvas v-model:open="openForm">
			<form
				@submit.prevent="submit"
				class="py-8">
				<div class="pb-3 text-lg font-semibold">Tour Concierge</div>
				<div class="flex flex-wrap items-start justify-start gap-4">
					<Input
						v-model="form.initials"
						:error="errors.initials"
						label="Initials" />

					<Input
						v-model="form.name"
						:error="errors.name"
						label="Name" />

					<Input
						v-model="form.email"
						:error="errors.email"
						label="Email" />

					<div class="mt-6">
						<Button :disabled="loading">
							<i-tabler-loader
								v-if="loading"
								class="animate-spin w-5 h-5 mr-2" />
							<span v-if="form.id === null">Create</span>
							<span v-else>Update</span>
						</Button>
					</div>
				</div>
			</form>
		</Offcanvas>
	</Authenticated>
</template>

<script setup>
	import Pagination from '@/Components/Pagination.vue';
	import { Inertia } from '@inertiajs/inertia';
	import Input from '@/Components/InputBase.vue';
	import ModalConfirm from '@/Components/ModalConfirm.vue';
	import Button from '@/Components/Button.vue';
	import Offcanvas from '@/Components/Offcanvas.vue';

	const props = defineProps({
		concierges: Object,
		filters: Object,
		errors: Object
	});

	let form = ref({
		id: null,
		initials: null,
		name: null,
		email: null
	});
	let loading = ref(false);
	let openForm = ref(false);
	let itemToDelete = ref(null);
	const deleteModal = ref();
	let search = ref(props.filters.search);
	let searchDebounced = refDebounced(search, 600);

	const create = function () {
		openForm.value = true;
		form.value = {
			id: null,
			initials: null,
			name: null,
			email: null
		};
	};

	const edit = function (item) {
		form.value = { ...item };
		openForm.value = true;
	};

	const submit = function () {
		loading.value = true;
		if (form.value.id) {
			Inertia.put(route('concierges.update', form.value.id), form.value, {
				preserveScroll: true,
				onSuccess: () => {
					openForm.value = false;
					loading.value = false;
				},
				onError: () => {
					loading.value = false;
				}
			});
		} else {
			Inertia.post(route('concierges.store'), form.value, {
				preserveScroll: true,
				onSuccess: () => {
					openForm.value = false;
					loading.value = false;
				},
				onError: () => {
					loading.value = false;
				}
			});
		}
	};

	const onDelete = function (item) {
		itemToDelete = item.id;
		deleteModal.value.open = !deleteModal.value.open;
	};

	const destroy = function () {
		Inertia.delete(route('concierges.destroy', itemToDelete), {
			preserveScroll: true
		});
		deleteModal.value.open = false;
	};

	watch(searchDebounced, (value) => {
		let params = { search: value };
		if (!value) params = {};

		Inertia.get(route('concierges.index'), params, {
			preserveState: true,
			replace: true
		});
	});
</script>
