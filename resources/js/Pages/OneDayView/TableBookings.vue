<template>
	<div class="flex flex-col mt-8">
		<div class="-mx-px -my-2 overflow-x-auto">
			<div class="inline-block min-w-full px-px py-2 align-middle">
				<div
					class="ring-1 ring-black ring-opacity-5 overflow-hidden rounded-lg shadow"
					v-if="items.length">
					<table class="divide-slate-300 min-w-full divide-y">
						<thead class="bg-slate-50">
							<tr>
								<th
									colspan="2"
									rowspan="2"
									scope="col"
									class="sm:pl-6 text-slate-900 py-2 pl-4 pr-3 text-sm font-semibold text-left">
									Tour name
								</th>
								<th
									rowspan="2"
									scope="col"
									class="text-slate-900 px-3 py-2 text-sm font-semibold text-left">
									Time
								</th>
								<th
									colspan="2"
									scope="col"
									class="text-slate-900 px-3 py-2 text-sm font-semibold text-center">
									Manifest
								</th>
								<th
									colspan="2"
									scope="col"
									class="text-slate-900 px-3 py-2 text-sm font-semibold text-center">
									Running Count
								</th>
								<th
									colspan="2"
									scope="col"
									class="text-slate-900 px-3 py-2 text-sm font-semibold text-center">
									No Shows
								</th>
								<th
									colspan="2"
									scope="col"
									class="text-slate-900 px-3 py-2 text-sm font-semibold text-center">
									Add ons
								</th>
							</tr>
							<tr>
								<th
									scope="col"
									class="text-slate-900 w-20 px-3 py-2 text-sm font-semibold text-right">
									Adult
								</th>
								<th
									scope="col"
									class="whitespace-nowrap w-20 px-3 py-3 text-sm text-right">
									Child
								</th>
								<th
									scope="col"
									class="w-16 py-3 pl-3 pr-3 text-sm">
									{{ runningCount.total.preorder_adult }}
								</th>
								<th
									scope="col"
									class="w-16 py-3 pl-3 pr-3 text-sm">
									{{ runningCount.total.preorder_child }}
								</th>
								<th
									scope="col"
									class="text-slate-900 w-20 px-3 py-2 text-sm font-semibold text-right">
									Adult
								</th>
								<th
									scope="col"
									class="whitespace-nowrap w-20 px-3 py-2 text-sm text-right">
									Child
								</th>
								<th
									scope="col"
									class="text-slate-900 w-20 px-3 py-2 text-sm font-semibold text-right">
									Adult
								</th>
								<th
									scope="col"
									class="whitespace-nowrap w-20 px-3 py-2 text-sm text-right">
									Child
								</th>
							</tr>
						</thead>
						<tbody class="divide-slate-200 bg-white divide-y">
							<tr
								v-for="(item, index) in items"
								:key="item.product_id">
								<td
									class="whitespace-nowrap sm:pl-6 text-slate-900 py-3 pl-4 pr-3 text-sm font-medium">
									{{ item.product_code }}
								</td>
								<td
									class="whitespace-nowrap text-slate-500 px-3 py-3 text-sm">
									<div
										class="xl:w-full w-44 truncate"
										:title="item.product_name">
										{{ item.product_name }}
									</div>
								</td>
								<td
									class="whitespace-nowrap text-slate-500 px-3 py-3 text-sm">
									{{
										dayjs('1/1/1 ' + item.tour_time).format(
											'h:mm A'
										)
									}}
								</td>
								<td
									class="whitespace-nowrap text-slate-500 py-3 pl-3 pr-6 text-sm font-semibold text-right">
									{{ item.adult }}
								</td>
								<td
									class="whitespace-nowrap text-slate-500 py-3 pl-3 pr-6 text-sm font-semibold text-right">
									{{ item.child }}
								</td>
								<td
									class="whitespace-nowrap bg-slate-50 text-slate-500 py-3 pl-3 pr-6 text-sm text-right">
									<span
										v-if="
											runningCount.total.preorder_adult !=
											0
										">
										{{ runningCount.data[index].adult }}
									</span>
								</td>
								<td
									class="whitespace-nowrap bg-slate-50 text-slate-500 py-3 pl-3 pr-6 text-sm text-right">
									<span
										v-if="
											runningCount.total.preorder_child !=
											0
										">
										{{ runningCount.data[index].child }}
									</span>
								</td>
								<td
									class="whitespace-nowrap text-slate-500 py-3 pl-3 pr-6 text-sm text-right">
									<span
										v-if="
											items[
												index - 1 >= 0 ? index - 1 : 0
											].tour_time != item.tour_time
										">
										{{ item.adult_no_shows }}
									</span>
									<span v-else-if="index === 0">
										{{ item.adult_no_shows }}
									</span>
									<span v-else> 0 </span>
								</td>
								<td
									class="whitespace-nowrap text-slate-500 py-3 pl-3 pr-6 text-sm text-right">
									<span
										v-if="
											items[
												index - 1 >= 0 ? index - 1 : 0
											].tour_time != item.tour_time
										">
										{{ item.child_no_shows }}
									</span>
									<span v-else-if="index === 0">
										{{ item.child_no_shows }}
									</span>
									<span v-else> 0 </span>
								</td>
								<td
									class="whitespace-nowrap text-slate-500 py-3 pl-3 pr-6 text-sm text-right">
									<span
										v-if="
											items[
												index - 1 >= 0 ? index - 1 : 0
											].tour_time != item.tour_time
										">
										{{ item.adult_add_on }}
									</span>
									<span v-else-if="index === 0">
										{{ item.adult_add_on }}
									</span>
									<span v-else> 0 </span>
								</td>
								<td
									class="whitespace-nowrap text-slate-500 py-3 pl-3 pr-6 text-sm text-right">
									<span
										v-if="
											items[
												index - 1 >= 0 ? index - 1 : 0
											].tour_time != item.tour_time
										">
										{{ item.child_add_on }}
									</span>
									<span v-else-if="index === 0">
										{{ item.child_add_on }}
									</span>
									<span v-else> 0 </span>
								</td>
							</tr>
						</tbody>
						<tfoot class="bg-slate-50 font-bold border-t">
							<tr>
								<th
									colspan="3"
									class="whitespace-nowrap sm:pl-6 text-slate-900 py-3 pl-4 pr-3 text-sm font-medium text-left">
									Subtotal
								</th>
								<th class="py-3 pl-3 pr-6 text-sm text-right">
									{{ stats.manifest_adult }}
								</th>
								<th class="py-3 pl-3 pr-6 text-sm text-right">
									{{ stats.manifest_child }}
								</th>
								<th
									class="px-3 pt-1 pb-2 pr-6 text-sm text-right">
									{{ runningCount.total.end_adult }}
								</th>
								<th
									class="pt-1 pb-2 pl-4 pr-6 text-sm text-right">
									{{ runningCount.total.end_child }}
								</th>
								<th
									colspan="4"
									class="py-3 pl-4 pr-6 text-left">
									<div
										v-if="
											stats.discrepancy &&
											hasEndOfDay &&
											!isFieldsFilled
										"
										class="font-normal text-red-600">
										Incomplete, please fill the fields.
									</div>
								</th>
							</tr>
							<tr class="bg-slate-50 border-t">
								<th
									colspan="3"
									class="whitespace-nowrap sm:pl-6 text-slate-900 py-3 pl-4 pr-3 text-sm font-medium text-left">
									Total
								</th>
								<th
									colspan="2"
									class="px-4 py-3 text-sm text-center">
									{{ stats.final_manifest }}
								</th>
								<th
									colspan="6"
									class="py-2 pl-0 pr-4 text-sm text-center">
									<div
										class="flex justify-between w-full gap-4 font-normal">
										<InputBase
											v-model="dayArray.note"
											@blur="doneEdit(dayArray)"
											:class="{
												'border-red-600 border':
													stats.discrepancy &&
													hasEndOfDay &&
													!dayArray.note
											}"
											placeholder="Note" />

										<Select
											v-if="
												stats.discrepancy && hasEndOfDay
											"
											v-model="dayArray.discrepancy"
											@change="doneEdit(dayArray)"
											:class="{
												'border-red-600 border':
													stats.discrepancy &&
													!dayArray.discrepancy
											}"
											class="w-44">
											<option value="">
												No discrepancy
											</option>
											<option
												v-for="(
													item, key
												) in discrepancyTypes"
												:key="key"
												:value="key">
												{{ item }}
											</option>
										</Select>
									</div>
								</th>
							</tr>
						</tfoot>
					</table>
				</div>
				<div v-else>No bookings</div>
			</div>
		</div>
	</div>
</template>

<script setup>
	import InputBase from '@/Components/InputBase.vue';
	import Select from '@/Components/Select.vue';
	import dayjs from 'dayjs';
	import { Inertia } from '@inertiajs/inertia';

	const props = defineProps({
		items: Object,
		stats: Object,
		dayData: Object,
		date: String,
		runningCount: Object,
		discrepancyTypes: Object,
		hasEndOfDay: Boolean
	});

	let dayArray = ref(props.dayData ? props.dayData : []);

	function doneEdit(item) {
		if (item) {
			let data = {
				note: item.note ? item.note : '',
				discrepancy: item.discrepancy ? item.discrepancy : null,
				date: dayjs(props.date).format('YYYY-MM-DD').toString()
			};
			Inertia.put(route('day.update.start'), data, {
				preserveScroll: true
			});
		}
	}

	const isFieldsFilled = computed(() => {
		return dayArray.value.note && dayArray.value.discrepancy ? true : false;
	});
</script>
