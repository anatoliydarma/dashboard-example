<template>
	<form
		@submit.prevent="submit"
		class="py-8">
		<div class="flex flex-wrap items-start justify-start gap-4">
			<Input
				v-model="form.initials"
				:error="form.errors.initials"
				label="Initials" />

			<Input
				v-model="form.name"
				:error="form.errors.name"
				label="Name" />

			<Input
				v-model="form.email"
				:error="form.errors.email"
				label="Email" />

			<div class="mt-6">
				<Button :disabled="form.processing">
					<i-tabler-loader
						v-if="form.processing"
						class="animate-spin w-5 h-5 mr-2" />
					<span v-if="form.id === null">Create</span>
					<span v-else>Update</span>
				</Button>
			</div>
		</div>
	</form>
</template>

<script setup>
	import { useForm } from '@inertiajs/inertia-vue3';
	import Input from '@/Components/InputBase.vue';
	import Button from '@/Components/Button.vue';

	const props = defineProps({
		item: Object,
		errors: Object
	});

	let form = useForm({
		id: props.item.id,
		initials: props.item.initials,
		name: props.item.name,
		email: props.item.email
	});
	const emit = defineEmits(['close']);

	const submit = function () {
		form.clearErrors();
		if (form.id) {
			form.put(route('concierges.update', form.id), {
				preserveScroll: true,
				onSuccess: () => {
					emit('close');
				}
			});
		} else {
			form.post(route('concierges.store'), {
				preserveScroll: true,
				onSuccess: () => {
					emit('close');
				}
			});
		}
	};
</script>
