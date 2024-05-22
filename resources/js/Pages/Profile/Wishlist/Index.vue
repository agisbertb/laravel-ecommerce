<template>
    <ProfileLayout :siteSettings="siteSettings">
        <div class="py-12 bg-white">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="bg-white">
                            <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                                <h2 class="text-xl font-semibold mb-4">My Wishlist</h2>
                                <div v-if="wishlist.length === 0" class="text-center text-gray-500">
                                    You have no items in your wishlist.
                                </div>
                                <div v-else class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                                    <div v-for="item in wishlist" :key="item.id" class="group">
                                        <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                                            <img :src="item.product.image_url" :alt="item.product.name" class="h-full w-full object-cover object-center group-hover:opacity-75" />
                                        </div>
                                        <h3 class="mt-4 text-sm text-gray-700">{{ item.product.name }}</h3>
                                        <p class="mt-1 text-lg font-medium text-gray-900">${{ item.product.price }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </ProfileLayout>
</template>

<script setup>
import { defineProps } from 'vue';
import ProfileLayout from "@/Layouts/ProfileLayout.vue";

const props = defineProps({
    wishlist: Array,
    siteSettings: Object,
});
</script>
