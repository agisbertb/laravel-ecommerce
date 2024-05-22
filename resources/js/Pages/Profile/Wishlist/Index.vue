<template>
    <ProfileLayout :siteSettings="siteSettings">
        <div class="bg-white">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Your Wishlist</h1>
                <p class="mt-2 text-sm text-gray-500">Check your wishlist products.</p>
                <div class="mt-12 space-y-16 sm:mt-16">
                    <div v-if="wishlist.length === 0" class="text-center text-gray-500">
                        You have no items in your wishlist.
                    </div>
                    <div v-else class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                        <div v-for="item in wishlist" :key="item.id" class="group relative">
                            <Link :href="route('products.show', { slug: item.product.slug })" class="absolute inset-0 z-10" />
                            <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                                <img :src="item.product.image_url" :alt="item.product.name" class="h-full w-full object-cover object-center group-hover:opacity-75" />
                            </div>
                            <div class="relative z-20">
                                <h3 class="mt-4 text-sm text-gray-700">{{ item.product.name }}</h3>
                                <p class="mt-1 text-lg font-medium text-gray-900">${{ item.product.price }}</p>
                                <button @click="removeFromWishlist(item.id)" class="mt-2 text-sm text-red-500 hover:text-red-700">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </ProfileLayout>
</template>

<script setup>
import {defineProps} from 'vue';
import {Link, usePage, router} from '@inertiajs/vue3';
import ProfileLayout from "@/Layouts/ProfileLayout.vue";

const props = defineProps({
    wishlist: Array,
    siteSettings: Object,
});

function removeFromWishlist(id) {
    router.delete(route('wishlist.destroy', {id}), {
        preserveScroll: true,
        onSuccess: () => {
            // Optionally, handle success feedback
        },
    });
}
</script>
