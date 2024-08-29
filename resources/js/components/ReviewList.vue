<script setup>
import StarRating from "vue-star-rating";
import { PencilIcon, TrashIcon } from "@heroicons/vue/24/outline";

defineProps({
    reviewsCount: {
        type: Number,
        required: true,
    },
    reviews: {
        type: Object,
        required: true,
    },
    showAllReviews: {
        type: Boolean,
        default: true,
    },
});

const emits = defineEmits(["getAllReviews", "editReview", "deleteReview"]);
</script>

<template>
    <div
        class="mt-8 p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)]"
        v-if="reviewsCount"
    >
        <h3 class="text-xl font-bold text-gray-800">
            Reviews({{ reviewsCount }})
        </h3>
        <div class="mt-8">
            <div
                class="mb-8 flex items-center"
                v-for="review of reviews"
                :key="review.id"
            >
                <div>
                    <h4 class="font-bold text-gray-800">John Doe</h4>
                    <div class="flex mt-1 items-center">
                        <StarRating
                            :star-size="25"
                            :show-rating="false"
                            :active-color="`#2563eb`"
                            :rating="review.rating"
                            :read-only="true"
                        />
                        <p class="ml-4 text-sm font-semibold text-gray-800">
                            {{ review.updated }}
                        </p>
                        <div
                            class="ml-8 p-2 cursor-pointer hover:bg-gray-100 rounded-md"
                            title="edit"
                            @click="emits('editReview', review)"
                        >
                            <PencilIcon class="block size-5" />
                        </div>
                        <div
                            class="p-2 cursor-pointer hover:bg-gray-100 rounded-md"
                            title="delete"
                            @click="emits('deleteReview', review.id)"
                        >
                            <TrashIcon class="block size-5" />
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
                @click="emits('getAllReviews')"
                v-if="!showAllReviews"
            >
                Read all reviews
            </button>
        </div>
    </div>
</template>
