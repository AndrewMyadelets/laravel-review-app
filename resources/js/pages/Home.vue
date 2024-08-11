<script setup>
import axiosClient from '../axiosClient';
import { ref, onMounted } from 'vue';
import ProductList from '../components/ProductList.vue';

const products = ref([]);

const fetchAllProducts = async () => {
   try {
      const response = await axiosClient.get('products');
      products.value = response.data.products;
   } catch (error) {
      console.log(error);
   }
}

onMounted(() => fetchAllProducts());
</script>

<template>
    <ProductList :products="products" />
</template>