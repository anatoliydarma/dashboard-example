<template>
	<Authenticated>
		<Head title="Settings" />

		<div class="space-y-6">
			<div
				class="lg:flex-row rounded-xl flex flex-col justify-start gap-4 p-4 bg-white">
				<Button
					@click="cleanCache()"
					:disabled="loading"
					class="text-sm">
					<i-tabler-loader
						v-if="loading"
						class="animate-spin w-5 h-5 mr-2" />
					Clean cache
				</Button>

				<Button
					v-if="$page.props.app.env !== 'production'"
					@click="getDataFromProd"
					:disabled="loading"
					class="text-sm">
					<i-tabler-loader
						v-if="loading"
						class="animate-spin w-5 h-5 mr-2" />
					Sync DB from Prod
				</Button>
			</div>

			<div class="lg:flex-row flex flex-col justify-between gap-4">
				<div class="lg:w-6/12 w-full">
					<Table
						:items="products"
						:fields="productsIds"
						no-pagination
						inline-editable
						@addRow="addRecord($event, 'products')"
						@updateRow="updateRecord($event, 'products')"
						@deleteRow="onDelete($event, 'products')">
						<template #heading>
							<h1 class="text-xl font-semibold">Products</h1>
						</template>

						<template #inputs-key="{ field, item, editableItem }">
							<InputBase v-model="editableItem[field.key]" />
						</template>
					</Table>
				</div>

				<div class="lg:w-6/12 w-full">
					<Table
						:items="product_options"
						:fields="productOptionsIds"
						no-pagination
						inline-editable
						@addRow="addRecord($event, 'product_options')"
						@updateRow="updateRecord($event, 'product_options')"
						@deleteRow="onDelete($event, 'product_options')">
						<template #heading>
							<h1 class="text-xl font-semibold">
								Product options id
							</h1>
						</template>

						<template #inputs-key="{ field, item, editableItem }">
							<InputBase v-model="editableItem[field.key]" />
						</template>
					</Table>
				</div>
			</div>
		</div>

		<Modal
			:submit="deleteRecord"
			ref="deleteModal" />
	</Authenticated>
</template>

<script setup>
	import Table from '@/Components/Table.vue';
	import InputBase from '@/Components/InputBase.vue';
	import Modal from '@/Components/Modal.vue';
	import Button from '@/Components/Button.vue';
	import { Inertia } from '@inertiajs/inertia';

	const props = defineProps({
		products: Object,
		product_options: Object
	});

	let loading = ref(false);

	const productsIds = [
		{
			key: 'key',
			label: 'Product id'
		}
	];

	const productOptionsIds = [
		{
			key: 'key',
			label: 'Option id'
		}
	];

	const updateRecord = ($event, group) => {
		Inertia.put(
			route('admin.settings.tickets.update', {
				group: group,
				key: $event.oldRecord.key,
				item: $event.newRecord
			}),
			{
				preserveScroll: true
			}
		);
	};

	const addRecord = ($event, group) => {
		Inertia.post(
			route('admin.settings.tickets.store', {
				group: group,
				item: $event.newRecord
			}),
			{
				preserveScroll: true
			}
		);
	};

	let itemToDelete = ref(null);
	const deleteModal = ref();
	const onDelete = function (item, group) {
		itemToDelete = {
			item,
			group
		};
		deleteModal.value.open = !deleteModal.value.open;
	};

	const deleteRecord = () => {
		Inertia.delete(route('admin.settings.tickets.destroy', itemToDelete), {
			preserveScroll: true
		});
		deleteModal.value.open = false;
	};

	const cleanCache = () => {
		loading.value = true;

		Inertia.post(
			route('admin.clean.cache'),
			{},
			{
				onSuccess: () => {
					loading.value = false;
				}
			}
		);
	};

	const getDataFromProd = () => {
		loading.value = true;

		Inertia.post(
			route('admin.settings.sync'),
			{},
			{
				onSuccess: () => {
					loading.value = false;
				}
			}
		);
	};
</script>
