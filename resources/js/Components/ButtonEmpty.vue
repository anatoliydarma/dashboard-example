<script setup>
defineProps({
    type: {
        type: String,
        default: "submit",
    },
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center justify-center px-2 py-1 tracking-widest text-center select-none font-semibol focus:outline-none focus:shadow-outline-gray"
    >
        <slot />
    </button>
</template>
