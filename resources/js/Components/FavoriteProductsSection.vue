<template>
    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8">
            <div class="sm:flex sm:items-baseline sm:justify-between">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Our Favorites</h2>
                <Link href="/products" class="hidden text-sm font-semibold text-blue-600 hover:text-blue-500 sm:block">
                    Browse all products
                    <span aria-hidden="true"> &rarr;</span>
                </Link>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-y-10 sm:grid-cols-3 sm:gap-x-6 sm:gap-y-0 lg:gap-x-8">
                <div v-for="product in products" :key="product.id" class="group relative">
                    <div class="h-96 w-full overflow-hidden rounded-lg sm:aspect-h-3 sm:aspect-w-2 group-hover:opacity-75 sm:h-auto duration-300 ease-in-out group-hover:scale-110">
                        <img :src="product.image_url" :alt="product.name" class="h-full w-full object-cover object-center" />
                    </div>
                    <h3 class="mt-4 text-base font-semibold text-gray-900">
                        <a :href="'/products/' + product.slug">
                            <span class="absolute inset-0" />
                            {{ product.name }}
                        </a>
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">{{ product.price }} €</p>
                </div>
            </div>

            <div class="mt-6 sm:hidden">
                <Link href="/products" class="hidden text-sm font-semibold text-blue-600 hover:text-blue-500 sm:block">
                    Browse all products
                    <span aria-hidden="true"> &rarr;</span>
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    products: Array,
});
</script>
