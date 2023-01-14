<template>
	<SwitchGroup
		as="div"
		class="flex items-center">
		<Switch
			v-model="enabled"
			:disabled="disabled"
			:class="[
				enabled ? 'bg-green-500' : 'bg-slate-200',
				'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500'
			]">
			<span
				aria-hidden="true"
				:class="[
					enabled ? 'translate-x-5' : 'translate-x-0',
					'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200'
				]" />
		</Switch>
		<SwitchLabel
			as="span"
			class="ml-3">
			<span class="text-slate-900 text-sm font-medium">{{ label }} </span>
		</SwitchLabel>
	</SwitchGroup>
</template>

<script setup>
	import { Switch, SwitchGroup, SwitchLabel } from '@headlessui/vue';

	const props = defineProps({
		label: {
			type: String,
			default: ''
		},
		modelValue: {
			type: Boolean,
			default: 0
		},
		disabled: {
			type: [Boolean, Number],
			default: 0
		}
	});
	const emit = defineEmits(['update:modelValue']);
	const enabled = ref(props.modelValue);
	watch(enabled, (value) => {
		emit('update:modelValue', value);
	});
</script>
