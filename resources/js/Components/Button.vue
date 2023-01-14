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
        class="inline-flex items-center justify-center px-4 py-2 tracking-widest text-center text-white bg-indigo-500 border rounded-lg select-none font-semibol focus:outline-none focus:shadow-outline-gray hover:bg-indigo-600 disabled:cursor-not-allowed"
    >
        <slot />
    </button>
</template>
