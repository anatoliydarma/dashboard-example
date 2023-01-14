<template>
	<span class="z-0 inline-flex rounded-md">
		<button
			@click="subDay"
			:disabled="disabled"
			type="button"
			class="text-slate-700 border-slate-300 rounded-l-md hover:bg-slate-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 inline-flex items-center px-4 py-2 text-sm font-medium bg-white border shadow-sm">
			<i-tabler-chevron-left /> {{ prevDay }}
		</button>
		<span class="inline-flex items-center -ml-px">
			<DatePicker v-model:date="picked"></DatePicker>
		</span>
		<button
			@click="addDay"
			:disabled="disabled"
			type="button"
			class="text-slate-700 border-slate-300 rounded-r-md hover:bg-slate-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 inline-flex items-center px-4 py-2 -ml-px text-sm font-medium bg-white border shadow-sm">
			{{ nextDay }}
			<i-tabler-chevron-right />
		</button>
	</span>
</template>

<script setup>
	import DatePicker from '@/Components/DatePicker.vue';
	import { ref, watch, computed } from 'vue';
	import dayjs from 'dayjs';

	const props = defineProps({
		date: String,
		loading: false
	});
	const emit = defineEmits(['update:date']);

	let disabled = ref(props.loading);
	let picked = ref(dayjs(props.date || null).format('MM/DD/YYYY'));

	const nextDay = computed(() =>
		dayjs(picked.value).add(1, 'day').format('MMM D')
	);
	const prevDay = computed(() =>
		dayjs(picked.value).subtract(1, 'day').format('MMM D')
	);

	const subDay = () => {
		disabled.value = true;
		let result = dayjs(picked.value).subtract(1, 'day');
		picked.value = result;
	};

	const addDay = () => {
		disabled.value = true;
		let result = dayjs(picked.value).add(1, 'day');
		picked.value = result;
	};

	watch(picked, (value) => {
		emit('update:date', dayjs(value).format('MM/DD/YYYY').toString());
	});
</script>
