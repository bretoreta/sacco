<script setup>
import { ref } from "@vue/reactivity";
import { computed } from "@vue/runtime-core";


const props = defineProps({
    radius: Number,
    progress: Number,
    stroke: Number
});

const normalizedRadius = computed(() => {
    return props.radius - props.stroke * 2;
});
const circumference = computed(() => {
    return normalizedRadius.value * 2 * Math.PI;
})

const strokeDashoffset = computed(() => {
    return circumference.value - props.progress / 100 * circumference.value
})

</script>
<template>
    <svg :height="radius * 2" :width="radius * 2" class="relative">
        <circle class="text-blue-500" stroke="currentColor" fill="transparent" :stroke-dasharray="circumference + ' ' + circumference" stroke-linecap="round"
        :stroke-dashoffset="circumference - progress / 100 * circumference" :stroke-width="stroke" :r="normalizedRadius" :cx="radius" :cy="radius" />
        <span class="absolute text-xl text-blue-600">{{ progress }} %</span>
    </svg>
</template>
<style scoped>
circle {
    transition: stroke-dashoffset 0.35s;
    transform: rotate(-90deg);
    transform-origin: 50% 50%;
}
</style>