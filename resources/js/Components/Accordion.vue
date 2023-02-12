<template>
    <ul class="accordion">
        <slot></slot>
    </ul>
</template>

<script>
export default {
    props: {},
    data() {
        return {
            Accordion: {
                count: 0,
                active: null
            }
        };
    }
};
</script>

<style scoped>
.accordion {
    list-style: none;
    margin: 0;
    padding: 0;
}

.accordion__item:last-child {
    border-bottom: none;
}
</style>
