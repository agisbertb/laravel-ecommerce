<script setup>
import CartLayout from '@/Layouts/CartLayout.vue';
import { defineProps, ref, watchEffect } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    shippingAddresses: {
        type: Array,
        required: true,
        default: () => [],
    },
    billingAddresses: {
        type: Array,
        required: true,
        default: () => [],
    },
    cartTotal: {
        type: Number,
        required: true,
    },
    siteSettings: {
        type: Object,
        required: true,
        default: () => ({}),
    },
});

// Select the default shipping and billing address
const selectedShippingAddress = ref('');
const selectedBillingAddress = ref('');

// Set the selected default addresses
watchEffect(() => {
    if (props.shippingAddresses.length > 0) {
        selectedShippingAddress.value = props.shippingAddresses.find(address => address.default)?.id || props.shippingAddresses[0].id;
    }

    if (props.billingAddresses.length > 0) {
        selectedBillingAddress.value = props.billingAddresses.find(address => address.default)?.id || props.billingAddresses[0].id;
    }
});

const form = useForm({
    shipping_address_id: '',
    billing_address_id: '',
});

const saveAndContinue = () => {
    form.shipping_address_id = selectedShippingAddress.value;
    form.billing_address_id = selectedBillingAddress.value;

    form.post(route('cart.address.save'));
};
</script>

<template>
    <CartLayout title="Shipping Address" :siteSettings="siteSettings">
        <div class="bg-white">
            <div class="mx-auto max-w-2xl px-4 pb-24 pt-16 sm:px-6 lg:max-w-7xl lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Shipping Address</h1>
                <div class="mt-12 lg:grid lg:grid-cols-12 lg:items-start lg:gap-x-12 xl:gap-x-16">
                    <!-- Left Column for Addresses -->
                    <section aria-labelledby="shipping-heading" class="lg:col-span-7">
                        <h2 id="shipping-heading" class="sr-only">Shipping Address</h2>

                        <!-- Shipping Address Section -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-4">Shipping Address</h3>
                            <div class="space-y-4">
                                <div
                                    class="bg-white shadow rounded-lg p-4 border border-gray-200"
                                    v-for="address in props.shippingAddresses"
                                    :key="address.id"
                                >
                                    <label class="flex items-center space-x-3">
                                        <input
                                            type="radio"
                                            name="shippingAddress"
                                            class="form-radio h-5 w-5 text-blue-600"
                                            :value="address.id"
                                            v-model="selectedShippingAddress"
                                        />
                                        <div>
                                            <p class="text-md font-bold">{{ address.name }}<span v-if="address.default" class="text-green-500">(Default)</span></p>
                                            <p>{{ address.line1 }}</p>
                                            <p>{{ address.line2 }}</p>
                                            <p>{{ `${address.city}, ${address.state}, ${address.zip}, ${address.country}` }}</p>
                                        </div>
                                    </label>
                                </div>
                                <Link href="/profile/addresses/create/Shipping" class="flex items-center text-blue-600 hover:underline">
                                    + Add another address
                                </Link>
                            </div>
                        </div>

                        <!-- Billing Address Section -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Billing Address</h3>
                            <div class="space-y-4">
                                <div
                                    class="bg-white shadow rounded-lg p-4 border border-gray-200"
                                    v-for="address in props.billingAddresses"
                                    :key="address.id"
                                >
                                    <label class="flex items-center space-x-3">
                                        <input
                                            type="radio"
                                            name="billingAddress"
                                            class="form-radio h-5 w-5 text-blue-600"
                                            :value="address.id"
                                            v-model="selectedBillingAddress"
                                        />
                                        <div>
                                            <p class="text-md font-bold">{{ address.name }}<span v-if="address.default" class="text-green-500">(Default)</span></p>
                                            <p>{{ address.line1 }}</p>
                                            <p>{{ address.line2 }}</p>
                                            <p>{{ `${address.city}, ${address.state}, ${address.zip}, ${address.country}` }}</p>
                                        </div>
                                    </label>
                                </div>
                                <Link href="/profile/addresses/create/Billing" class="flex items-center text-blue-600 hover:underline">
                                    + Add another address
                                </Link>
                            </div>
                        </div>
                    </section>

                    <!-- Right Column for Order Summary -->
                    <section aria-labelledby="summary-heading" class="mt-16 rounded-lg bg-gray-50 px-4 py-6 sm:p-6 lg:col-span-5 lg:mt-0 lg:p-8">
                        <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Order Summary</h2>
                        <div class="mt-6">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal:</span>
                                <span class="font-bold">{{ cartTotal }}€</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Shipping:</span>
                                <span>Free</span>
                            </div>
                            <div class="flex justify-between mt-4 border-t border-gray-200 pt-4">
                                <span class="font-bold text-lg">Total:</span>
                                <span class="font-bold text-lg">{{ cartTotal }}€</span>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-center">
                            <button @click="saveAndContinue" class="w-full max-w-xs px-6 py-3 bg-blue-600 text-white text-center font-medium rounded hover:bg-blue-700">
                                Save and Continue
                            </button>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </CartLayout>
</template>
