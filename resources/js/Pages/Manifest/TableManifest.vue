<template>
	<div class="flex flex-col mt-8">
		<div class="-mx-px -my-2 overflow-x-auto">
			<div class="inline-block min-w-full px-px py-2 align-middle">
				<div
					class="ring-1 ring-black ring-opacity-5 overflow-hidden rounded-lg shadow"
					v-if="Object.keys(manifest).length">
					<table class="divide-slate-300 min-w-full divide-y">
						<thead class="bg-slate-50">
							<tr>
								<th
									class="w-28 sm:pl-6 text-slate-900 py-2 pl-4 pr-3 text-sm font-semibold text-left">
									Check-in
								</th>
								<th
									class="text-slate-900 px-3 py-2 text-sm font-semibold text-left">
									Customer
								</th>
								<th
									class="text-slate-900 px-3 py-2 text-sm font-semibold text-center">
									Adult
								</th>
								<th
									class="text-slate-900 px-3 py-2 text-sm font-semibold text-center">
									Child
								</th>
								<th
									class="text-slate-900 px-3 py-2 text-sm font-semibold text-left">
									Guide
								</th>
								<th
									class="text-slate-900 px-3 py-2 text-sm font-semibold text-left">
									Email
								</th>
								<th
									class="text-slate-900 px-3 py-2 text-sm font-semibold text-left">
									Notes
								</th>
							</tr>
						</thead>
						<tbody
							v-for="(code, index) in manifest"
							:key="index"
							class="divide-slate-200 bg-white divide-y">
							<tr>
								<td
									colspan="2"
									class="whitespace-nowrap sm:pl-6 bg-slate-50 text-slate-900 py-2 pl-4 pr-3 text-sm font-medium">
									{{ code[0].product_code }}
									<span class="px-1">|</span>
									{{
										dayjs('1/1/1 ' + index).format('h:mm A')
									}}
								</td>
								<td
									class="whitespace-nowrap bg-slate-50 text-slate-900 px-3 py-2 text-sm font-medium text-center">
									{{
										code.reduce(
											(total, obj) => obj.adult + total,
											0
										)
									}}
								</td>
								<td
									class="whitespace-nowrap bg-slate-50 text-slate-900 px-3 py-2 text-sm font-medium text-center">
									{{
										code.reduce(
											(total, obj) => obj.child + total,
											0
										)
									}}
								</td>
								<td
									colspan="3"
									class="whitespace-nowrap sm:pl-6 bg-slate-50 text-slate-900 px-3 py-2 text-sm font-medium"></td>
							</tr>
							<tr
								v-for="item in code"
								class="group hover:bg-slate-50">
								<td
									class="whitespace-nowrap sm:pl-6 text-slate-900 py-2 pl-4 pr-3 text-sm font-medium">
									<Checkbox
										v-model="item.check_in"
										@mouseup="doneEdit(item)" />
								</td>
								<td
									class="whitespace-nowrap text-slate-500 px-3 py-2 text-sm">
									<span class="uppercase">{{
										item.last_name
									}}</span
									>, {{ item.first_name }}
								</td>
								<td
									class="whitespace-nowrap text-slate-500 px-3 py-2 text-sm text-center">
									{{ item.adult }}
								</td>
								<td
									class="whitespace-nowrap text-slate-500 px-3 py-2 text-sm text-center">
									{{ item.child }}
								</td>
								<td
									class="whitespace-nowrap text-slate-500 px-3 py-2 text-sm text-center">
									<InputBase
										type="text"
										v-model="item.guide"
										@blur="doneEdit(item)"
										@keyup.enter="doneEdit(item)"
										class="w-40" />
								</td>
								<td
									class="whitespace-nowrap text-slate-500 px-3 py-2 text-sm text-left">
									{{ item.email }}
								</td>
								<td
									class="text-slate-500 px-3 py-2 text-sm text-left">
									<InputBase
										type="text"
										v-model="item.note"
										@blur="doneEdit(item)"
										@keyup.enter="doneEdit(item)"
										class="w-60" />
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div v-else>No orders</div>
			</div>
		</div>
	</div>
</template>

<script setup>
	import { Inertia } from '@inertiajs/inertia';
	import dayjs from 'dayjs';
	import Checkbox from '@/Components/Checkbox.vue';
	import InputBase from '@/Components/InputBase.vue';
	import customParseFormat from 'dayjs/plugin/customParseFormat';
	dayjs.extend(customParseFormat);

	defineProps({
		manifest: Object
	});

	function doneEdit(item) {
		if (item) {
			Inertia.put(route('booking.update'), item, {
				preserveScroll: true
			});
		}
	}
</script>
