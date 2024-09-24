<template>
    <AppLayout :siteSettings="siteSettings" title="Welcome">
        <div class="pb-12 bg-white">
            <div class="max-w-7xl mx-auto sm:px-0 lg:px-0">
                <FeaturedCategoriesSection :categories="featuredCategories"/>
                <FavoriteProducts :products="favoriteProducts" />
                <ShopByCategories :categories="categories" />
                <LatestProductsSection :products="latestProducts" />
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ShopByCategories from "@/Components/ShopByCategoriesSection.vue";
import FavoriteProducts from "@/Components/FavoriteProductsSection.vue";
import LatestProductsSection from "@/Components/LatestProductsSection.vue";
import FeaturedCategoriesSection from "@/Components/FeaturedCategoriesSection.vue";
import { defineProps } from 'vue';

const props = defineProps({
    categories: Array,
    featuredCategories: Array,
    favoriteProducts: Array,
    latestProducts: Array,
    siteSettings: Object,
});
</script>
