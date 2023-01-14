<template>
	<div class="flex flex-col mt-8">
		<div class="lg:flex-row flex flex-col justify-between gap-6">
			<div class="lg:w-7/12 w-full space-y-2">
				<div class="flex items-center justify-between gap-4">
					<PageTitle>Orders on {{ humanDate }}</PageTitle>
					<button
						@click="openForm()"
						type="button"
						class="hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto md:mr-0 inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm">
						<i-tabler-plus />
					</button>
				</div>

				<div class="-mx-px -my-2 overflow-x-auto">
					<div
						class="inline-block min-w-full px-px py-2 align-middle">
						<div
							class="ring-1 ring-black ring-opacity-5 overflow-hidden rounded-lg shadow"
							v-if="orders.length">
							<table class="divide-slate-300 min-w-full divide-y">
								<thead class="bg-slate-50">
									<tr>
										<th
											scope="col"
											class="sm:pl-6 text-slate-900 py-2 pl-4 pr-3 text-sm font-semibold text-left">
											Action
										</th>
										<th
											scope="col"
											class="text-slate-900 px-3 py-2 text-sm font-semibold text-left">
											Time
										</th>
										<th
											scope="col"
											class="text-slate-900 px-3 py-2 text-sm font-semibold text-right">
											Cost
										</th>
										<th
											scope="col"
											class="text-slate-900 px-3 py-2 text-sm font-semibold text-left">
											Note
										</th>
										<th
											scope="col"
											class="text-slate-900 px-3 py-2 text-sm font-semibold text-right">
											Adult
										</th>
										<th
											scope="col"
											class="text-slate-900 px-3 py-2 text-sm font-semibold text-right">
											Child
										</th>
										<th
											scope="col"
											class="text-slate-900 px-3 py-2 text-sm font-semibold text-center"></th>
									</tr>
								</thead>
								<tbody
									class="divide-slate-200 bg-white divide-y">
									<tr
										v-for="(order, i) in orders"
										:key="i"
										class="group hover:bg-slate-50">
										<td
											class="whitespace-nowrap sm:pl-6 text-slate-900 py-2 pl-4 pr-3 text-sm font-medium">
											{{
												options.find(
													(element) =>
														element.key ===
														order.option
												).label
											}}
										</td>
										<td
											class="whitespace-nowrap text-slate-500 px-3 py-2 text-sm">
											<span
												v-if="
													order.time !== '00:00:00'
												">
												{{
													order.time.substring(
														0,
														order.time.length - 3
													)
												}}
											</span>
										</td>
										<td
											class="whitespace-nowrap text-slate-500 px-3 py-2 text-sm text-right">
											{{ order.cost }}
										</td>
										<td
											class="whitespace-nowrap text-slate-500 px-3 py-2 text-sm text-left">
											<span v-if="order.option == 'end'">
												{{ getTcInitials }}
											</span>
											<div
												v-else
												class="max-w-xs truncate">
												{{ order.note }}
											</div>
										</td>
										<td
											class="whitespace-nowrap text-slate-500 px-3 py-2 text-sm text-right">
											{{ order.adult }}
										</td>
										<td
											class="whitespace-nowrap text-slate-500 px-3 py-2 text-sm text-right">
											{{ order.child }}
										</td>
										<td
											class="whitespace-nowrap text-slate-500 py-2 pl-3 pr-4 text-sm text-right">
											<div
												class="lg:invisible group-hover:visible flex justify-end gap-1">
												<ButtonEmpty
													class="hover text-indigo-500"
													@click="editRow(order)"
													type="">
													<i-tabler-pencil />
												</ButtonEmpty>
												<ButtonEmpty
													class="hover text-red-500"
													@click="onDelete(order)"
													type="">
													<i-tabler-trash />
												</ButtonEmpty>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div
							v-else
							class="text-center">
							No orders
						</div>
					</div>
				</div>
			</div>
			<div class="lg:w-5/12 lg:pt-14 md:px-0 w-full mt-1">
				<slot name="stats"></slot>
			</div>
		</div>
	</div>
	<Modal
		:submit="deleteRecord"
		ref="deleteModal" />

	<Offcanvas v-model:open="open">
		<div class="py-8">
			<form
				@submit.prevent="submit"
				class="flex flex-wrap items-start justify-start gap-4">
				<Select
					v-model="form.option"
					:error="errors.option"
					label="Option"
					:disabled="form.option === 'end'">
					<option
						v-for="item in options"
						:key="item.key"
						:value="item.key"
						:disabled="item.key == 'end' && offEnd">
						{{ item.label }}
					</option>
				</Select>

				<Select
					v-model="form.time"
					:error="errors.time"
					label="Time"
					:disabled="
						form.option === 'start' || form.option === 'end'
					">
					<option
						v-for="item in times"
						:key="item"
						:value="item">
						{{ dayjs(item, 'HH:mm:ss').format('HH:mm') }}
					</option>
				</Select>

				<InputBase
					v-model="form.cost"
					:error="errors.cost"
					class="w-24"
					label="Cost"
					:disabled="form.option === 'end'" />

				<div v-if="form.option === 'end'">
					<Select
						v-model="form.tc"
						:error="errors.tc"
						label="Tour Concierge"
						class="w-28">
						<option value=""></option>
						<option
							v-for="item in tourConcierges"
							:key="item.id"
							:value="item.id">
							{{ item.initials }}
						</option>
					</Select>
				</div>

				<InputBase
					v-else
					v-model="form.note"
					:error="errors.note"
					label="Note"
					class="w-full max-w-xs" />

				<InputBase
					v-model="form.adult"
					:error="errors.adult"
					label="Adult"
					type="number"
					class="w-24"
					placeholder="0" />

				<InputBase
					v-model="form.child"
					:error="errors.child"
					label="Child"
					type="number"
					class="w-24"
					placeholder="0" />

				<div class="md:pt-7 lg:ml-5">
					<ButtonBase :disabled="loading">
						<i-tabler-loader
							v-if="loading"
							class="animate-spin w-5 h-5 mr-2" />
						<span v-if="form.id === null">Create</span>
						<span v-else>Update</span>
					</ButtonBase>
				</div>
			</form>
		</div>
	</Offcanvas>
