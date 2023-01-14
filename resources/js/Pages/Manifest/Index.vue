<template>
	<Authenticated>
		<div class="pb-12 space-y-6">
			<Head title="Manifest" />

			<PageTitle>Manifest on {{ pageTitle }}</PageTitle>

			<div
				class="md:flex-row flex flex-col items-center justify-between gap-4">
				<div
					class="md:flex-row md:px-0 flex flex-col items-center justify-start gap-8">
					<DateSwitch
						v-model:date="picked"
						:loading="isFetching" />
					<div class="flex gap-4">
						<a
							:href="route('download.manifest', { type: 'pdf' })"
							class="hover:bg-indigo-600 flex items-center gap-1 p-2 pr-3 text-sm font-semibold text-white bg-indigo-500 rounded-lg">
							<i-tabler-file-download />
							<span>pdf</span>
						</a>
						<a
							:href="route('download.manifest', { type: 'csv' })"
							class="hover:bg-indigo-600 flex items-center gap-1 p-2 pr-3 text-sm font-semibold text-white bg-indigo-500 rounded-lg">
							<i-tabler-file-download />
							<span>csv</span>
						</a>
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

			<TableManifest :manifest="manifest"></TableManifest>
		</div>
	</Authenticated>
</template>

<script setup>
	import TableManifest from './TableManifest.vue';
	import DateSwitch from '@/Components/DateSwitch.vue';
	import PageTitle from '@/Components/PageTitle.vue';
	import { Inertia } from '@inertiajs/inertia';
	import dayjs from 'dayjs';

	const props = defineProps({
		manifest: Object,
		filters: Object,
		lastRefreshed: String
	});

	let picked = ref(props.filters.date);
	let pageTitle = ref(dayjs(picked.value).format('MMM D, YYYY'));

	let isFetching = ref(false);

	onMounted(() => {
		if (
			!Object.keys(props.manifest).length &&
			props.lastRefreshed == null
		) {
			isFetching.value = true;
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
		Inertia.get(route('manifest.index'), params);
	});
</script>
