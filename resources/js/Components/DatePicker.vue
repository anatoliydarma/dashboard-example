<template>
	<input
		v-model="date"
		ref="input"
		:placeholder="placeholder"
		:disabled="disabled"
		:class="$attrs.class"
		class="focus:outline-none focus:border-indigo-500 border-slate-300 hover:bg-slate-50 block w-full px-3 py-2 border shadow-sm cursor-pointer" />
</template>

<script setup>
	import { easepick } from '@easepick/bundle';
	import css_inline from '@easepick/core/dist/index.css?inline';
	import dayjs from 'dayjs';

	const props = defineProps({
		date: [String, Date, Object],
		placeholder: String,
		disabled: Boolean
	});
	const input = ref(props.date);
	const date = ref(props.date);
	const emit = defineEmits(['update:date']);

	onMounted(() => {
		let picker = new easepick.create({
			element: input.value,
			css: css_inline,
			zIndex: 20,
			lang: 'en-EN',
			grid: 1,
			calendars: 1,
			format: 'MMM D YYYY',
			readonly: props.disabled
		});

		if (date.value) {
			picker.setDate(dayjs(date.value).valueOf());
		}

		picker.on('select', (e) => {
			handleDate(e.detail);
		});
	});

	const handleDate = (value) => {
		let date = dayjs(value.date).format('YYYY-MM-DD').toString();
		emit('update:date', date);
	};
</script>
