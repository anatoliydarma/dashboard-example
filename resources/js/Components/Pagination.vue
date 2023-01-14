`
<template>
	<div
		class="sm:px-4 sm:rounded-b-lg bg-slate-50 border-slate-200 flex items-start justify-between py-1 border-t">
		<div
			class="md:flex-row flex flex-col items-center justify-between flex-1">
			<div>
				<p class="text-slate-700 text-sm leading-5">
					<span class="font-medium">{{ items.from }}</span> &mdash;
					<span class="font-medium">{{ items.to }}</span> &sol;
					<span class="font-medium">{{ items.total }}</span> entries
				</p>
			</div>
			<div>
				<nav class="relative z-0 inline-flex">
					<Component
						:is="link.url ? 'Link' : 'span'"
						v-for="link in items.links"
						:key="link"
						:href="link.url + dateRange"
						v-html="link.label"
						:class="{
							'text-indigo-700 font-bold text-lg': link.active
						}"
						class="text-slate-700 relative inline-flex items-center px-4 py-1 -ml-px text-sm font-medium leading-5 transition duration-150 ease-in-out" />
				</nav>
			</div>
		</div>
	</div>
</template>

<script setup>
	const props = defineProps({
		items: Object,
		dateRange: Object
	});

	let dateRange = ref(
		props.dateRange
			? `&date[0]=${props.dateRange[0]}&date[1]=${props.dateRange[1]}`
			: null
	);
</script>
`
