<script setup>
import Header from "./components/Header.vue";
</script>

<template>
    <div class="bg-gray-200">
        <Header />
        <div class="mx-auto max-w-7xl px-2 py-16 sm:px-6 lg:px-8">
            <router-view></router-view>
        </div>
    </div>
</template>
