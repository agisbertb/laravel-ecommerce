<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';

const props = defineProps({
  products: Object,
});
</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Product Details
      </h2>
    </template>

    <div class="flex justify-center items-center min-h-screen">
      <div class="flex space-x-10 items-start bg-white p-8 rounded-lg shadow-lg">
        <div class="flex-none" style="width: 300px; height: 300px;">
          <img class="object-cover h-full w-full rounded-lg" :src="products.image" :alt="products.name" />
        </div>

        <div class="flex-grow space-y-4">
          <h1 class="text-2xl font-bold">{{ products.name }}</h1>
          <p class="text-lg">{{ products.description }}</p>
          <p class="text-xl font-semibold">${{ products.price }}</p>
          <button class="px-6 py-2 rounded-md bg-blue-500 text-white font-medium hover:bg-blue-700 transition duration-150 ease-in-out">
            Add to cart
          </button>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
