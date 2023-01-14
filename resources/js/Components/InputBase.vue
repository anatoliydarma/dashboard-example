<template>
	<div :class="{ 'w-full': !label }">
		<label
			v-if="label"
			class="form-label"
			:for="id">
			{{ label }}
		</label>
		<input
			:id="id"
			ref="input"
			v-bind="{ ...$attrs }"
			class="hover:border-indigo-500 focus:ring-indigo-500 focus:border-indigo-500 disabled:cursor-not-allowed disabled:bg-slate-50 border-slate-300 block w-full py-2 rounded-md"
			:class="{ error: error }"
			:type="type"
			:placeholder="placeholder"
			:value="modelValue"
			:disabled="disabled"
			@input="$emit('update:modelValue', $event.target.value)" />
		<div
			v-if="error"
			class="form-error">
			{{ error }}
		</div>
	</div>
</template>

<script>
	import { v4 as uuid } from 'uuid';

	export default {
		inheritAttrs: false,
		props: {
			id: {
				type: String,
				default() {
					return `text-input-${uuid()}`;
				}
			},
			type: {
				type: String,
				default: 'text'
			},
			disabled: false,
			placeholder: [String, Number],
			error: String,
			label: String,
			modelValue: [String, Number]
		},
		emits: ['update:modelValue'],
		methods: {
			focus() {
				this.$refs.input.focus();
			},
			select() {
				this.$refs.input.select();
			},
			setSelectionRange(start, end) {
				this.$refs.input.setSelectionRange(start, end);
			}
		}
	};
</script>
