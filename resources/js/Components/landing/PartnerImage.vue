<script setup>
const props = defineProps({
  img: {
      type: String,
      default: '',
    },
})

const imageUrl = "http://127.0.0.1:5173/resources/img/partner/" + props.img;
</script>

<template>
  <div>
    <img :src="imageUrl" class="sm:w-1/2 lg:w-72 mx-auto" alt="" />
  </div>
</template>