</template>

<script setup>
	import Offcanvas from '@/Components/Offcanvas.vue';
	import PageTitle from '@/Components/PageTitle.vue';
	import Select from '@/Components/Select.vue';
	import InputBase from '@/Components/InputBase.vue';
	import ButtonBase from '@/Components/Button.vue';
	import ButtonEmpty from '@/Components/ButtonEmpty.vue';
	import Modal from '@/Components/Modal.vue';
	import { Inertia } from '@inertiajs/inertia';
	import { usePage } from '@inertiajs/inertia-vue3';
	import dayjs from 'dayjs';
	import customParseFormat from 'dayjs/plugin/customParseFormat';
	dayjs.extend(customParseFormat);

	const props = defineProps({
		orders: Object,
		options: Object,
		times: Object,
		date: String,
		tourConcierges: Object,
		errors: Object,
		info: String,
		tc: Number
	});

	let open = ref(false);
	let humanDate = ref(dayjs(props.date).format('MMM D, YYYY'));
	let loading = ref(false);

	const initialState = {
		id: null,
		option: props.options[0].key,
		date: dayjs(props.date).format('MM/DD/YYYY').toString(),
		time: props.times[0],
		note: null,
		adult: 0,
		child: 0,
		cost: 0,
		tc: null,
		user_id: usePage().props.value.auth.user.id
	};

	let form = ref({ ...initialState });

	const openForm = function () {
		form.value = { ...initialState };
		open.value = true;
	};

	const submit = () => {
		loading.value = true;
		if (form.value.option === 'start') {
			form.value.time = '00:00:00';
		}

		if (form.value.option === 'end') {
			form.value.time = '23:00:00';
		}

		if (!form.value.adult) {
			form.value.adult = 0;
		}

		if (!form.value.child) {
			form.value.child = 0;
		}

		if (form.value.id !== null) {
			Inertia.put(route('order.update', form.value.id), form.value, {
				preserveScroll: true,
				onSuccess: () => closeForm()
			});
		} else {
			Inertia.post(route('order.store'), form.value, {
				preserveScroll: true,
				onSuccess: () => closeForm()
			});
		}
	};

	const editRow = function (item) {
		form.value = { ...item };
		if (item.option == 'end' && props.tc) {
			form.value.tc = JSON.stringify(props.tc);
		}
		open.value = true;
	};

	const closeForm = function () {
		loading.value = false;
		open.value = false;
		if (form.value.option === 'end') {
			location.reload();
		}
	};

	let itemToDelete = ref(null);
	const deleteModal = ref();
	const onDelete = function (item) {
		itemToDelete = item;
		deleteModal.value.open = !deleteModal.value.open;
	};

	const deleteRecord = () => {
		Inertia.delete(route('order.destroy', itemToDelete), {
			preserveScroll: true
		});
		deleteModal.value.open = false;
	};

	const getTcInitials = computed(() => {
		if (props.tc && props.tourConcierges.length) {
			let tc = props.tourConcierges.find((i) => i.id === props.tc);
			return tc ? tc.initials : null;
		}
		return null;
	});

	const offEnd = computed(() => {
		if (
			props.orders.length &&
			props.orders.find((i) => i.option === 'end')
		) {
			return true;
		}
		return false;
	});
</script>
