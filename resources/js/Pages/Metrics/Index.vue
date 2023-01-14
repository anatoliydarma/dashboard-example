<template>
	<Authenticated>
		<Head title="Metrics" />

		<div class="pb-12 space-y-6">
			<PageTitle>Metrics</PageTitle>

			<div
				class="md:items-end md:flex-row flex flex-col items-center justify-between gap-6">
				<div
					class="md:flex-row md:px-0 flex flex-col items-center justify-start gap-4 px-4">
					<div class="text-slate-500 pt-5 text-lg font-bold">
						{{ year }}
					</div>
					<div>
						<DateRange
							label="Date range"
							v-model="filtersArray.date"></DateRange>
					</div>

					<Select
						v-model="filtersArray.tc"
						label="TCs">
						<option value=""></option>
						<option
							v-for="item in tourConcierges"
							:key="item.id"
							:value="item.id">
							{{ item.initials }}
						</option>
					</Select>

					<Select
						v-model="filtersArray.type"
						label="Discrepancy type">
						<option value=""></option>
						<option
							v-for="(item, key) in discrepancyTypes"
							:key="key"
							:value="key">
							{{ item }}
						</option>
					</Select>
				</div>
				<div class="flex items-center gap-4">
					<div class="text-slate-500 text-xs">
						{{ lastRefreshed }}
					</div>
					<button
						class="hover:bg-indigo-600 p-2 text-white bg-indigo-500 rounded-full"
						@click="isFetching = !isFetching"
						:disabled="isFetching">
						<i-tabler-rotate-clockwise
							class="w-6 h-6 fill-current"
							:class="{ 'animate-spin': isFetching }" />
					</button>
				</div>
			</div>

			<div
				class="md:py-5 md:px-6 px-4 py-3 overflow-hidden bg-white rounded-lg shadow">
				<ChartLine
					:metrics="metrics.metricsChart"
					:chartOptions="chartOptionsMetrics" />
			</div>

			<TableTotal
				:total="metrics.total"
				:total-tc="metrics.totalTc" />
			<TableMetrics
				:metrics="metrics.metricsTable"
				:dateRange="filtersArray.date" />
		</div>
	</Authenticated>
</template>

<script setup>
	import DateRange from '@/Components/DateRange.vue';
	import PageTitle from '@/Components/PageTitle.vue';
	import TableMetrics from './TableMetrics.vue';
	import TableTotal from './TableTotal.vue';
	import { Inertia } from '@inertiajs/inertia';
	import dayjs from 'dayjs';
	import ChartLine from '@/Components/ChartLine.vue';
	import Select from '@/Components/Select.vue';

	const props = defineProps({
		metrics: Object,
		lastRefreshed: String,
		discrepancyTypes: Object,
		tourConcierges: Object,
		filters: Object
	});

	let filtersArray = ref(props.filters);
	let year = ref(dayjs(filtersArray.value.date[0]).format('YYYY'));
	let isFetching = ref(false);

	const chartOptionsMetrics = {
		responsive: true,
		maintainAspectRatio: false,
		scales: {
			y: {
				display: true,
				ticks: {
					callback: function (value, index, ticks) {
						return value + ' %';
					}
				},
				min: 0
			}
		}
	};

	onMounted(() => {
		if (!Object.keys(props.metrics).length && props.lastRefreshed == null) {
			isFetching.value = true;
		}
	});

	watch(isFetching, () => {
		if (isFetching.value === true) {
			let params = {};
			params.date = filtersArray.value.date;
			Inertia.get(route('fetchingData'), params);
		}
	});

	watch(
		filtersArray,
		() => {
			getMetrics();
		},
		{ deep: true }
	);

	const getMetrics = function () {
		let params = filtersArray.value;
		Inertia.get(route('metrics'), params);
	};
</script>
