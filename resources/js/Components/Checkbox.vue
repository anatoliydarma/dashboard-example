<script setup>
	import { v4 as uuid } from 'uuid';

	const props = defineProps({
		modelValue: {
			type: [Boolean, Number, String],
			default: 0
		},
		id: {
			type: String,
			default() {
				return `select-input-${uuid()}`;
			}
		},
		error: String,
		disabled: {
			type: [Boolean, Number],
			default: 0
		}
	});

	defineEmits(['update:modelValue']);
</script>

<template>
	<div>
		<input
			type="checkbox"
			@change="$emit('update:modelValue', $event.target.checked)"
			:checked="modelValue"
			:id="id"
			:disabled="disabled"
			class="focus:border-indigo-300 disabled:cursor-not-allowed disabled:opacity-75 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 border-slate-300 text-indigo-600 rounded shadow-sm" />
		<div
			v-if="error"
			class="form-error">
			{{ error }}
		</div>
	</div>
</template>
