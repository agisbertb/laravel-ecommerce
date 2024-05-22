<template>
    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Latest products</h2>
                <Link href="/products" class="hidden text-sm font-semibold text-blue-600 hover:text-blue-500 sm:block">
                    Browse all products
                    <span aria-hidden="true"> &rarr;</span>
                </Link>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-x-4 gap-y-10 sm:gap-x-6 md:grid-cols-4 md:gap-y-0 lg:gap-x-8">
                <div v-for="product in products" :key="product.id" class="group relative">
                    <div class="h-56 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:h-72 xl:h-80">
                        <img v-if="product.image_url" :src="product.image_url" :alt="product.name" class="h-full w-full object-cover object-center" />
                    </div>
                    <h3 class="mt-4 text-sm text-gray-700">
                        <a :href="'/products/' + product.slug">
                            <span class="absolute inset-0" />
                            {{ product.name }}
                        </a>
                    </h3>
<!--                    <p class="mt-1 text-sm text-gray-500">{{ product.color }}</p>-->
                    <p class="mt-1 text-sm font-medium text-gray-900">{{ product.price }}€</p>

                </div>
            </div>

            <div class="mt-8 text-sm md:hidden">
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

console.log(props.products);

</script>
