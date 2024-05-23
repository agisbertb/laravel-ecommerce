<template>
    <div class="bg-white">
        <div class="py-16 sm:py-24 xl:mx-auto xl:max-w-7xl xl:px-8">
            <div class="px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8 xl:px-0">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Shop by Category</h2>
                <Link href="/categories" class="hidden text-sm font-semibold text-blue-600 hover:text-blue-500 sm:block">
                    Browse all categories
                    <span aria-hidden="true"> &rarr;</span>
                </Link>
            </div>

            <div class="mt-4 flow-root">
                <div class="-my-2">
                    <div class="relative box-content h-80 overflow-x-auto py-2 xl:overflow-visible">
                        <div class="absolute flex space-x-8 px-4 sm:px-6 lg:px-8 xl:relative xl:grid xl:grid-cols-5 xl:gap-x-8 xl:space-x-0 xl:px-0">
                            <a v-for="category in limitedCategories" :key="category.name" :href="'/categories/' + category.slug" class="relative flex h-80 w-56 flex-col overflow-hidden rounded-lg p-6 group-hover:opacity-75 duration-300 ease-in-out group-hover:scale-110 xl:w-auto">
                                <span aria-hidden="true" class="absolute inset-0">
                                    <img :src="category.image_url" alt="" class="h-full w-full object-cover object-center" />
                                </span>
                                <span aria-hidden="true" class="absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-gray-800 opacity-50" />
                                <span class="relative mt-auto text-center text-xl font-bold text-white">{{ category.name }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 px-4 sm:hidden">
                <Link href="/categories" class="hidden text-sm font-semibold text-blue-600 hover:text-blue-500 sm:block">
                    Browse all categories
                    <span aria-hidden="true"> &rarr;</span>
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps, computed } from 'vue';
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    categories: Array
});

const limitedCategories = computed(() => {
    return props.categories.slice(0, 5);
});
</script>
