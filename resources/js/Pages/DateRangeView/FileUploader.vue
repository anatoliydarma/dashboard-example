<template>
	<form
		@submit.prevent="submit"
		class="flex items-center gap-3">
		<div
			class="hover:bg-indigo-100 relative z-20 flex items-center gap-1 px-3 py-2 overflow-hidden text-sm font-semibold text-indigo-500 transition duration-300 bg-white border border-indigo-500 rounded-lg"
			title="Upload">
			<input
				type="file"
				@input="form.file = $event.target.files[0]"
				class="absolute left-0 z-20 block w-full h-full py-2 text-sm truncate rounded-lg outline-none opacity-0 cursor-pointer" />
			<div class="flex items-center w-full h-full gap-1">
				<svg
					v-if="form.progress"
					class="animate-spin w-6 h-6"
					xmlns="http://www.w3.org/2000/svg"
					fill="none"
					viewBox="0 0 24 24">
					<circle
						class="opacity-50"
						cx="12"
						cy="12"
						r="10"
						stroke="currentColor"
						stroke-width="4"></circle>
					<path
						class="opacity-100"
						fill="currentColor"
						d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
				</svg>
				<i-tabler-upload
					v-else
					class="w-6 h-6" />
				<span>{{ label }}</span>
			</div>
		</div>
		<Button
			v-if="form.file && !loading"
			type="submit"
			class="hover:border-indigo-500 text-sm bg-green-500 border-green-500"
			>Upload</Button
		>

		<Popover class="max-w-sm">
			<template v-slot:button>
				<div class="hover mt-1">
					<i-tabler-info-circle class="w-6 h-6" />
				</div>
			</template>

			<template v-slot:content>
				<div class="space-y-3 text-sm">
					<div>
						Format of <b>CSV</b> or <b>XLSX</b> files for importing
					</div>
					<div>
						<table
							class="bg-slate-50 table text-sm text-center rounded-md">
							<thead class="border-b">
								<tr>
									<th class="px-2 py-1 border-r">date</th>
									<th class="px-2 py-1 border-r">
										reserved_a
									</th>
									<th class="px-2 py-1 border-r">time_a</th>
									<th class="px-2 py-1">confirm_a</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="px-2 py-1 border-r">1-Nov</td>
									<td class="px-2 py-1 border-r">300</td>
									<td class="px-2 py-1 border-r">AM</td>
									<td class="px-2 py-1">4319267</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</template>
		</Popover>
	</form>
</template>

<script setup>
	import { useForm } from '@inertiajs/inertia-vue3';
	import Button from '@/Components/Button.vue';
	import Popover from '@/Components/Popover.vue';

	const props = defineProps({
		label: String
	});
	let loading = ref(false);

	const form = useForm({
		file: null
	});

	function submit() {
		loading.value = true;
		form.post(route('booking.import'), {
			forceFormData: true,
			onSuccess: () => {
				loading.value = false;
				form.reset('file');
			}
		});
	}
</script>
