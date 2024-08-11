<script setup>
import ProductListItem from "./ProductListItem.vue";

defineProps({
    products: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <h2 class="text-3xl font-bold tracking-tight text-gray-900">Products</h2>

    <div
        class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8"
    >
        <ProductListItem
            v-for="product in products"
            :key="product.id"
            :product="product"
        />
    </div>
</template>
