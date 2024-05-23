<script setup>
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';
import CartLayout from '@/Layouts/CartLayout.vue';
import { defineProps } from 'vue';
import { CheckIcon, ClockIcon } from "@heroicons/vue/20/solid/index.js";

const props = defineProps({
    cartDetails: Array,
    cartTotal: Number,
    shippingOptions: Array,
    siteSettings: Object,
});

const selectedShippingOption = ref('');
const form = useForm({
    shipping_option_id: '',
});

onMounted(() => {
    if (props.shippingOptions.length > 0) {
        selectedShippingOption.value = props.shippingOptions[0].id;
    }
});

const saveShippingOption = () => {
    if (!selectedShippingOption.value) {
        alert('Please select a shipping option.');
        return;
    }
    form.shipping_option_id = selectedShippingOption.value;
    form.post('/cart/shipping/save', {
        onSuccess: () => {
            window.location.href = '/cart/payment';
        }
    });
};
</script>

<template>
    <CartLayout title="Shipping Options" :siteSettings="siteSettings">
        <div class="bg-white">
            <div class="mx-auto max-w-7xl px-4 pb-24 pt-16 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Shipping Options</h1>
                <div class="mt-12 grid grid-cols-1 lg:grid-cols-12 gap-12">
                    <!-- Product Details Section -->
                    <section aria-labelledby="cart-heading" class="lg:col-span-4">
                        <h2 id="cart-heading" class="text-lg font-semibold mb-4">Your Products</h2>
                        <ul role="list" class="divide-y divide-gray-200 border-b border-t border-gray-200">
                            <li v-for="detail in cartDetails" :key="detail.id" class="flex py-6 sm:py-10">
                                <div class="flex-shrink-0">
                                    <img :src="detail.product.image" alt="Product Image" class="h-24 w-24 rounded-md object-cover object-center sm:h-48 sm:w-48" />
                                </div>
                                <div class="ml-4 flex flex-1 flex-col justify-between sm:ml-6">
                                    <div class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                                        <div>
                                            <div class="flex justify-between">
                                                <h3 class="text-sm">
                                                    <a :href="`/products/${detail.product.id}`" class="font-medium text-gray-700 hover:text-gray-800">{{ detail.product.name }}</a>
                                                </h3>
                                            </div>
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ detail.product.price.toFixed(2) }} € x {{ detail.quantity }}</p>
                                            <p class="mt-1 text-sm font-medium text-gray-900">Subtotal: {{ detail.subtotal.toFixed(2) }} €</p>
                                        </div>
                                    </div>
                                    <p class="mt-4 flex space-x-2 text-sm text-gray-700">
                                        <CheckIcon v-if="detail.product.stock > 0" class="h-5 w-5 flex-shrink-0 text-green-500" aria-hidden="true" />
                                        <ClockIcon v-else class="h-5 w-5 flex-shrink-0 text-gray-300" aria-hidden="true" />
                                        <span>{{ detail.product.stock > 0 ? 'In stock' : 'Out of stock' }}</span>
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </section>

                    <!-- Shipping Options Section -->
                    <section aria-labelledby="shipping-options-heading" class="lg:col-span-4">
                        <h2 id="shipping-options-heading" class="text-lg font-semibold mb-4">Shipping Options</h2>
                        <div class="space-y-4">
                            <div v-for="option in shippingOptions" :key="option.id" class="bg-white p-4 rounded-lg mb-4 shadow">
                                <label class="flex items-center">
                                    <input type="radio" name="shipping" :value="option.id" class="form-radio" v-model="selectedShippingOption" />
                                    <span class="ml-2">{{ option.name }}</span>
                                </label>
                                <p>{{ option.price.toFixed(2) }} €</p>
                                <p>Delivery: {{ option.estimated_delivery }}</p>
                            </div>
                        </div>
                    </section>

                    <!-- Order Summary Section -->
                    <section aria-labelledby="summary-heading" class="lg:col-span-4">
                        <div class="rounded-lg bg-gray-50 px-4 py-6 sm:p-6 lg:p-8 shadow">
                            <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Order Summary</h2>
                            <div class="mt-6">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Subtotal:</span>
                                    <span class="font-bold">{{ cartTotal.toFixed(2) }} €</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Shipping:</span>
                                    <span v-if="selectedShippingOption">{{ shippingOptions.find(option => option.id == selectedShippingOption).price.toFixed(2) }} €</span>
                                    <span v-else>-</span>
                                </div>
                                <div class="flex justify-between mt-4 border-t border-gray-200 pt-4">
                                    <span class="font-bold text-lg">Total:</span>
                                    <span class="font-bold text-lg">
                                        {{ (cartTotal + (selectedShippingOption ? shippingOptions.find(option => option.id == selectedShippingOption).price : 0)).toFixed(2) }} €
                                    </span>
                                </div>
                            </div>
                            <div class="mt-6">
                                <button @click="saveShippingOption" class="w-full block rounded-md border border-transparent bg-blue-600 px-4 py-3 text-base font-medium text-white text-center shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-50">
                                    Save and Continue
                                </button>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </CartLayout>
</template>
