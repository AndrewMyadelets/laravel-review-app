<script setup>
import { useRoute } from "vue-router";
import { ref, onMounted } from "vue";
import axiosClient from "../axiosClient";

const route = useRoute();
const product = ref({});

onMounted(async () => {
    let response = await axiosClient.get(`products/${route.params.id}`);
    product.value = response.data.product;
});

console.log(product);
</script>

<template>
    <div class="font-sans bg-white">
        <div class="p-4 lg:max-w-7xl max-w-4xl mx-auto">
            <div
                class="grid items-start grid-cols-1 lg:grid-cols-5 gap-12 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] p-6 rounded-lg"
            >
                <div class="lg:col-span-3 w-full text-center">
                    <img
                        :src="product.image"
                        alt="Product"
                        class="w-3/4 rounded object-cover mx-auto"
                    />
                </div>

                <div class="lg:col-span-2">
                    <h2 class="text-2xl font-extrabold text-gray-800">
                        {{ product.name }}
                    </h2>
                    <p class="mt-4 text-sm text-gray-800">
                        {{ product.desc }}
                    </p>
                    <div class="flex justify-between items-end">
                        <div>
                            <div class="mt-4 mb-1 flex space-x-2">
                                <svg
                                    class="w-5 fill-blue-600"
                                    viewBox="0 0 14 13"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                    />
                                </svg>
                                <span class="font-bold text-xl">4,8</span>
                            </div>
                            <h4 class="text-gray-600 text-base">500 Reviews</h4>
                        </div>
                        <p class="text-gray-800 text-3xl font-bold">
                            ${{ product.price }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-16 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] p-6">
                <h3 class="text-xl font-bold text-gray-800">Reviews(10)</h3>
                <div class="grid md:grid-cols-2 gap-12 mt-4">
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <p class="text-sm text-gray-800 font-bold">5.0</p>
                            <svg
                                class="w-5 fill-blue-600 ml-1"
                                viewBox="0 0 14 13"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                />
                            </svg>
                            <div class="bg-gray-400 rounded w-full h-2 ml-3">
                                <div
                                    class="w-2/3 h-full rounded bg-blue-600"
                                ></div>
                            </div>
                            <p class="text-sm text-gray-800 font-bold ml-3">
                                66%
                            </p>
                        </div>

                        <div class="flex items-center">
                            <p class="text-sm text-gray-800 font-bold">4.0</p>
                            <svg
                                class="w-5 fill-blue-600 ml-1"
                                viewBox="0 0 14 13"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                />
                            </svg>
                            <div class="bg-gray-400 rounded w-full h-2 ml-3">
                                <div
                                    class="w-1/3 h-full rounded bg-blue-600"
                                ></div>
                            </div>
                            <p class="text-sm text-gray-800 font-bold ml-3">
                                33%
                            </p>
                        </div>

                        <div class="flex items-center">
                            <p class="text-sm text-gray-800 font-bold">3.0</p>
                            <svg
                                class="w-5 fill-blue-600 ml-1"
                                viewBox="0 0 14 13"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                />
                            </svg>
                            <div class="bg-gray-400 rounded w-full h-2 ml-3">
                                <div
                                    class="w-1/6 h-full rounded bg-blue-600"
                                ></div>
                            </div>
                            <p class="text-sm text-gray-800 font-bold ml-3">
                                16%
                            </p>
                        </div>

                        <div class="flex items-center">
                            <p class="text-sm text-gray-800 font-bold">2.0</p>
                            <svg
                                class="w-5 fill-blue-600 ml-1"
                                viewBox="0 0 14 13"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                />
                            </svg>
                            <div class="bg-gray-400 rounded w-full h-2 ml-3">
                                <div
                                    class="w-1/12 h-full rounded bg-blue-600"
                                ></div>
                            </div>
                            <p class="text-sm text-gray-800 font-bold ml-3">
                                8%
                            </p>
                        </div>

                        <div class="flex items-center">
                            <p class="text-sm text-gray-800 font-bold">1.0</p>
                            <svg
                                class="w-5 fill-blue-600 ml-1"
                                viewBox="0 0 14 13"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                />
                            </svg>
                            <div class="bg-gray-400 rounded w-full h-2 ml-3">
                                <div
                                    class="w-[6%] h-full rounded bg-blue-600"
                                ></div>
                            </div>
                            <p class="text-sm text-gray-800 font-bold ml-3">
                                6%
                            </p>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-start">
                            <img
                                src="https://readymadeui.com/team-2.webp"
                                class="w-12 h-12 rounded-full border-2 border-white"
                            />
                            <div class="ml-3">
                                <h4 class="text-sm font-bold text-gray-800">
                                    John Doe
                                </h4>
                                <div class="flex space-x-1 mt-1">
                                    <svg
                                        class="w-4 fill-blue-600"
                                        viewBox="0 0 14 13"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                        />
                                    </svg>
                                    <svg
                                        class="w-4 fill-blue-600"
                                        viewBox="0 0 14 13"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                        />
                                    </svg>
                                    <svg
                                        class="w-4 fill-blue-600"
                                        viewBox="0 0 14 13"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                        />
                                    </svg>
                                    <svg
                                        class="w-4 fill-[#CED5D8]"
                                        viewBox="0 0 14 13"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                        />
                                    </svg>
                                    <svg
                                        class="w-4 fill-[#CED5D8]"
                                        viewBox="0 0 14 13"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                        />
                                    </svg>
                                    <p
                                        class="text-xs !ml-2 font-semibold text-gray-800"
                                    >
                                        2 mins ago
                                    </p>
                                </div>
                                <p class="text-sm mt-4 text-gray-800">
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipisci elit, sed eiusmod tempor incidunt
                                    ut labore et dolore magna aliqua.
                                </p>
                            </div>
                        </div>

                        <button
                            type="button"
                            class="w-full mt-10 px-4 py-2.5 bg-transparent hover:bg-gray-50 border border-blue-600 text-gray-800 font-bold rounded"
                        >
                            Read all reviews
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
