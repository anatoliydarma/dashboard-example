<template>
	<div>
		<Popover
			v-slot="{ open }"
			class="relative">
			<PopoverButton
				:class="open ? '' : 'text-opacity-90'"
				class="focus:outline-none">
				<slot name="button"></slot>
			</PopoverButton>

			<transition
				enter-active-class="transition duration-200 ease-out"
				enter-from-class="translate-y-1 opacity-0"
				enter-to-class="translate-y-0 opacity-100"
				leave-active-class="transition duration-150 ease-in"
				leave-from-class="translate-y-0 opacity-100"
				leave-to-class="translate-y-1 opacity-0">
				<PopoverPanel
					v-bind="{ ...$attrs }"
					class="left-1/2 sm:px-0 absolute z-10 w-screen max-w-sm px-4 mt-3 transform -translate-x-1/2">
					<div
						class="ring-1 ring-black ring-opacity-5 overflow-hidden rounded-lg shadow-lg">
						<div class="relative p-4 bg-white">
							<slot name="content"></slot>
						</div>
					</div>
				</PopoverPanel>
			</transition>
		</Popover>
	</div>
</template>

<script setup>
	import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue';
</script>
