<script setup>
defineProps({
    product: {
        type: Object,
        required: true,
    },
});

const getTextPreview = function (text) {
    return text.length > 50 ? text.substring(0, 50) + "..." : text;
};
</script>

<template>
    <router-link :to="{ name: 'product', params: { id: product.id } }">
        <div class="group relative bg-white rounded-md box-border">
            <div
                class="aspect-h-1 aspect-w-1 w-full rounded-t-md overflow-hidden bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80"
            >
                <img
                    :src="product.image"
                    :alt="product.name"
                    class="h-full w-full object-cover object-center lg:h-full lg:w-full"
                />
            </div>
            <div class="p-1">
                <h3 class="mt-4 text-lg font-semibold text-gray-700">
                    <span aria-hidden="true" class="absolute inset-0"></span>
                    {{ product.name }}
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    {{ getTextPreview(product.desc) }}
                </p>

                <p class="mt-2 font-medium text-gray-900">
                    $ {{ product.price }}
                </p>
            </div>
        </div>
    </router-link>
</template>
