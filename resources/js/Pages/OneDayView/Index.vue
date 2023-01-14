<template>
	<Authenticated>
		<div class="pb-12 space-y-6">
			<Head title="One day view" />

			<PageTitle>{{ pageTitle }}</PageTitle>

			<div
				class="md:flex-row md:px-0 flex flex-col items-center justify-between gap-4">
				<DateSwitch
					v-model:date="picked"
					:loading="isFetching" />

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
			<TableBookings
				:items="bookings"
				:stats="stats"
				:dayData="dayData"
				:date="filters.date"
				:runningCount="runningCount"
				:discrepancyTypes="discrepancyTypes"
				:hasEndOfDay="hasEndOfDay" />

			<div>
				<TableOrder
					:orders="orders"
					:options="options"
					:times="times"
					:date="picked"
					:tourConcierges="tourConcierges"
					:errors="errors"
					:tc="dayData ? dayData.tc : null">
					<template v-slot:stats>
						<Statistic :stats="stats" />
					</template>
				</TableOrder>
			</div>
		</div>
	</Authenticated>
</template>

<script setup>
	import Statistic from './Statistic.vue';
	import TableBookings from './TableBookings.vue';
	import TableOrder from './TableOrder.vue';
	import DateSwitch from '@/Components/DateSwitch.vue';
	import PageTitle from '@/Components/PageTitle.vue';
	import { Inertia } from '@inertiajs/inertia';
	import dayjs from 'dayjs';

	const props = defineProps({
		bookings: Object,
		lastRefreshed: String,
		filters: Object,
		orders: Object,
		stats: Object,
		options: Object,
		times: Object,
		errors: Object,
		runningCount: Object,
		dayData: Object,
		tourConcierges: Object,
		discrepancyTypes: Object,
		dayData: Object
	});

	let picked = ref(props.filters.date);
	let pageTitle = ref(dayjs(picked.value).format('MMM D, YYYY'));
	let isFetching = ref(false);
	let hasEndOfDay = ref(false);

	onMounted(() => {
		if (
			!Object.keys(props.bookings).length &&
			props.lastRefreshed === null
		) {
			isFetching.value = true;
		}
		if (props.orders.find((item) => item.option === 'end')) {
			hasEndOfDay.value = true;
		}
	});

	watch(isFetching, () => {
		if (isFetching.value === true) {
			let params = {};
			params.date = dayjs(picked.value).format('YYYY-MM-DD').toString();
			Inertia.get(route('fetchingData'), params);
		}
	});

	watch(picked, (value) => {
		let params = {};
		if (value) {
			params.date = dayjs(value).format('YYYY-MM-DD').toString();
		}
		Inertia.get(route('one.day.view'), params);
	});
</script>
