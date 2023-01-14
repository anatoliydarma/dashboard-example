<template>
	<slot name="heading"></slot>

	<div class="flex flex-col mt-2">
		<div class="-mx-px -my-2 overflow-x-auto">
			<div class="inline-block min-w-full px-px py-2 align-middle">
				<div
					v-if="items.data.length"
					class="ring-1 ring-black ring-opacity-5 rounded-lg overflow-hidden shadow">
					<table
						v-bind="$attrs"
						class="divide-slate-300 min-w-full divide-y">
						<thead class="bg-slate-50">
							<tr v-if="showFilter">
								<th
									:colspan="fields.length"
									scope="col"
									class="whitespace-nowrap text-slate-900 text-sm font-semibold border-b">
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
							<tr
								class="group relative"
								v-for="columns in headerRows">
								<template v-for="(field, i) in columns">
									<th
										:colspan="field.colSpan"
										:rowspan="field.rowSpan"
										v-if="
											!hiddenColumns.includes(field.key)
										"
										scope="col"
										:class="[
											{ 'pl-4 pr-3': i === 0 },
											{
												'border-b border-l border-slate-200':
													borderedHeaders === true
											},
											field.class
										]"
										class="text-slate-900 px-3 py-3 text-sm font-semibold text-left">
										<div
											v-if="
												$slots[`filters-${field.key}`]
											"
											class="flex items-center">
											<span class="flex items-center">
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
										</div>
										<template v-else>{{
											field.label
										}}</template>
									</th>
								</template>
								<th
									v-if="
										inlineEditable === true &&
										disableAdding === false
									"
									class="right-2 absolute top-0">
									<div
										class="group-hover:visible flex items-center invisible h-full cursor-pointer">
										<BreezeButton
											@click="addNewRow"
											class="!bg-transparent text-indigo-700 !p-0.5">
											<i-tabler-plus />
										</BreezeButton>
									</div>
								</th>
							</tr>
						</thead>
						<tbody class="divide-slate-200 bg-white divide-y">
							<tr
								v-for="(item, i) in items.data"
								:key="i"
								:class="[
									itemRowClasses(item),
									rowClasses(item)
								]"
								class="group relative">
								<template v-for="(field, i) in fieldKeys">
									<td
										v-if="
											!hiddenColumns.includes(field.key)
										"
										:class="[
											{
												'py-2 pr-3': i === 0,
												'pr-20':
													item.isBeingEdited &&
													i === fields.length - 1
											},
											cellClasses(item, field.key),
											field.classes
										]"
										class="text-slate-600 px-4 py-2 text-sm">
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
												<BreezeInput
													class="!p-1 text-sm"
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
											{{ get(item, field.key) }}
										</slot>
									</td>
								</template>
								<td
									v-if="
										inlineEditable === true &&
										isRowEditable(item)
									"
									class="right-2 group-hover:visible absolute flex items-center invisible h-full cursor-pointer">
									<div v-if="item.isBeingEdited">
										<BreezeButton
											@click="saveItem(item)"
											class="hover:bg-green-500 px-1 py-1 bg-green-600">
											<i-tabler-check class="w-4 h-4" />
										</BreezeButton>
										<BreezeButton
											@click="cancelEditing(item)"
											class="hover:bg-slate-500 bg-slate-600 px-1 py-1 ml-2">
											<i-tabler-plus class="rotate-45" />
										</BreezeButton>
									</div>
									<BreezeButton
										v-else
										@click="editRow(item)"
										class="hover:bg-green-500 px-1 py-1 bg-green-600">
										<i-tabler-pencil />
									</BreezeButton>
									<BreezeButton
										v-if="
											!item.isNew &&
											disableDeleting === false
										"
										@click="deleteRow(item)"
										class="hover:bg-red-500 px-1 py-1 ml-2 bg-red-600">
										<i-tabler-trash />
									</BreezeButton>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div v-else>No results found!</div>
			</div>
		</div>
	</div>

	<Pagination
		:items="items"
		v-if="!noPagination" />
</template>

<script setup>
	import Pagination from '@/Components/Pagination.vue';
	import BreezeButton from '@/Components/Button.vue';
	import BreezeInput from '@/Components/Input.vue';
	import BreezeDropdown from '@/Components/Dropdown.vue';

	const props = defineProps({
		items: Object,
		fields: Object,
		borderedHeaders: {
			type: Boolean,
			default: false
		},
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

	const depthByKey = (object, key, level = 1) => {
		for (let k in object) {
			if (!object.hasOwnProperty(k)) continue;

			if (typeof object[k] == 'object' && object[k].hasOwnProperty(key)) {
				level = depthByKey(object[key], key, ++level);
			}
		}

		return level;
	};

	const getColumnCount = (columns) => {
		return columns.reduce(function (sum, next) {
			let currentSum = 1;

			if (next.columns) {
				currentSum = getColumnCount(next.columns);
			}

			return sum + currentSum;
		}, 0);
	};

	const flattenArray = (array, result, rows, r = 0) => {
		let c = [];
		let n = [];

		array.forEach(({ columns, ...rest }) => {
			let column = {
				...rest,
				colSpan: columns ? getColumnCount(columns) : 1
			};

			c.push({
				...column,
				rowSpan: columns ? depthByKey(columns) : rows
			});

			if (columns) {
				n.push(...columns);
			}
		});

		result[r] = c;

		if (n.length > 0) {
			r++;

			flattenArray(n, result, depthByKey(n, 'columns'), r);
		}

		return result;
	};

	const headerRows = computed(() => {
		let result = [];

		flattenArray(
			props.fields,
			result,
			depthByKey(props.fields, 'columns') + 1
		);

		return result;
	});

	const getFieldKeys = (array, result) => {
		let c = [];
		let n = [];

		array.forEach(({ columns, ...rest }) => {
			if (!columns) {
				c.push(rest);
			} else {
				c.push(...getFieldKeys(n, columns));
			}
		});

		result.push(...c);

		return result;
	};

	const fieldKeys = computed(() => {
		let result = [];
		getFieldKeys(props.fields, result);
		return result;
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
