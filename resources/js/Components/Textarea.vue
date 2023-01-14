<script setup>
	import { ref } from 'vue';

	defineProps({
		modelValue: [String, Number],
		placeholder: String,
		error: {
			type: String,
			default: null
		},
		rows: {
			type: String,
			default: 3
		}
	});

	defineEmits(['update:modelValue']);

	const input = ref(null);
</script>

<template>
	<textarea
		v-bind="$attrs"
		:class="{
			'border-red-500': error
		}"
		:rows="rows"
		:placeholder="placeholder"
		class="focus:ring-indigo-500 focus:border-indigo-500 border-slate-300 block w-full py-3 rounded-md shadow-sm"
		:value="modelValue"
		@input="$emit('update:modelValue', $event.target.value)"
		ref="input"></textarea>
	<p
		v-if="error"
		class="text-sm italic text-red-500">
		{{ error }}
	</p>
</template>
