<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import NewsletterSection from "@/Components/NewsletterSection.vue";
import ShopByCategories from "@/Components/ShopByCategoriesSection.vue";
import FavoriteProducts from "@/Components/FavoriteProductsSection.vue";
import LatestProductsSection from "@/Components/LatestProductsSection.vue";
import { defineProps } from 'vue';
import FeaturedCategoriesSection from "@/Components/FeaturedCategoriesSection.vue";

const props = defineProps({
    products: Array,
    categories: Array,
    featuredCategories: Array,
    favoriteProducts: Array,
    latestProducts: Array,
});

</script>

<template>
  <AppLayout title="Welcome">

    <div class="py-12 bg-white">

      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <FeaturedCategoriesSection :categories="featuredCategories"/>

          <FavoriteProducts :products="favoriteProducts" />

          <ShopByCategories :categories="categories" />

          <LatestProductsSection :products="latestProducts" />

        <NewsletterSection />

      </div>
    </div>
  </AppLayout>
</template>
