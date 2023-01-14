<template>
	<Authenticated>
		<div class="pb-12 space-y-6">
			<Head title="Date range view" />
			<PageTitle>Date range view</PageTitle>
			<div
				class="md:items-start md:flex-row flex flex-col items-center justify-between gap-6">
				<div
					class="md:flex-row md:px-0 flex flex-col items-center justify-start gap-4 px-4">
					<DateRange v-model="picked"></DateRange>

					<div class="text-slate-500 text-lg font-bold">
						{{ year }}
					</div>
					<a
						title="Download"
						:href="
							route('download.booking', {
								type: 'csv',
								date: picked
							})
						"
						class="hover:bg-indigo-600 flex items-center gap-1 p-2 pr-3 text-sm font-semibold text-white bg-indigo-500 rounded-lg">
						<i-tabler-download class="w-6 h-6" />
						<span>csv</span>
					</a>

					<div>
						<FileUploader label="Import" />
					</div>
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
			<Table
				:items="bookings"
				:times="times" />
		</div>
	</Authenticated>
</template>

<script setup>
	import FileUploader from './FileUploader.vue';
	import DateRange from '@/Components/DateRange.vue';
	import PageTitle from '@/Components/PageTitle.vue';
	import Table from './Table.vue';
	import { Inertia } from '@inertiajs/inertia';
	import dayjs from 'dayjs';

	const props = defineProps({
		bookings: Object,
		lastRefreshed: String,
		date: Array,
		times: Array
	});

	let picked = ref(props.date);
	let year = ref(dayjs(picked.value[0]).format('YYYY'));
	let isFetching = ref(false);

	onMounted(() => {
		if (
			!Object.keys(props.bookings).length &&
			props.lastRefreshed == null
		) {
			isFetching.value = true;
		}
	});

	watch(isFetching, () => {
		if (isFetching.value === true) {
			let params = {};
			params.date = picked.value;
			Inertia.get(route('fetchingData'), params);
		}
	});

	watch(picked, (value) => {
		let params = {};
		if (value) {
			params.date = value;
		}
		Inertia.get(route('date-range-view'), params);
	});
</script>
