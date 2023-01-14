<template>
	<div class="flex flex-col mt-8">
		<div class="-mx-px -my-2 overflow-x-auto">
			<div class="inline-block min-w-full px-px py-2 align-middle">
				<div
					class="ring-1 ring-black ring-opacity-5 overflow-hidden rounded-lg shadow"
					v-if="Object.keys(items).length">
					<table class="divide-slate-300 min-w-full divide-y">
						<thead
							class="bg-slate-50 text-slate-900 text-sm text-center">
							<tr>
								<th
									rowspan="2"
									scope="col"
									class="py-3.5 pl-4 pr-3 text-left font-semibold sm:pl-6">
									Dates
								</th>
								<th
									colspan="2"
									scope="col"
									class="px-3 pt-3.5 font-semibold">
									Actual
								</th>
								<th
									colspan="2"
									scope="col"
									class="px-3 pt-3.5 font-semibold">
									Purchased
								</th>
								<th
									colspan="3"
									scope="col"
									class="px-2 pt-3.5 font-semibold space-x-2">
									<span>Reserved A</span>
									<ButtonEmpty
										@click="showBC = !showBC"
										:class="[
											showBC
												? 'bg-indigo-500 text-white'
												: 'bg-slate-200'
										]"
										class="hover:bg-indigo-600 hover:text-white text-xs rounded-lg"
										>B+C
									</ButtonEmpty>
								</th>
								<th
									v-if="showBC"
									colspan="3"
									scope="col"
									class="px-3 pt-3.5 font-semibold">
									<span>Reserved B</span>
								</th>
								<th
									v-if="showBC"
									colspan="3"
									scope="col"
									class="px-3 pt-3.5 font-semibold bg-slate-100">
									<span>Reserved C</span>
								</th>
								<th
									rowspan="2"
									scope="col"
									class="w-56 px-3 pt-3.5 font-semibold">
									Note
								</th>
								<th
									rowspan="2"
									scope="col"
									class="px-3 pt-3.5 font-semibold">
									Total reserved
								</th>
							</tr>
							<tr>
								<th
									scope="col"
									class="px-3 py-3.5 font-semibold">
									Adult
								</th>
								<th
									scope="col"
									class="px-3 py-3.5 font-semibold">
									Child
								</th>
								<th
									scope="col"
									class="px-3 py-3.5 font-semibold">
									Adult
								</th>
								<th
									scope="col"
									class="px-3 py-3.5 font-semibold">
									Child
								</th>
								<th class="px-3 font-semibold">Reserved</th>
								<th
									scope="col"
									class="px-3 font-semibold">
									<div>Time</div>
								</th>
								<th
									scope="col"
									class="px-3 font-semibold">
									<div>Confirm</div>
								</th>
								<th
									v-if="showBC"
									scope="col"
									class="px-3 font-semibold">
									<div class="">Reserved</div>
								</th>
								<th
									v-if="showBC"
									scope="col"
									class="px-3 font-semibold">
									<div>Time</div>
								</th>
								<th
									v-if="showBC"
									scope="col"
									class="even: px-3 font-semibold">
									<div>Confirm</div>
								</th>
								<th
									v-if="showBC"
									scope="col"
									class="bg-slate-100 px-3 font-semibold">
									<div class="">Reserved</div>
								</th>
								<th
									v-if="showBC"
									scope="col"
									class="bg-slate-100 px-3 font-semibold">
									<div>Time</div>
								</th>
								<th
									v-if="showBC"
									scope="col"
									class="bg-slate-100 px-3 font-semibold">
									<div>Confirm</div>
								</th>
							</tr>
						</thead>
						<tbody class="divide-slate-200 bg-white divide-y">
							<tr
								v-for="(item, i) in items"
								:key="i"
								class="first: hover:bg-slate-50 text-slate-600 text-sm text-center transition duration-300 ease-in-out bg-white">
								<td
									class="whitespace-nowrap sm:pl-6 text-slate-900 py-3 pl-4 pr-3 font-medium">
									{{ item.date }}
								</td>
								<td class="whitespace-nowrap px-3 py-3">
									{{ item.tickets_adult }}
								</td>
								<td class="whitespace-nowrap px-3 py-3">
									{{ item.tickets_child }}
								</td>

								<td class="whitespace-nowrap px-3 py-3">
									{{ item.purchased_adult }}
									<span class="font-semibold"
										>({{
											item.tickets_adult -
											item.purchased_adult
										}})</span
									>
								</td>
								<td class="whitespace-nowrap px-3 py-3">
									{{ item.purchased_child }}
									<span class="font-semibold"
										>({{
											item.tickets_child -
											item.purchased_child
										}})</span
									>
								</td>
								<td class="w-20 px-2 py-3">
									<InputBase
										type="text"
										v-model="item.reserved_a"
										@blur="doneEdit(item)"
										@keyup.enter="doneEdit(item)" />
								</td>
								<td class="w-32 px-2 py-3">
									<Select
										v-model="item.time_a"
										@change="doneEdit(item)">
										<option
											v-for="time in times"
											:value="time">
											{{
												dayjs('1/1/1 ' + time).format(
													'h:mm A'
												)
											}}
										</option>
									</Select>
								</td>
								<td class="w-28 px-2 py-3">
									<InputBase
										type="text"
										v-model="item.confirm_a"
										@blur="doneEdit(item)"
										@keyup.enter="doneEdit(item)" />
								</td>
								<td
									v-if="showBC"
									class="bg-slate-50 whitespace-nowrap px-2 py-3">
									<InputBase
										type="text"
										v-model="item.reserved_b"
										@blur="doneEdit(item)"
										@keyup.enter="doneEdit(item)"
										class="w-20" />
								</td>
								<td
									v-if="showBC"
									class="bg-slate-50 whitespace-nowrap px-2 py-3">
									<Select
										v-model="item.time_b"
										@change="doneEdit(item)"
										class="w-32">
										<option
											v-for="time in times"
											:key="time"
											:value="time">
											{{
												dayjs('1/1/1 ' + time).format(
													'h:mm A'
												)
											}}
										</option>
									</Select>
								</td>
								<td
									v-if="showBC"
									class="bg-slate-50 whitespace-nowrap px-2 py-3">
									<InputBase
										type="text"
										v-model="item.confirm_b"
										@blur="doneEdit(item)"
										@keyup.enter="doneEdit(item)"
										class="w-28" />
								</td>
								<td
									v-if="showBC"
									class="bg-slate-100 px-2 py-3">
									<InputBase
										type="text"
										v-model="item.reserved_c"
										@blur="doneEdit(item)"
										@keyup.enter="doneEdit(item)"
										class="w-20" />
								</td>
								<td
									v-if="showBC"
									class="bg-slate-100 px-2 py-3">
									<Select
										v-model="item.time_c"
										@change="doneEdit(item)"
										class="w-32">
										<option
											v-for="time in times"
											:key="time"
											:value="time">
											{{
												dayjs('1/1/1 ' + time).format(
													'h:mm A'
												)
											}}
										</option>
									</Select>
								</td>
								<td
									v-if="showBC"
									class="bg-slate-100 px-2 py-3">
									<InputBase
										type="text"
										v-model="item.confirm_c"
										@blur="doneEdit(item)"
										@keyup.enter="doneEdit(item)"
										class="w-28" />
								</td>
								<td class="whitespace-nowrap px-2 py-3">
									<InputBase
										type="text"
										v-model="item.note"
										@blur="doneEdit(item)"
										@keyup.enter="doneEdit(item)"
										class="w-56" />
								</td>
								<td class="whitespace-nowrap py-3 pl-3 pr-6">
									{{ item.reserved_total }}
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div v-else>No bookings</div>
			</div>
		</div>
	</div>
</template>

<script setup>
	import ButtonEmpty from '@/Components/ButtonEmpty.vue';
	import Select from '@/Components/Select.vue';
	import InputBase from '@/Components/InputBase.vue';
	import { Inertia } from '@inertiajs/inertia';
	import dayjs from 'dayjs';
	import customParseFormat from 'dayjs/plugin/customParseFormat';
	dayjs.extend(customParseFormat);

	const props = defineProps({
		items: Object,
		times: Array
	});

	let showBC = ref(false);

	function doneEdit(item) {
		console.log(item.time_a);
		if (item) {
			let data = {
				date: item.id,
				time_a: item.time_a,
				reserved_a: item.reserved_a ? item.reserved_a : 0,
				confirm_a: item.confirm_a,
				time_b: item.time_b,
				reserved_b: item.reserved_b ? item.reserved_b : 0,
				confirm_b: item.confirm_b,
				time_c: item.time_c,
				reserved_c: item.reserved_c ? item.reserved_c : 0,
				confirm_c: item.confirm_c,
				note: item.note
			};
			Inertia.put(route('day.update'), data, {
				preserveScroll: true
			});
		}
	}
</script>
