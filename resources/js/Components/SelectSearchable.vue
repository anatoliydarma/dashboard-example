<template>
    <Combobox v-model="selected">
        <div class="relative mt-1 z-60">
            <div
                class="relative w-full overflow-hidden text-left cursor-default focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-300 sm:text-sm">
                <ComboboxInput
                    class="relative w-full py-2 pl-3 pr-10 text-left bg-white border border-slate-300 rounded-md shadow-sm cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    @change="query = $event.target.value" :displayValue="(option) => option.name" />
                <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
                    <i-tabler-selector class="w-5 h-5 text-slate-400" />
                </ComboboxButton>
            </div>
            <TransitionRoot leave="transition ease-in duration-100" leaveFrom="opacity-100" leaveTo="opacity-0"
                @after-leave="query = ''">
                <ComboboxOptions
                    class="absolute z-10 w-full py-1 mt-1 overflow-auto text-base bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                    <div v-if="filteredOptions.length === 0 && query !== ''"
                        class="relative px-4 py-2 text-slate-700 cursor-default select-none">
                        Nothing found.
                    </div>

                    <ComboboxOption v-for="option in filteredOptions" as="template" :key="option.id" :value="option"
                        v-slot="{ selected, active }">
                        <li class="relative py-2 pl-10 pr-4 cursor-default select-none" :class="{
                            'bg-indigo-600 text-white': active,
                            'text-slate-900': !active,
                        }">
                            <span class="block truncate" :class="{
                                'font-medium': selected,
                                'font-normal': !selected,
                            }">
                                {{ option.name }}
                            </span>
                            <span v-if="selected" class="absolute inset-y-0 left-0 flex items-center pl-3" :class="{
                                'text-white': active,
                                'text-indigo-600': !active,
                            }">
                                <i-tabler-check class="w-5 h-5" />
                            </span>
                        </li>
                    </ComboboxOption>
                </ComboboxOptions>
            </TransitionRoot>
        </div>
    </Combobox>
    <div v-if="error" class="text-sm italic text-red-500">{{ error }}</div>
</template>

<script setup>
import { ref, computed, watch } from "vue";

import {
    Combobox,
    ComboboxInput,
    ComboboxButton,
    ComboboxOptions,
    ComboboxOption,
    TransitionRoot,
} from "@headlessui/vue";

const props = defineProps({
    list: Object,
    modelValue: Object,
    error: {
        type: String,
        default: null,
    },
});
const emit = defineEmits(["update:modelValue"]);
const options = JSON.parse(JSON.stringify(props.list));

let selected = ref(props.modelValue);

let query = ref("");

let filteredOptions = computed(() =>
    query.value === ""
        ? options
        : options.filter((option) =>
              option.name
                  .toLowerCase()
                  .replace(/\s+/g, "")
                  .includes(query.value.toLowerCase().replace(/\s+/g, ""))
          )
);

watch(selected, function (value) {
    emit("update:modelValue", value);
});
</script>
