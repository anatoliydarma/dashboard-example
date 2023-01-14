<template>
    <Transition name="fade">
        <div v-if="scrolledToBottom" class="fixed bottom-4 right-4">
            <a href="#" class="text-indigo-500 hover">
                <i-tabler-chevron-up />
            </a>
        </div>
    </Transition>
</template>

<script setup>
import { onMounted, ref } from "vue";
const scrolledToBottom = ref(false);

const scroll = function () {
    window.onscroll = () => {
        let bottomOfWindow =
            Math.max(
                window.pageYOffset,
                document.documentElement.scrollTop,
                document.body.scrollTop
            ) +
                window.innerHeight ===
            document.documentElement.offsetHeight;

        if (bottomOfWindow) {
            scrolledToBottom.value = true;
        } else {
            scrolledToBottom.value = false;
        }
    };
};

onMounted(() => {
    scroll();
});
</script>
