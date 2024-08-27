<script setup>
import { useRoute } from "vue-router";
import { ref, onMounted } from "vue";
import axiosClient from "../axiosClient";
import ReviewForm from "../components/ReviewForm.vue";
import ModalDialog from "../components/ModalDialog.vue";
import StarRating from "vue-star-rating";
import { useToast } from "vue-toastification";
import { PencilIcon } from "@heroicons/vue/24/outline";

const route = useRoute();
const product = ref({});
const reviewsCount = ref(0);
const reviews = ref({});
const review = ref({
    id: "",
    rating: 0,
    body: "",
    user_id: 1,
    product_id: route.params.id,
});
const showReviewForm = ref(false);
const showAllReviews = ref(false);
const toast = useToast();

const getReviewsCount = async () => {
    const response = await axiosClient.get(
        `products/${route.params.id}/reviews/count`
    );
    reviewsCount.value = response.data;
};

const getFirstReviews = async () => {
    const response = await axiosClient.get(
        `products/${route.params.id}/reviews?limit=3`
    );
    reviews.value = response.data.reviews;
};

onMounted(async () => {
    const response = await axiosClient.get(`products/${route.params.id}`);
    product.value = response.data.product;
});

onMounted(() => {
    getReviewsCount();
    getFirstReviews();
});

const getAllReviews = async () => {
    showAllReviews.value = true;

    const response = await axiosClient.get(
        `products/${route.params.id}/reviews`
    );
    reviews.value = response.data.reviews;
};

const cancelReview = () => {
    review.value = {
        id: "",
        rating: 0,
        body: "",
        user_id: 1,
        product_id: route.params.id,
    };
};

const editReview = (editableReview) => {
    showReviewForm.value = true;
    review.value = { ...editableReview };
};

const saveReview = async () => {
    if (!review.value.id) {
        try {
            await axiosClient.post(
                `products/${route.params.id}/reviews`,
                review.value
            );
            toast.success("Review added.");
            getReviewsCount();
        } catch (error) {
            console.log(error);
        }
    } else {
        try {
            await axiosClient.put(
                `products/${route.params.id}/reviews/${review.value.id}`,
                review.value
            );
            toast.success("Review updated.");
        } catch (error) {
            console.log(error);
        }
    }

    if (!showAllReviews.value) {
        getFirstReviews();
    } else {
        getAllReviews();
    }

    cancelReview();
};
</script>

<template>
    <div class="font-sans bg-white">
        <div class="p-4">
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
                            <h4
                                class="text-gray-600 text-base"
                                v-if="reviewsCount"
                            >
                                {{ reviewsCount }} Reviews
                            </h4>
                        </div>
                        <p class="text-gray-800 text-3xl font-bold">
                            ${{ product.price }}
                        </p>
                    </div>
                    <button
                        type="button"
                        class="mt-8 mb-4 w-full px-4 py-2.5 bg-blue-600 hover:bg-blue-500 border border-blue-600 text-gray-100 hover:text-white font-bold rounded"
                        v-if="!showReviewForm"
                        @click="showReviewForm = true"
                    >
                        Add a review
                    </button>
                </div>
            </div>

            <ModalDialog v-model="showReviewForm" @dialogCancel="cancelReview">
                <ReviewForm
                    v-model:open="showReviewForm"
                    v-model:review="review"
                    @formSubmitted="saveReview"
                />
            </ModalDialog>

            <div
                class="mt-16 p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)]"
                v-if="reviewsCount"
            >
                <h3 class="text-xl font-bold text-gray-800">
                    Reviews({{ reviewsCount }})
                </h3>
                <div class="mt-4">
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

                    <div class="mt-12">
                        <div
                            class="mb-8 flex items-center"
                            v-for="review of reviews"
                            :key="review.id"
                        >
                            <div class="ml-3">
                                <h4 class="font-bold text-gray-800">
                                    John Doe
                                </h4>
                                <div class="flex mt-1 items-center">
                                    <StarRating
                                        :star-size="25"
                                        :show-rating="false"
                                        :active-color="`#2563eb`"
                                        :rating="review.rating"
                                        :read-only="true"
                                    />
                                    <p
                                        class="ml-4 text-sm font-semibold text-gray-800"
                                    >
                                        {{ review.updated }}
                                    </p>
                                    <div
                                        class="ml-8 p-2 cursor-pointer hover:bg-gray-100 rounded-md"
                                        title="edit"
                                        @click="editReview(review)"
                                    >
                                        <PencilIcon class="block size-4" />
                                    </div>
                                </div>
                                <p class="text-sm mt-4 text-gray-800">
                                    {{ review.body }}
                                </p>
                            </div>
                        </div>

                        <button
                            type="button"
                            class="w-full px-4 py-2.5 bg-transparent hover:bg-gray-50 border border-blue-600 text-gray-800 font-bold rounded"
                            @click="getAllReviews"
                            v-if="!showAllReviews"
                        >
                            Read all reviews
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
