<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps, ref } from 'vue';

const props = defineProps({
    defaultShippingAddress: Array,
    defaultBillingAddress: Array,
    cartTotal: Number,
});

const selectedShippingAddress = ref('');
const selectedBillingAddress = ref('');
</script>

<template>
    <AppLayout title="Select Address">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Select Address
            </h2>
        </template>
        <div class="py-12 flex flex-wrap justify-center gap-10">
            <!-- Left Column for Addresses -->
            <div class="flex flex-col w-full md:w-1/2 px-4">
                <!-- Shipping Address Section -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4">Shipping Address</h3>
                    <div class="space-y-4">
                        <div
                            class="bg-white shadow rounded-lg p-4"
                            v-for="address in defaultShippingAddress"
                            :key="address.id"
                        >
                            <label class="flex items-center space-x-3">
                                <input
                                    type="radio"
                                    name="shippingAddress"
                                    class="form-radio h-5 w-5 text-blue-600"
                                    :value="address.id"
                                    v-model="selectedShippingAddress"
                                    :checked="address.default"
                                />
                                <div>
                                    <p class="text-md font-bold">{{ address.name }}<span v-if="address.default" class="text-green-500">(Default)</span></p>
                                    <p>{{ address.line1 }}</p>
                                    <p>{{ address.line2 }}</p>
                                    <p>{{ `${address.city}, ${address.state}, ${address.zip}, ${address.country}` }}</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Billing Address Section -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Billing Address</h3>
                    <div class="space-y-4">
                        <div
                            class="bg-white shadow rounded-lg p-4"
                            v-for="address in defaultBillingAddress"
                            :key="address.id"
                        >
                            <label class="flex items-center space-x-3">
                                <input
                                    type="radio"
                                    name="billingAddress"
                                    class="form-radio h-5 w-5 text-blue-600"
                                    :value="address.id"
                                    v-model="selectedBillingAddress"
                                    :checked="address.default"
                                />
                                <div>
                                    <p class="text-md font-bold">{{ address.name }}<span v-if="address.default" class="text-green-500">(Default)</span></p>
                                    <p>{{ address.line1 }}</p>
                                    <p>{{ address.line2 }}</p>
                                    <p>{{ `${address.city}, ${address.state}, ${address.zip}, ${address.country}` }}</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column for Order Summary -->
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
                <a href="/cart/shipping" class="w-full px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Save and Continue
                </a>
            </div>
        </div>
    </AppLayout>
</template>
