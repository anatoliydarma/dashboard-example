<template>
    <TransitionRoot as="template" :show="open">
        <Dialog as="div" class="z-60 fixed inset-0 overflow-y-auto" @close="open = false">
            <div class="sm:block sm:p-0 flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center">
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0"
                    enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                    <DialogOverlay class="fixed inset-0 transition-opacity bg-slate-500 bg-opacity-75" />
                </TransitionChild>

                <span class="sm:inline-block sm:align-middle sm:h-screen hidden" aria-hidden="true">&#8203;</span>
                <TransitionChild as="template" enter="ease-out duration-300"
                    enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200"
                    leave-from="opacity-100 translate-y-0 sm:scale-100"
                    leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div class="sm:my-8 sm:align-middle sm:w-full sm:p-6 relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl"
                        :class="size ? `max-w-${size}` : 'max-w-md'">
                        <div>
                            <div class="sm:block absolute top-0 right-0 hidden pt-4 pr-4">
                                <button type="button"
                                    class="hover:text-slate-500 text-slate-400 bg-white rounded-md outline-none"
                                    @click="open = false">
                                    <span class="sr-only">Close</span>
                                    <i-tabler-plus class="w-6 h-6 rotate-45" />
                                </button>
                            </div>
                            <div>
                                <DialogTitle as="h3" class="text-lg font-medium leading-6 text-center text-slate-900">
                                    <slot name="header">
                                        Confirmation required!
                                    </slot>
                                </DialogTitle>
                                <div class="mt-2">
                                    <p class="text-sm text-slate-500">
                                        <slot name="content">
                                            <span class="block text-center">
                                                Are you sure you want to
                                                continue with the action ?
                                            </span>
                                        </slot>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div v-if="footer" class="flex justify-around gap-6 mt-5">
                            <slot name="footer">
                                <BreezeButton @click="open = false" ref="cancelButtonRef">
                                    Cancel
                                </BreezeButton>
                                <BreezeButton @click="submit"
                                    class="hover:bg-red-600 text-white bg-red-500 border border-red-500">Confirm
                                </BreezeButton>
                            </slot>
                        </div>
                    </div>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import BreezeButton from "@/Components/Button.vue";
import {
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";

const props = defineProps({
    submit: Function,
    size: String,

    footer: {
        type: Boolean,
        default: true,
    },
});

let open = ref(false);

defineExpose({
    open,
});
</script>
