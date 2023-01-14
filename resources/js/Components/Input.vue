<script setup>
	import { ref } from 'vue';

	defineProps({
		modelValue: [String, Number],
		placeholder: String,
		error: {
			type: String,
			default: null
		}
	});

	defineEmits(['update:modelValue']);

	const input = ref(null);
</script>

<template>
	<div class="relative">
		<i-tabler-search
			v-if="$attrs.type === 'search'"
			class="text-slate-600 absolute inset-0 w-4 h-4 m-auto ml-3" />
		<input
			v-bind="$attrs"
			:class="{
				'border-red-500': error,
				'pl-10': $attrs.type === 'search'
			}"
			class="focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-slate-300 block w-full py-3 rounded-md shadow-sm"
			:value="modelValue"
			@input="$emit('update:modelValue', $event.target.value)"
			ref="input"
			:placeholder="placeholder" />
	</div>
	<p
		v-if="error"
		class="text-sm italic text-red-500">
		{{ error }}
	</p>
</template>
