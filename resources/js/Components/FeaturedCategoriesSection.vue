<template>
    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8">
            <div class="sm:flex sm:items-baseline sm:justify-between">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Featured Categories</h2>
                <a href="#" class="hidden text-sm font-semibold text-blue-600 hover:text-blue-500 sm:block">
                    Browse all categories
                    <span aria-hidden="true"> &rarr;</span>
                </a>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:grid-rows-2 sm:gap-x-6 lg:gap-8">
                <!-- Category left -->
                <div v-if="categories.length > 0" class="group aspect-h-1 aspect-w-2 overflow-hidden rounded-lg sm:aspect-h-1 sm:aspect-w-1 sm:row-span-2">
                    <img :src="'/storage/' + categories[0].image" :alt="categories[0].description" class="object-cover object-center group-hover:opacity-75" />
                    <div aria-hidden="true" class="bg-gradient-to-b from-transparent to-black opacity-50" />
                    <div class="flex items-end p-6">
                        <div>
                            <h3 class="font-semibold text-white">
                                <a :href="'/categories/' + categories[0].slug">
                                    <span class="absolute inset-0" />
                                    {{ categories[0].name }}
                                </a>
                            </h3>
                            <p aria-hidden="true" class="mt-1 text-sm text-white">Shop now</p>
                        </div>
                    </div>
                </div>

                <!-- Category right -->
                <div v-if="categories.length > 1" class="group aspect-h-1 aspect-w-2 overflow-hidden rounded-lg sm:aspect-none sm:relative sm:h-full">
                    <img :src="'/storage/' + categories[1].image" :alt="categories[1].description" class="object-cover object-center group-hover:opacity-75 sm:absolute sm:inset-0 sm:h-full sm:w-full" />
                    <div aria-hidden="true" class="bg-gradient-to-b from-transparent to-black opacity-50 sm:absolute sm:inset-0" />
                    <div class="flex items-end p-6 sm:absolute sm:inset-0">
                        <div>
                            <h3 class="font-semibold text-white">
                                <a :href="'/categories/' + categories[1].slug">
                                    <span class="absolute inset-0" />
                                    {{ categories[1].name }}
                                </a>
                            </h3>
                            <p aria-hidden="true" class="mt-1 text-sm text-white">Shop now</p>
                        </div>
                    </div>
                </div>

                <!-- Second Category right -->
                <div v-if="categories.length > 2" class="group aspect-h-1 aspect-w-2 overflow-hidden rounded-lg sm:aspect-none sm:relative sm:h-full">
                    <img :src="'/storage/' + categories[2].image" :alt="categories[2].description" class="object-cover object-center group-hover:opacity-75 sm:absolute sm:inset-0 sm:h-full sm:w-full" />
                    <div aria-hidden="true" class="bg-gradient-to-b from-transparent to-black opacity-50 sm:absolute sm:inset-0" />
                    <div class="flex items-end p-6 sm:absolute sm:inset-0">
                        <div>
                            <h3 class="font-semibold text-white">
                                <a :href="'/categories/' + categories[2].slug">
                                    <span class="absolute inset-0" />
                                    {{ categories[2].name }}
                                </a>
                            </h3>
                            <p aria-hidden="true" class="mt-1 text-sm text-white">Shop now</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 sm:hidden">
                <a href="#" class="block text-sm font-semibold text-blue-600 hover:text-blue-500">
                    Browse all categories
                    <span aria-hidden="true"> &rarr;</span>
                </a>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    categories: Array
});
</script>
