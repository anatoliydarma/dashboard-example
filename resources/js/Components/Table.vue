<template>
	<div class="flex flex-col space-y-2">
		<div class="md:px-0 px-4">
			<slot name="heading"></slot>
		</div>
		<div class="-mx-px -my-2 overflow-x-auto">
			<div class="inline-block min-w-full px-px py-2 align-middle">
				<div
					class="ring-1 ring-black ring-opacity-5 rounded-lg overflow-hidden shadow">
					<table
						v-bind="$attrs"
						class="divide-slate-300 min-w-full divide-y">
						<thead class="bg-slate-50">
							<tr v-if="showFilter">
								<th
									:colspan="fields.length"
									scope="col"
									class="text-slate-900 whitespace-nowrap text-sm font-semibold border-b">
									<div
										class="flex items-center justify-center">
										<button
											class="focus:outline-none focus:shadow-outline-gray flex items-center justify-between text-sm font-medium leading-5 text-purple-600 rounded-lg"
											@click.prevent="
												$emit('clearFilters')
											">
											<i-tabler-circle-x
												class="w-3 mr-1" />
											Clear Filters
										</button>
									</div>
								</th>
							</tr>
							<tr class="group">
								<template v-for="(field, i) in fields">
									<th
										v-if="
											!hiddenColumns.includes(field.key)
										"
										scope="col"
										:class="{
											'py-3.5 pl-4 pr-3 sm:pl-6': i === 0
										}"
										class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-slate-900">
										<div class="flex items-center">
											<span
												v-if="
													$slots[
														`filters-${field.key}`
													]
												"
												class="flex items-center">
												<BreezeDropdown
													:ref="`${field.key}_filter`"
													align="right"
													width="60"
													:closeOnInsideClick="false">
													<template #trigger>
														<div
															class="flex items-center cursor-pointer">
															<span
																:class="{
																	'text-green-700':
																		filters[
																			field
																				.key
																		]
																}"
																>{{
																	field.label
																}}</span
															>
															<i-tabler-chevron-down
																class="ml-2 -mr-0.5 h-4 w-4" />
														</div>
													</template>

													<template #content>
														<div class="px-3 py-2">
															<div
																class="sm:col-span-4 col-span-6">
																<slot
																	:name="`filters-${field.key}`"
																	:field="
																		field
																	">
																	{{
																		field.label
																	}}
																</slot>

																<BreezeButton
																	@click="
																		applyFilter(
																			$refs[
																				`${field.key}_filter`
																			][0]
																		)
																	"
																	class="w-full mt-3 text-white">
																	Apply
																</BreezeButton>
															</div>
														</div>
													</template>
												</BreezeDropdown>
											</span>
											<span v-else>{{
												field.label
											}}</span>
										</div>
									</th>
								</template>
								<th
									v-if="
										inlineEditable === true &&
										disableAdding === false
									">
									<div
										class="flex items-center justify-end h-full pr-3 cursor-pointer">
										<BreezeButton
											@click="addNewRow"
											class="px-1 py-1">
											<i-tabler-plus class="w-5 h-5" />
										</BreezeButton>
									</div>
								</th>
							</tr>
						</thead>
						<tbody class="divide-slate-200 bg-white divide-y">
							<tr
								v-if="items.data.length"
								v-for="(item, i) in items.data"
								:key="i"
								:class="[
									{
										'hover:bg-slate-100':
											inlineEditable === true
									},
									itemRowClasses(item),
									rowClasses(item)
								]"
								class="group h-full">
								<template v-for="(field, i) in fields">
									<td
										v-if="
											!hiddenColumns.includes(field.key)
										"
										:class="[
											{
												'py-3 pl-4 pr-3 sm:pl-6':
													i === 0,
												'px-2 py-1':
													item.isBeingEdited &&
													i === fields.length - 1
											},
											cellClasses(item, field.key),
											field.classes
										]"
										class="text-slate-500 whitespace-nowrap text-sm">
										<span
											v-if="
												rowEditingInProgress(
													item,
													field
												) || item.isNew
											">
											<slot
												:name="`inputs-${field.key}`"
												:value="item[field.key]"
												:field="field"
												:item="item"
												:editableItem="editableItem">
												<InputBase
													type="text"
													v-model="
														editableItem[field.key]
													" />
											</slot>
										</span>

										<slot
											v-else
											:name="field.key"
											:item="item">
											{{ item[field.key] }}
										</slot>
									</td>
								</template>
								<td
									v-if="
										inlineEditable === true &&
										isRowEditable(item)
									"
									class="flex items-center justify-end h-full gap-1">
									<div
										v-if="item.isBeingEdited"
										class="flex items-center justify-end gap-1 py-4 pr-3">
										<BreezeButton
											@click="saveItem(item)"
											class="hover:bg-green-600 px-1 py-1 bg-green-500">
											<i-tabler-check />
										</BreezeButton>
										<BreezeButton
											@click="cancelEditing(item)"
											class="bg-slate-500 hover:bg-slate-600 px-1 py-1 ml-2">
											<i-tabler-plus class="rotate-45" />
										</BreezeButton>
									</div>
									<div
										v-else
										class="lg:invisible group-hover:visible flex items-center justify-end h-full gap-1 p-2">
										<ButtonEmpty
											@click="editRow(item)"
											class="hover text-indigo-500">
											<i-tabler-pencil />
										</ButtonEmpty>
										<ButtonEmpty
											v-if="
												!item.isNew &&
												disableDeleting === false
											"
											@click="deleteRow(item)"
											class="hover text-red-500">
											<i-tabler-trash />
										</ButtonEmpty>
									</div>
								</td>
							</tr>
							<tr v-else>
								<td
									:colspan="fields.length"
									class="text-slate-500 whitespace-nowrap px-2 py-2 text-sm text-center">
									No results found!
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<Pagination
		:items="items"
		v-if="!noPagination" />
