<template>
	<div class="md:space-y-6 space-y-4">
		<div class="md:gap-6 flex gap-4">
			<div
				class="md:px-6 md:py-5 ring-1 ring-black ring-opacity-5 w-6/12 px-4 py-3 space-y-2 overflow-hidden bg-white rounded-lg shadow">
				<div
					class="md:items-start md:flex-row flex flex-col items-center justify-between gap-1">
					<h2 class="text-slate-900 text-xl font-semibold">
						Spoilage
					</h2>
					<div
						class="text-sm"
						:class="[
							stats.spoilage > 0
								? 'text-red-500'
								: 'text-slate-900'
						]">
						({{ stats.spoilage_procent }}%)
						<span class="text-xl font-bold">
							{{ stats.spoilage }}
						</span>
					</div>
				</div>
				<div
					class="md:items-start flex flex-col items-center justify-between w-full gap-1">
					<div class="flex items-center justify-between w-full gap-2">
						<h3 class="text-slate-500 text-sm font-medium">
							Purchased
						</h3>
						<span
							class="text-sm font-medium text-right"
							:class="[
								stats.purchased > stats.needed
									? 'text-orange-500'
									: 'text-slate-900'
							]">
							{{ stats.purchased }}
						</span>
					</div>
					<div class="flex items-center justify-between w-full gap-2">
						<h3 class="text-slate-500 text-sm font-medium">
							Needed
						</h3>
						<div
							class="text-slate-900 text-sm font-medium text-right">
							{{ stats.needed }}
						</div>
					</div>
				</div>
			</div>

			<div
				class="md:px-6 md:py-5 ring-1 ring-black ring-opacity-5 w-6/12 px-4 py-3 space-y-2 overflow-hidden bg-white rounded-lg shadow">
				<div
					class="md:items-start md:flex-row flex flex-col items-center justify-between gap-1">
					<h2 class="text-slate-900 text-xl font-semibold">
						Savings
					</h2>
					<div
						class="text-sm"
						:class="[
							stats.savings_procent > 0
								? 'text-green-600'
								: 'text-slate-900'
						]">
						({{ stats.savings_procent }}%)
						<span class="text-xl font-bold">
							{{ stats.savings }}
						</span>
					</div>
				</div>
				<div
					class="md:items-start flex flex-col items-center justify-between w-full gap-1">
					<div class="flex items-center justify-between w-full gap-2">
						<h3 class="text-slate-500 text-sm font-medium">
							Final Manifest
						</h3>
						<div class="text-sm font-medium text-right">
							{{ stats.final_manifest }}
						</div>
					</div>
					<div class="flex items-center justify-between w-full gap-2">
						<h3 class="text-slate-500 text-sm font-medium">
							Purchased
						</h3>
						<p
							class="text-slate-900 text-sm font-medium text-right"
							:class="[
								stats.final_manifest > stats.purchased
									? 'text-orange-500'
									: 'text-slate-900'
							]">
							{{ stats.purchased }}
						</p>
					</div>
				</div>
			</div>
		</div>
		<div
			class="ring-1 ring-black ring-opacity-5 overflow-hidden rounded-lg shadow">
			<table class="divide-slate-300 min-w-full divide-y">
				<thead class="bg-slate-50">
					<tr>
						<th
							scope="col"
							class="sm:pl-6 text-slate-900 py-2 pl-4 pr-3 text-sm font-semibold text-left">
							#
						</th>
						<th
							scope="col"
							class="text-slate-900 px-3 py-2 text-sm font-semibold text-left">
							Adults
						</th>
						<th
							scope="col"
							class="sm:pr-6 py-2 pl-3 pr-4 text-sm font-semibold">
							Children
						</th>
					</tr>
				</thead>
				<tbody
					class="text-slate-900 divide-slate-200 bg-white divide-y">
					<tr>
						<td
							class="whitespace-nowrap sm:pl-6 py-2 pl-4 pr-3 text-sm font-medium">
							On Manifest
						</td>

						<td
							class="whitespace-nowrap px-3 py-2 text-sm text-right">
							{{ stats.manifest_adult }}
						</td>
						<td
							class="whitespace-nowrap sm:pr-6 py-2 pl-3 pr-4 text-sm text-right">
							{{ stats.manifest_child }}
						</td>
					</tr>
					<tr>
						<td
							class="whitespace-nowrap sm:pl-6 py-2 pl-4 pr-3 text-sm font-medium">
							Tickets purchased
						</td>

						<td
							class="whitespace-nowrap px-3 py-2 text-sm text-right">
							{{ stats.purchased_adult }}
						</td>
						<td
							class="whitespace-nowrap sm:pr-6 py-2 pl-3 pr-4 text-sm text-right">
							{{ stats.purchased_child }}
						</td>
					</tr>
					<tr>
						<td
							class="whitespace-nowrap sm:pl-6 py-2 pl-4 pr-3 text-sm font-medium">
							Add-ons
						</td>

						<td
							class="whitespace-nowrap px-3 py-2 text-sm text-right">
							{{ stats.add_on_adult }}
						</td>
						<td
							class="whitespace-nowrap sm:pr-6 py-2 pl-3 pr-4 text-sm text-right">
							{{ stats.add_on_child }}
						</td>
					</tr>
					<tr>
						<td
							class="whitespace-nowrap sm:pl-6 py-2 pl-4 pr-3 text-sm font-medium">
							No shows
						</td>

						<td
							class="whitespace-nowrap px-3 py-2 text-sm text-right">
							{{ stats.no_shows_adult }}
						</td>
						<td
							class="whitespace-nowrap sm:pr-6 py-2 pl-3 pr-4 text-sm text-right">
							{{ stats.no_shows_child }}
						</td>
					</tr>
					<tr>
						<td
							class="whitespace-nowrap sm:pl-6 py-2 pl-4 pr-3 text-sm font-medium">
							Adjustment
						</td>

						<td
							class="whitespace-nowrap px-3 py-2 text-sm text-right">
							{{ stats.adjustment_adult }}
						</td>
						<td
							class="whitespace-nowrap sm:pr-6 py-2 pl-3 pr-4 text-sm text-right">
							{{ stats.adjustment_child }}
						</td>
					</tr>
					<tr>
						<td
							class="sm:pl-6 py-2 pl-4 pr-3 text-sm font-medium leading-tight whitespace-normal">
							Tickets needed
							<span class="text-xs"
								>(on Manifest - no shows + add-ons)</span
							>
						</td>

						<td
							class="whitespace-nowrap px-3 py-2 text-sm text-right">
							{{ stats.tickets_needed_adult }}
						</td>
						<td
							class="whitespace-nowrap sm:pr-6 py-2 pl-3 pr-4 text-sm text-right">
							{{ stats.tickets_needed_child }}
						</td>
					</tr>
					<tr>
						<td
							class="sm:pl-6 py-2 pl-4 pr-3 text-sm font-medium leading-tight whitespace-normal">
							Cost
						</td>

						<td
							colspan="2"
							class="whitespace-nowrap px-3 py-2 text-sm text-center">
							{{ stats.cost }}
						</td>
					</tr>
					<tr>
						<td
							class="sm:pl-6 py-2 pl-4 pr-3 text-sm font-medium leading-tight whitespace-normal">
							Reserved
						</td>

						<td
							colspan="2"
							class="whitespace-nowrap px-3 py-2 text-sm text-center">
							{{ stats.reserved }}
						</td>
					</tr>
					<tr>
						<td
							class="sm:pl-6 py-2 pl-4 pr-3 text-sm font-medium leading-tight whitespace-normal">
							<span
								:class="[
									stats.discrepancy ? 'text-red-600' : ''
								]"
								>Discrepancy</span
							>
							<span class="pl-2 text-sm font-semibold">
								<span
									v-if="stats.discrepancy"
									class="text-red-600"
									>Yes</span
								>
								<span v-else>No</span>
							</span>
						</td>

						<td
							class="whitespace-nowrap px-3 py-2 text-sm text-right">
							{{ stats.discrepancy_adult }}
						</td>
						<td
							class="whitespace-nowrap sm:pr-6 py-2 pl-3 pr-4 text-sm text-right">
							{{ stats.discrepancy_child }}
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script setup>
	const props = defineProps({
		stats: Object
	});
</script>
