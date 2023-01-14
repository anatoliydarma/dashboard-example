<template>
	<label
		v-if="label"
		class="form-label">
		{{ label }}
	</label>
	<input
		v-model="modelValue"
		id="daterange"
		class="focus:outline-none focus:border-indigo-500 border-slate-300 hover:bg-slate-50 block w-full px-3 py-2 border rounded-md shadow-sm cursor-pointer" />
</template>

<script setup>
	import { easepick, RangePlugin } from '@easepick/bundle';
	import css_inline from '@easepick/core/dist/index.css?inline';
	import css_inline_date_range from '@easepick/range-plugin/dist/index.css?inline';
	import dayjs from 'dayjs';

	const props = defineProps({
		label: String,
		modelValue: [Array, Object]
	});

	const modelValue = ref(props.modelValue);
	const emit = defineEmits(['update:modelValue']);

	onMounted(() => {
		let picker = new easepick.create({
			element: '#daterange',
			css: css_inline + css_inline_date_range,
			plugins: [RangePlugin],
			RangePlugin: {
				tooltip: false
			},
			zIndex: 20,
			lang: 'en-EN',
			grid: 2,
			calendars: 2,
			format: 'MMM D'
		});

		picker.setStartDate(dayjs(modelValue.value[0]).valueOf());
		picker.setEndDate(dayjs(modelValue.value[1]).valueOf());

		picker.on('select', (e) => {
			handleDate(e.detail);
		});
	});

	const handleDate = (value) => {
		let dateRange = {
			0: dayjs(value.start).format('YYYY-MM-DD').toString(),
			1: dayjs(value.end).format('YYYY-MM-DD').toString()
		};
		emit('update:modelValue', dateRange);
	};
</script>
