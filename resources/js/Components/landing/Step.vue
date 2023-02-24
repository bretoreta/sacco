<script setup>
const props = defineProps({
  step: {
      type: Object,
      required: true,
    },
})

const imageUrl = "http://127.0.0.1:5173/resources/img/home/" + props.step.img;
</script>

<template>
  <div class="max-w-[280px] xl:max-w-[363px] space-y-6 sm:space-y-3 text-center">
    <img :src="imageUrl" class="max-w-[245px] mx-auto" alt="" />
    <h3 class="text-xl text-neutral-800 font-semibold">{{ step.title }}</h3>
    <p class="text-sm text-gray-700 leading-relaxed">
      {{ step.description }}
    </p>
  </div>
</template>