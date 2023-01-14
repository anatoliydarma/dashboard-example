<template>
	<div class="flex flex-col mt-8">
		<div class="-mx-px -my-2 overflow-x-auto">
			<div class="inline-block min-w-full px-px py-2 align-middle">
				<div
					class="ring-1 ring-black ring-opacity-5 overflow-hidden rounded-lg shadow"
					v-if="Object.keys(metrics.data).length">
					<slot />

					<table class="divide-slate-200 min-w-full divide-y">
						<thead
							class="bg-slate-50 text-slate-900 text-sm font-semibold">
							<tr>
								<th
									rowspan="2"
									scope="col"
									class="py-3.5 pl-4 pr-3 text-left sm:pl-6">
									Dates
								</th>
								<th
									colspan="4"
									scope="col"
									class="px-3 pt-2 text-center">
									Spoilage
								</th>
								<th
									colspan="4"
									scope="col"
									class="px-3 pt-2 text-center">
									Savings
								</th>
								<th
									colspan="2"
									scope="col"
									class="px-3 pt-2 text-right">
									Discrepancy
								</th>
								<th
									colspan="2"
									scope="col"
									class="px-3 pt-2 text-center">
									TC
								</th>
							</tr>
							<tr>
								<th
									scope="col"
									class="p-3 text-right">
									Needed
								</th>
								<th
									scope="col"
									class="p-3 text-right">
									Purchased
								</th>
								<th
									scope="col"
									class="p-3 text-right">
									Spoilage $
								</th>
								<th
									scope="col"
									class="p-3 pr-6 text-right">
									Spoilage %
								</th>
								<th
									scope="col"
									class="p-3 text-right">
									Manifest
								</th>
								<th
									scope="col"
									class="p-3 text-right">
									Purchased
								</th>
								<th
									scope="col"
									class="p-3 text-right">
									Savings $
								</th>
								<th
									scope="col"
									class="p-3 pr-6 text-right">
									Savings %
								</th>
								<th
									scope="col"
									class="p-3 text-right"></th>
								<th
									scope="col"
									class="p-3 text-right">
									#
								</th>
								<th
									scope="col"
									class="p-3 text-right">
									%
								</th>
								<th
									scope="col"
									class="p-3 pr-6 text-right"></th>
							</tr>
						</thead>
						<tbody
							class="divide-slate-200 text-slate-900 text-sm font-medium bg-white divide-y">
							<tr
								v-for="(item, i) in metrics.data"
								:key="i"
								class="hover:bg-slate-50 transition duration-300 ease-in-out bg-white">
								<td
									class="whitespace-nowrap sm:pl-6 border-slate-200 py-3 pl-4 pr-3 border-r">
									{{ item.date }}
								</td>
								<td class="whitespace-nowrap p-3 text-right">
									{{ item.needed }}
								</td>
								<td class="whitespace-nowrap p-3 text-right">
									{{ item.purchased }}
								</td>
								<td class="whitespace-nowrap p-3 text-right">
									{{ item.spoilage }}
								</td>
								<td
									class="whitespace-nowrap border-slate-200 p-3 pr-6 text-right border-r">
									{{ item.spoilage_procent }}
								</td>
								<td class="whitespace-nowrap p-3 text-right">
									{{ item.manifest }}
								</td>
								<td class="whitespace-nowrap p-3 text-right">
									{{ item.purchased }}
								</td>
								<td class="whitespace-nowrap p-3 text-right">
									{{ item.savings }}
								</td>
								<td
									class="whitespace-nowrap border-slate-200 p-3 pr-6 text-right border-r">
									{{ item.savings_procent }}
								</td>
								<td class="whitespace-nowrap p-3 text-right">
									<span
										v-if="item.discrepancy"
										class="text-red-600"
										>Y</span
									>
									<span v-else>N</span>
								</td>
								<td class="whitespace-nowrap p-3 text-right">
									{{ item.discrepancy_number }}
								</td>
								<td class="whitespace-nowrap p-3 text-right">
									{{ item.discrepancy_procent }}
								</td>
								<td
									class="whitespace-nowrap p-3 pr-6 text-right">
									<span v-if="item.tc">
										{{ item.tc.initials }}
									</span>
								</td>
							</tr>
						</tbody>
					</table>
					<Pagination
						:items="metrics"
						:dateRange="dateRange" />
				</div>
				<div v-else>No bookings</div>
			</div>
		</div>
	</div>
</template>

<script setup>
	import Pagination from '@/Components/Pagination.vue';

	const props = defineProps({
		metrics: Object,
		dateRange: Object
	});
</script>
