<template>
    <AppLayout title="Shipping Options">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Shipping Options
            </h2>
        </template>
        <!-- Content Container -->
        <div class="container mx-auto py-12 px-4 flex flex-wrap justify-between">
            <!-- Product Details Section -->
            <div class="w-full md:w-2/5">
                <h2 class="font-semibold text-xl mb-4">Your Products</h2>
                <div v-for="detail in cartDetails" :key="detail.id" class="bg-white p-4 rounded-lg mb-4 shadow">
                    <div class="flex items-center">
                        <img :src="detail.product.image" alt="Product Image" class="w-20 h-20 mr-4" />
                        <div>
                            <h3>{{ detail.product.name }}</h3>
                            <p>€{{ detail.product.price.toFixed(2) }} x {{ detail.quantity }}</p>
                            <p>Subtotal: €{{ detail.subtotal.toFixed(2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Options Section -->
            <div class="w-full md:w-1/5">
                <h2 class="font-semibold text-xl mb-4">Shipping Options</h2>
                <div v-for="option in shippingOptions" :key="option.id" class="bg-white p-4 rounded-lg mb-4 shadow">
                    <label class="flex items-center">
                        <input type="radio" name="shipping" :value="option.id" class="form-radio" />
                        <span class="ml-2">{{ option.name }}</span>
                    </label>
                    <p>€{{ option.price.toFixed(2) }}</p>
                    <p>Delivery: {{ option.estimated_delivery }}</p>
                </div>
            </div>

            <!-- Order Summary Section -->
            <div class="w-full md:w-1/3 bg-white shadow rounded-lg p-6 sticky top-20">
                <h3 class="text-lg font-semibold mb-4">Order Summary</h3>
                <div class="mb-6">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal:</span>
                        <span class="font-bold">${{ cartTotal }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Shipping:</span>
                        <span>Free</span>
                    </div>
                    <div class="flex justify-between mt-4">
                        <span class="font-bold text-lg">Total:</span>
                        <span class="font-bold text-lg">${{ cartTotal }}</span>
                    </div>
                </div>
                <a href="/cart/payment" class="w-full px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Save and Continue
                </a>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';

const props = defineProps({
    cartDetails: Array,
    cartTotal: Number,
    shippingOptions: Array
});
</script>
