<template>
	<div class="flex flex-col mt-8">
		<div class="-mx-px -my-2 overflow-x-auto">
			<div class="inline-block min-w-full px-px py-2 align-middle">
				<div
					class="ring-1 ring-black ring-opacity-5 overflow-hidden rounded-lg shadow"
					v-if="Object.keys(items).length">
					<table class="divide-slate-300 min-w-full divide-y">
						<thead class="bg-slate-50">
							<tr>
								<th
									scope="col"
									class="pl-6 pr-3 py-3.5 text-left text-sm font-semibold text-slate-900">
									Date
								</th>
								<th
									scope="col"
									class="px-3 py-3.5 text-center text-sm font-semibold text-slate-900">
									Adult
								</th>
								<th
									scope="col"
									class="px-3 py-3.5 text-center text-sm font-semibold text-slate-900">
									Child
								</th>
								<th
									scope="col"
									class="px-3 py-3.5 text-center text-sm font-semibold text-slate-900">
									Total
								</th>
								<th
									scope="col"
									class="pr-6 pl-3 py-3.5 text-right text-sm font-semibold text-slate-900">
									% (24 hours)
								</th>
							</tr>
						</thead>
						<tbody class="divide-slate-200 bg-white divide-y">
							<tr
								v-for="(item, index) in items"
								:key="index"
								class="first: hover:bg-slate-50 transition duration-300 ease-in-out bg-white">
								<td
									class="whitespace-nowrap sm:pl-6 text-slate-900 py-3 pl-4 pr-3 text-sm font-medium">
									{{ item.date }}
								</td>
								<td
									class="whitespace-nowrap text-slate-500 px-3 py-3 text-sm text-center">
									{{ item.tickets_adult }}
								</td>
								<td
									class="whitespace-nowrap text-slate-500 px-3 py-3 text-sm text-center">
									{{ item.tickets_child }}
								</td>

								<td
									class="whitespace-nowrap text-slate-500 px-3 py-3 text-sm text-center">
									{{ item.tickets_total }}
								</td>

								<td
									class="whitespace-nowrap text-slate-500 py-3 pl-3 pr-6 text-sm text-right">
									<span v-if="index - 1 >= 0">
										{{
											(
												100 -
												(items[index - 1]
													.tickets_total /
													item.tickets_total) *
													100
											).toFixed(2)
										}}
									</span>
									<span v-else> N/A </span>
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
	const props = defineProps({
		items: Object
	});
</script>
