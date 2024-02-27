<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Products
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div>
                    <h1>Products</h1>
                    <div v-for="product in products" :key="product.id">
                        <p>{{ product.name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
  
<script>
export default {
    props: {
        categories: Array,
    },
}
</script>