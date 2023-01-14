<template>
    <Authenticated>
        <div class="pb-12 space-y-6">

            <Head title="Growth" />
            <PageTitle>Growth</PageTitle>
            <div class="md:items-start md:flex-row flex flex-col items-center justify-between gap-6">
                <div class="md:flex-row md:px-0 flex flex-col items-center justify-start gap-4 px-4">
                    <DateRange v-model="picked"></DateRange>

                    <div class="text-lg font-bold text-slate-500">
                        {{ year }}
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-xs text-slate-500">
                        {{ lastRefreshed }}
                    </div>
                    <button class="hover:bg-indigo-600 p-2 text-white bg-indigo-500 rounded-full"
                        @click="isFetching = !isFetching" :disabled="isFetching">
                        <i-tabler-rotate-clockwise class="w-6 h-6 fill-current"
                            :class="{ 'animate-spin': isFetching }" />
                    </button>
                </div>
            </div>

            <TableGrowth :items="growth" />
        </div>
    </Authenticated>
</template>

<script setup>
import DateRange from "@/Components/DateRange.vue";
import PageTitle from "@/Components/PageTitle.vue";
import TableGrowth from "./TableGrowth.vue";
import { Inertia } from "@inertiajs/inertia";
import dayjs from "dayjs";

const props = defineProps({
    growth: Object,
    date: Array,
    lastRefreshed: String,
});

let picked = ref(props.date);
let year = ref(dayjs(picked.value[0]).format("YYYY"));
let isFetching = ref(false);

watch(isFetching, () => {
    if (isFetching.value === true) {
        let params = {};
        params.date = picked.value;
        Inertia.get(route("fetchingData"), params);
    }
});

watch(picked, (value) => {
    let params = {};
    if (value) {
        params.date = value;
    }
    Inertia.get(route("growth"), params);
});
</script>
