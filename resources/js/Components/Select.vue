<template>
	<div>
		<label
			v-if="label"
			:for="id"
			class="form-label">
			{{ label }}
		</label>
		<select
			:id="id"
			:disabled="disabled"
			@change="$emit('update:modelValue', $event.target.value)"
			:value="modelValue"
			:class="[{ 'border-red-500': error }, size, $attrs.class]"
			class="focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 disabled:bg-slate-50 disabled:cursor-not-allowed border-slate-300 block rounded-md">
			<slot />
		</select>
		<div
			v-if="error"
			class="form-error">
			{{ error }}
		</div>
	</div>
</template>

<script setup>
	import { v4 as uuid } from 'uuid';
	const props = defineProps({
		id: {
			type: String,
			default() {
				return `select-input-${uuid()}`;
			}
		},
		disabled: false,
		size: {
			type: String,
			default: 'text-base'
		},
		error: String,
		label: String,
		modelValue: {
			type: [String, Number, Boolean, Object],
			default: 0
		}
	});
	defineEmits(['update:modelValue']);
</script>
