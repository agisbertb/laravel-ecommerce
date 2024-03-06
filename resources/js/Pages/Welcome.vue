<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';
import { Link as InertiaLink } from '@inertiajs/inertia-vue3';

const props = defineProps({
  products: Array,
});
</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        TODO products
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

          <div class="bg-white">
            <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
              <h2 class="text-2xl font-bold tracking-tight text-gray-900">Customers also purchased</h2>

              <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                <div v-for="product in products" :key="product.id" class="group relative">
                  <div
                    class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                    <img :src="product.image" :alt="product.image"
                      class="h-full w-full object-cover object-center lg:h-full lg:w-full" />
                  </div>
                  <div class="mt-4 flex justify-between">
                    <div>
                      <h3 class="text-sm text-gray-700">
                        <InertiaLink :href="`/products/${product.id}`">
                          {{ product.name }}
                        </InertiaLink>
                      </h3>
                    </div>
                    <p class="text-sm font-medium text-gray-900">{{ product.price }}</p>
                  </div>
                  <InertiaLink :href="`/products/${product.id}`" class="mt-2 text-indigo-600 hover:text-indigo-900">
                    View Product
                  </InertiaLink>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </AppLayout>
</template>
