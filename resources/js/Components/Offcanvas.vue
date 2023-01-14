<template>
	<div class="relative">
		<Transition
			enter-active-class="duration-300 ease-out"
			enter-from-class="transform opacity-0"
			enter-to-class="opacity-100"
			leave-active-class="duration-200 ease-in"
			leave-from-class="opacity-100"
			leave-to-class="transform opacity-0">
			<div
				@click="close"
				v-if="open"
				class="transform-gpu bg-slate-700 fixed top-0 bottom-0 left-0 right-0 z-50 w-screen h-screen overflow-hidden transition bg-opacity-50 cursor-pointer pointer-events-auto"></div>
		</Transition>

		<Transition
			enter-active-class="transition duration-500 ease-in-out transform"
			enter-from-class=" translate-y-full"
			enter-to-class="translate-y-0"
			leave-active-class="transition duration-500 ease-in-out transform"
			leave-from-class="translate-y-0"
			leave-to-class=" translate-y-full">
			<div
				v-if="open"
				:class="height"
				class="bg-slate-50 z-60 text-slate-600 fixed inset-x-0 bottom-0 w-screen h-auto">
				<div class="max-h-[90vh] overflow-y-auto scrollbar py-6">
					<div class="sm:px-6 lg:px-8 max-w-screen-xl px-4 mx-auto">
						<div class="z-60 top-3 right-3 absolute">
							<button
								@click="close"
								class="hover text-slate-600">
								<i-tabler-plus class="w-6 h-6 rotate-45" />
							</button>
						</div>
						<slot></slot>
					</div>
				</div>
			</div>
		</Transition>
	</div>
</template>

<script setup>
	import { onBeforeMount } from 'vue';

	const props = defineProps({
		open: Boolean,
		height: String,
		height: {
			type: String,
			default: 'min-h-[30vh]'
		}
	});

	const emit = defineEmits(['update:open']);

	const close = () => {
		emit('update:open', false);
	};

	watch(
		() => props.open,
		(first, second) => {
			document.body.classList.toggle('overflow-y-hidden', props.open);
		}
	);

	onBeforeMount(() => {
		document.addEventListener('keydown', (e) => {
			if (e.key === 'Escape') {
				close();
			}
		});
	});
</script>