</template>

<script setup>
	import BreezeButton from '@/Components/Button.vue';
	import BreezeDropdown from '@/Components/Dropdown.vue';
	import InputBase from '@/Components/InputBase.vue';
	import Pagination from '@/Components/Pagination.vue';

	const props = defineProps({
		items: Object,
		fields: Object,
		rowClasses: {
			type: Function,
			default: () => {}
		},
		noPagination: Boolean,
		inlineEditable: Boolean,
		disableAdding: {
			type: Boolean,
			default: false
		},
		filters: {
			type: Object,
			default: []
		},
		disableDeleting: {
			type: Boolean,
			default: false
		},
		enableEditColumns: {
			type: Array,
			default: []
		},
		disableEditColumns: {
			type: Array,
			default: []
		},
		hiddenColumns: {
			type: Array,
			default: []
		}
	});

	const showFilter = computed(() => Object.keys(props.filters).length);
	const emit = defineEmits([
		'updateRow',
		'addRow',
		'editRow',
		'deleteRow',
		'applyFilters',
		'clearFilters'
	]);

	let editableItem = ref({});

	const itemRowClasses = function (item) {
		if (item.rowClasses) return item.rowClasses;
	};

	const addNewRow = function () {
		let item =
			props.items.data.find((i) => i.id === editableItem.value.id) || {};
		cancelEditing(item);

		props.items.data.push({
			isBeingEdited: true,
			isNew: true
		});
	};

	const isRowEditable = function (item) {
		return item.editable === undefined || item.editable === true;
	};

	const isCellEditable = function (item, field) {
		if (props.enableEditColumns.length) {
			return props.enableEditColumns.includes(field.key);
		}

		if (item.disableCellEdit?.length) {
			return !item.disableCellEdit?.includes(field.key);
		}

		if (props.disableEditColumns.length) {
			return !props.disableEditColumns.includes(field.key);
		}

		return true;
	};

	const editRow = function (item) {
		if (Object.keys(editableItem.value).length !== 0) {
			return;
		}
		editableItem.value = { ...item };
		item.isBeingEdited = true;
		emit('editRow', item);
	};

	const cancelEditing = function (item) {
		item.isBeingEdited = false;
		editableItem.value = {};

		if (item.isNew) {
			props.items.data.splice(-1);
		}
	};

	const rowEditingInProgress = function (item, field) {
		return item.isBeingEdited === true && isCellEditable(item, field);
	};

	const cellClasses = function (item, key) {
		if (item.cellClasses && item.cellClasses[key] !== undefined) {
			return item.cellClasses[key];
		}
	};

	const saveItem = (oldRecord) => {
		const data = {
			newRecord: editableItem.value,
			oldRecord
		};

		if (oldRecord.isNew === true) {
			emit('addRow', data);
		} else {
			emit('updateRow', data);
		}

		cancelEditing(oldRecord);
	};

	const deleteRow = (item) => {
		emit('deleteRow', item);
		cancelEditing(item);
	};

	const applyFilter = (dropdown) => {
		dropdown.open = false;
		emit('applyFilters');
	};
</script>
