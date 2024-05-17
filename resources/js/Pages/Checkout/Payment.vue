<template>
    <CartLayout title="Payment Method">
        <div class="bg-white">
            <div class="mx-auto max-w-7xl px-4 pb-24 pt-16 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Payment Method</h1>
                <div class="mt-12 grid grid-cols-1 lg:grid-cols-12 gap-12">
                    <!-- Payment Methods Section -->
                    <section aria-labelledby="payment-method-heading" class="lg:col-span-5">
                        <h2 id="payment-method-heading" class="text-lg font-semibold mb-4">Payment Method</h2>
                        <div class="space-y-4 bg-white p-6 rounded-lg shadow">
                            <div v-for="method in paymentMethods" :key="method.id" class="flex items-center">
                                <input type="radio" :id="method.id" name="paymentMethod" :value="method.id" v-model="selectedPaymentMethod" class="form-radio">
                                <span class="ml-2">{{ method.name }}</span>
                                <!-- Card Icons -->
                                <div class="ml-auto flex space-x-2">
                                    <img src="/storage/images/paymentlogos.png" alt="Payment logos" class="h-10">
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Invisible block to maintain distance -->
                    <section class="lg:col-span-3"></section>

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
                                    <span>{{ shippingPrice ? shippingPrice.toFixed(2) : '0.00' }} €</span>
                                </div>
                                <div class="flex justify-between mt-4 border-t border-gray-200 pt-4">
                                    <span class="font-bold text-lg">Total:</span>
                                    <span class="font-bold text-lg">{{ (cartTotal + (shippingPrice ? shippingPrice : 0)).toFixed(2) }} €</span>
                                </div>
                            </div>
                            <div class="mt-6">
                                <button @click="savePaymentMethod" class="w-full block rounded-md border border-transparent bg-blue-600 px-4 py-3 text-base font-medium text-white text-center shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-50">
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

<script setup>
import CartLayout from "@/Layouts/CartLayout.vue";
import {ref, defineProps} from 'vue';
import axios from 'axios';

const form = ref('');
const selectedPaymentMethod = ref('');

const props = defineProps({
    cartTotal: Number,
    shippingPrice: Number,
    paymentMethods: Array
});

const savePaymentMethod = async () => {
    if (!selectedPaymentMethod.value) {
        alert('Please select a payment method.');
        return;
    }

    try {
        const response = await axios.get('/redsys');
        const {form} = response.data;

        // Create a form and submit it to the Redsys URL
        const tempForm = document.createElement('div');
        tempForm.innerHTML = form;
        const actualForm = tempForm.querySelector('form');
        document.body.appendChild(actualForm);
        actualForm.submit();
    } catch (error) {
        console.error('Error fetching Redsys form:', error);
    }
};
</script>
