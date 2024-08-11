<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";
import { Bars3Icon, XMarkIcon } from "@heroicons/vue/24/outline";
import { useRouter, useRoute } from "vue-router";

const router = useRouter();
const location = useRoute();

const getRouteName = function (route) {
    return route[0].toUpperCase() + route.slice(1);
};
</script>

<template>
    <Disclosure as="nav" class="bg-gray-800" v-slot="{ open }">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div
                    class="absolute inset-y-0 right-0 flex items-center sm:hidden"
                >
                    <!-- Mobile menu button-->
                    <DisclosureButton
                        class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    >
                        <span class="absolute -inset-0.5" />
                        <span class="sr-only">Open main menu</span>
                        <Bars3Icon
                            v-if="!open"
                            class="block h-6 w-6"
                            aria-hidden="true"
                        />
                        <XMarkIcon
                            v-else
                            class="block h-6 w-6"
                            aria-hidden="true"
                        />
                    </DisclosureButton>
                </div>
                <div
                    class="flex flex-1 items-center sm:items-stretch sm:justify-between"
                >
                    <div class="flex flex-shrink-0 items-center">
                        <router-link :to="{ name: 'home' }">
                            <div
                                class="text-blue-300 text-lg font-semibold uppercase"
                            >
                                Product Review App
                            </div>
                        </router-link>
                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <div
                                v-for="(route, index) in router.options.routes"
                                :key="index"
                                :class="[
                                    location.path === route.path
                                        ? 'bg-gray-900 text-white'
                                        : 'text-gray-300 hover:bg-gray-700 hover:text-white',
                                    'rounded-md px-3 py-2 text-sm font-medium',
                                ]"
                            >
                                <router-link :to="route.path">
                                    {{ getRouteName(route.name) }}
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <DisclosurePanel class="sm:hidden">
            <div class="space-y-1 px-2 pb-3 pt-2">
                <DisclosureButton
                    v-for="(route, index) in router.options.routes"
                    :key="index"
                    :class="[
                        location.path === route.path
                            ? 'bg-gray-900 text-white'
                            : 'text-gray-300 hover:bg-gray-700 hover:text-white',
                        'block rounded-md px-3 py-2 text-base font-medium',
                    ]"
                >
                    <router-link :to="route.path">
                        {{ getRouteName(route.name) }}
                    </router-link>
                </DisclosureButton>
            </div>
        </DisclosurePanel>
    </Disclosure>
</template>
