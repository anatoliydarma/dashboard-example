<template>
	<v-frappe-chart
		type="line"
		:labels="metrics.labels"
		:data="metrics.datasets"
		:colors="['#f87979', '#22c55e', '#6366f1']"
		:height="320" />
</template>
<script setup>
	import { VFrappeChart } from 'vue-frappe-chart';

	const props = defineProps({
		metrics: Object,
		chartOptions: Object
	});
</script>
