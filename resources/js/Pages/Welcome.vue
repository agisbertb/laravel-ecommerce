<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import NewsletterSection from "@/Components/NewsletterSection.vue";
import ShopByCategories from "@/Components/ShopByCategoriesSection.vue";
import HeroSection from "@/Components/HeroSection.vue";
import FavoriteProducts from "@/Components/FavoriteProductsSection.vue";
import LatestProductsSection from "@/Components/LatestProductsSection.vue";
import { defineProps } from 'vue';

const props = defineProps({
    products: Array,
});

</script>

<template>
  <AppLayout title="Welcome">

    <div class="py-12 bg-white">

      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <HeroSection />

          <FavoriteProducts />

          <ShopByCategories />

        <LatestProductsSection :products="products" />

        <NewsletterSection />

      </div>
    </div>
  </AppLayout>
</template>
