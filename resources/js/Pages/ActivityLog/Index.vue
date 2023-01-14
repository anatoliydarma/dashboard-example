<template>
	<Authenticated>
		<Head title="Activity Logs" />
		<div class="py-2 space-y-2">
			<div
				class="md:flex-row flex flex-col items-center justify-between gap-4">
				<PageTitle>Activity Logs</PageTitle>

				<div class="flex items-center gap-2">
					<BreezeInput
						type="search"
						placeholder="Search"
						v-model="search" />
				</div>
			</div>

			<div class="-mx-px -my-2 overflow-x-auto">
				<div class="inline-block min-w-full px-px py-2 align-middle">
					<div
						class="ring-1 ring-black ring-opacity-5 overflow-hidden rounded-lg shadow"
						v-if="Object.keys(logs).length">
						<table class="divide-slate-300 min-w-full divide-y">
							<thead class="bg-slate-50">
								<tr
									class="text-slate-900 text-sm font-semibold">
									<th
										class="whitespace-nowrap py-2 pl-6 pr-3 text-left">
										Log type
									</th>
									<th class="px-3 py-2 text-left">Event</th>
									<th class="px-3 py-2 text-left">User</th>
									<th class="px-3 py-2 text-left">
										<div class="flex items-center gap-3">
											<span>Created at</span>
											<Datepicker
												v-model:date="applyFilter"
												@update:date="applyFilters"
												placeholder="Filter by date"
												class="w-32 rounded-md" />
											<button
												v-if="applyFilter"
												type="button"
												@click="applyFilters(null)">
												Reset
											</button>
										</div>
									</th>
									<th class="px-3 py-2 pr-6 text-right"></th>
								</tr>
							</thead>
							<tbody
								v-for="(log, index) in logs.data"
								:key="index"
								class="divide-slate-200 bg-white divide-y">
								<tr
									class="text-slate-900 hover:bg-slate-50 group text-sm capitalize cursor-pointer"
									@click="showItem(log)">
									<td class="py-2 pl-6 pr-3 text-left">
										{{ log.type }}
									</td>
									<td class="px-3 py-2 text-left">
										{{ log.event }}
									</td>
									<td class="px-3 py-2 text-left">
										{{ log.user }}
									</td>
									<td class="px-3 py-2 text-left">
										{{
											dayjs(log.created_at)
												.format('MMM D, YYYY')
												.toString()
										}}
									</td>

									<td class="sm:pr-6 px-3 py-2 text-right">
										<div
											class="group-hover:visible invisible text-indigo-600">
											<i-tabler-eye />
										</div>
									</td>
								</tr>
							</tbody>
						</table>

						<Pagination
							:items="logs"
							v-if="logs.total > 15" />
					</div>
					<div v-else>No orders</div>
				</div>
			</div>
		</div>

		<Offcanvas v-model:open="open">
			<div class="py-4 space-y-4">
				<div>
					<span class="font-bold capitalize">
						{{ itemData.type }}
					</span>
					for
					{{
						dayjs(itemData.type_date)
							.format('MMM D, YYYY')
							.toString()
					}}
					was
					<span class="font-bold">{{ itemData.event }}</span>
					by
					<span>{{ itemData.user }}</span>
				</div>
				<div v-if="Object.keys(itemData.history.attributes).length">
					<div
						class="ring-1 ring-black ring-opacity-5 w-full max-w-md overflow-hidden rounded-lg shadow">
						<table class="divide-slate-300 w-full divide-y">
							<thead class="bg-slate-100">
								<tr>
									<th
										scope="col"
										class="text-slate-900 py-2 pl-4 pr-3 text-sm font-semibold text-left">
										Data type
									</th>
									<th
										v-if="itemData.history.old"
										class="text-slate-900 px-3 py-2 text-sm font-semibold text-left">
										Old
									</th>
									<th
										scope="col"
										class="py-2 pl-3 pr-4 text-sm font-semibold text-left">
										New
									</th>
								</tr>
							</thead>
							<tbody class="divide-slate-200 bg-white divide-y">
								<tr
									v-for="(attribute, key) in itemData.history
										.attributes"
									:key="key">
									<td
										class="text-slate-900 whitespace-nowrap py-2 pl-4 pr-3 text-sm font-medium capitalize">
										{{ key }}
									</td>

									<td
										v-if="itemData.history.old"
										class="py-2 pl-3 pr-4 text-sm">
										<span
											v-if="
												[
													'created_at',
													'updated_at'
												].includes(key)
											">
											{{
												dayjs(itemData.history.old[key])
													.format('MMM D, YYYY hh:mm')
													.toString()
											}}
										</span>
										<span v-else>{{
											itemData.history.old[key]
										}}</span>
									</td>

									<td
										class="text-slate-500 px-3 py-2 text-sm">
										<span
											v-if="
												[
													'created_at',
													'updated_at'
												].includes(key)
											">
											{{
												dayjs(attribute)
													.format('MMM D, YYYY hh:mm')
													.toString()
											}}
										</span>
										<span v-else>{{ attribute }}</span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</Offcanvas>
	</Authenticated>
</template>

<script setup>
	import Pagination from '@/Components/Pagination.vue';
	import Offcanvas from '@/Components/Offcanvas.vue';
	import BreezeInput from '@/Components/Input.vue';
	import Datepicker from '@/Components/DatePicker.vue';
	import { Inertia } from '@inertiajs/inertia';
	import dayjs from 'dayjs';

	const props = defineProps({
		logs: Object,
		filters: Object
	});
	let itemData = ref([]);
	let open = ref(false);

	const showItem = function (item) {
		console.log(item);
		if (item.event != 'deleted') {
			itemData.value = { ...item };
			open.value = true;
		}
	};

	let search = ref(props.filters.search);
	let searchDebounced = refDebounced(search, 600);

	let applyFilter = ref(props.filters.date);

	const applyFilters = function (value) {
		let params;
		if (value) {
			let date = dayjs(value).format('YYYY-M-D').toString();
			params = { date: date };
		}

		Inertia.get(route('admin.activity-logs.index'), params, {
			replace: true
		});
	};

	watch(searchDebounced, (value) => {
		let params = { search: value };
		if (!value) params = {};

		Inertia.get(route('admin.activity-logs.index'), params, {
			preserveState: true,
			replace: true
		});
	});
</script>
