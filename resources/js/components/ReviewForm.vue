<script setup>
import StarRating from "vue-star-rating";
import { useToast } from "vue-toastification";

const emits = defineEmits(["formSubmitted"]);

const open = defineModel("open");
const review = defineModel("review");

const toast = useToast();

const onSubmit = () => {
    if (!review.value.rating) {
        toast.error("You must rate the product.");
        return;
    }

    if (!review.value.body) {
        toast.error('The "Text" field must be filled in.');
        return;
    }

    emits("formSubmitted");

    open.value = false;
};

const onCancel = () => {
    review.value = {
        id: "",
        rating: 0,
        body: "",
    };

    open.value = false;
};
</script>

<template>
    <form @submit.prevent="onSubmit">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-2xl font-semibold leading-7 text-gray-900">
                    Add a review
                </h2>

                <div
                    class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"
                >
                    <StarRating
                        :star-size="45"
                        :show-rating="false"
                        :active-on-click="true"
                        :active-color="`#2563eb`"
                        :rating="review.rating"
                        v-model:rating="review.rating"
                    />
                    <div class="col-span-full">
                        <label
                            for="about"
                            class="block text-sm font-medium leading-6 text-gray-900"
                            >Text</label
                        >
                        <div class="mt-2">
                            <textarea
                                id="text"
                                name="text"
                                rows="3"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                v-model="review.body"
                            />
                        </div>
                        <p class="mt-3 text-sm leading-6 text-gray-600">
                            Write a few sentences about product.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button
                type="button"
                class="text-sm font-semibold leading-6 text-gray-900"
                @click="onCancel"
            >
                Cancel
            </button>
            <button
                type="submit"
                class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-gray-100 hovet:text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
            >
                Save
            </button>
        </div>
    </form>
</template>
