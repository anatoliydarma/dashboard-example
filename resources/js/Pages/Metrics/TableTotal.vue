<template>
	<div class="flex flex-col mt-8">
		<div class="pb-1 text-lg font-semibold">Total</div>
		<div class="-mx-px -my-2 overflow-x-auto">
			<div class="inline-block min-w-full px-px py-2 align-middle">
				<div
					class="ring-1 ring-black ring-opacity-5 overflow-hidden rounded-lg shadow"
					v-if="total">
					<slot />

					<table class="divide-slate-200 min-w-full divide-y">
						<thead
							class="bg-slate-50 text-slate-900 text-sm font-semibold">
							<tr>
								<th
									rowspan="2"
									class="sm:pl-6 pt-2 pl-4 pr-3 text-left">
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
									scope="col"
									class="px-3 pt-2 text-right">
									Discrepancy
								</th>
								<th
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
									class="p-3 text-right">
									#
								</th>
								<th
									scope="col"
									class="p-3 pr-6 text-right">
									%
								</th>
							</tr>
						</thead>
						<tbody
							class="divide-slate-200 text-slate-900 text-sm font-medium bg-white divide-y">
							<tr
								class="hover:bg-slate-50 transition duration-300 ease-in-out bg-white">
								<td
									class="whitespace-nowrap sm:pl-6 border-slate-200 py-3 pl-4 pr-3 border-r">
									{{ total.date }}
								</td>
								<td class="whitespace-nowrap p-3 text-right">
									{{ total.needed }}
								</td>
								<td class="whitespace-nowrap p-3 text-right">
									{{ total.purchased }}
								</td>
								<td class="whitespace-nowrap p-3 text-right">
									{{ total.spoilage }}
								</td>
								<td
									class="whitespace-nowrap border-slate-200 p-3 pr-6 text-right border-r">
									{{ total.spoilage_procent }}
								</td>
								<td class="whitespace-nowrap p-3 text-right">
									{{ total.manifest }}
								</td>
								<td class="whitespace-nowrap p-3 text-right">
									{{ total.purchased }}
								</td>
								<td class="whitespace-nowrap p-3 text-right">
									{{ total.savings }}
								</td>
								<td
									class="whitespace-nowrap border-slate-200 p-3 pr-6 text-right border-r">
									{{ total.savings_procent }}
								</td>

								<td class="whitespace-nowrap p-3 text-right">
									{{ total.discrepancy_number }}
								</td>
								<td
									class="whitespace-nowrap p-3 pr-6 text-right">
									{{ total.discrepancy_procent }}
								</td>
							</tr>

							<tr
								v-if="totalTc.length"
								v-for="(tc, i) in totalTc"
								:key="i"
								class="hover:bg-slate-50 transition duration-300 ease-in-out bg-white">
								<td
									class="whitespace-nowrap sm:pl-6 border-slate-200 py-3 pl-4 pr-3 border-r">
									{{ tc.tc.initials }}
								</td>
								<td class="whitespace-nowrap p-3 text-right">
									{{ tc.needed }}
								</td>
								<td class="whitespace-nowrap p-3 text-right">
									{{ tc.purchased }}
								</td>
								<td class="whitespace-nowrap p-3 text-right">
									{{ tc.spoilage }}
								</td>
								<td
									class="whitespace-nowrap border-slate-200 p-3 pr-6 text-right border-r">
									{{ tc.spoilage_procent }}
								</td>
								<td class="whitespace-nowrap p-3 text-right">
									{{ tc.manifest }}
								</td>
								<td class="whitespace-nowrap p-3 text-right">
									{{ tc.purchased }}
								</td>
								<td class="whitespace-nowrap p-3 text-right">
									{{ tc.savings }}
								</td>
								<td
									class="whitespace-nowrap border-slate-200 p-3 pr-6 text-right border-r">
									{{ tc.savings_procent }}
								</td>

								<td class="whitespace-nowrap p-3 text-right">
									{{ tc.discrepancy_number }}
								</td>
								<td
									class="whitespace-nowrap p-3 pr-6 text-right">
									{{ tc.discrepancy_procent }}
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
	const props = defineProps({
		total: Object,
		totalTc: Object
	});
</script>
