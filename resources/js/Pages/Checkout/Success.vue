<template>
    <AppLayout>
    <div class="bg-white">
        <div class="mx-auto max-w-3xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8">
            <div class="max-w-xl">
                <h1 class="text-base font-medium text-blue-600">Thank you!</h1>
                <p class="mt-2 text-4xl font-bold tracking-tight sm:text-5xl">It's on the way!</p>
                <p class="mt-2 text-base text-gray-500">Your order #{{ order.id }} has shipped and will be with you soon.</p>

                <dl class="mt-12 text-sm font-medium" v-if="order.tracking_number">
                    <dt class="text-gray-900">Tracking number</dt>
                    <dd class="mt-2 text-blue-600">{{ order.tracking_number }}</dd>
                </dl>
            </div>

            <div class="mt-10 border-t border-gray-200" v-if="order.details">
                <h2 class="sr-only">Your order</h2>

                <h3 class="sr-only">Items</h3>
                <div v-for="detail in order.details" :key="detail.id" class="flex space-x-6 border-b border-gray-200 py-10">
                    <img :src="detail.product.image" :alt="detail.product.name" class="h-20 w-20 flex-none rounded-lg bg-gray-100 object-cover object-center sm:h-40 sm:w-40" />
                    <div class="flex flex-auto flex-col">
                        <div>
                            <h4 class="font-medium text-gray-900">
                                <a :href="`/products/${detail.product.id}`">{{ detail.product.name }}</a>
                            </h4>
                            <p class="mt-2 text-sm text-gray-600">{{ detail.product.description }}</p>
                        </div>
                        <div class="mt-6 flex flex-1 items-end">
                            <dl class="flex space-x-4 divide-x divide-gray-200 text-sm sm:space-x-6">
                                <div class="flex">
                                    <dt class="font-medium text-gray-900">Quantity</dt>
                                    <dd class="ml-2 text-gray-700">{{ detail.quantity }}</dd>
                                </div>
                                <div class="flex pl-4 sm:pl-6">
                                    <dt class="font-medium text-gray-900">Price</dt>
                                    <dd class="ml-2 text-gray-700">{{ detail.price }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>

                <div class="sm:ml-40 sm:pl-6" v-if="order.shipping_address && order.billing_address">
                    <h3 class="sr-only">Your information</h3>

                    <h4 class="sr-only">Addresses</h4>
                    <dl class="grid grid-cols-2 gap-x-6 py-10 text-sm">
                        <div>
                            <dt class="font-medium text-gray-900">Shipping address</dt>
                            <dd class="mt-2 text-gray-700">
                                <address class="not-italic">
                                    <span class="block">{{ order.shipping_address.name }}</span>
                                    <span class="block">{{ order.shipping_address.address }}</span>
                                    <span class="block">{{ order.shipping_address.city }}, {{ order.shipping_address.state }} {{ order.shipping_address.postal_code }}</span>
                                </address>
                            </dd>
                        </div>
                        <div>
                            <dt class="font-medium text-gray-900">Billing address</dt>
                            <dd class="mt-2 text-gray-700">
                                <address class="not-italic">
                                    <span class="block">{{ order.billing_address.name }}</span>
                                    <span class="block">{{ order.billing_address.address }}</span>
                                    <span class="block">{{ order.billing_address.city }}, {{ order.billing_address.state }} {{ order.billing_address.postal_code }}</span>
                                </address>
                            </dd>
                        </div>
                    </dl>

                    <h4 class="sr-only">Payment</h4>
                    <dl class="grid grid-cols-2 gap-x-6 border-t border-gray-200 py-10 text-sm" v-if="order.payment">
                        <div>
                            <dt class="font-medium text-gray-900">Payment method</dt>
                            <dd class="mt-2 text-gray-700">
                                <p>{{ order.payment.method }}</p>
                                <p>{{ order.payment.card_type }}</p>
                                <p><span aria-hidden="true">••••</span><span class="sr-only">Ending in </span>{{ order.payment.card_last_four }}</p>
                            </dd>
                        </div>
                        <div>
                            <dt class="font-medium text-gray-900">Shipping method</dt>
                            <dd class="mt-2 text-gray-700">
                                <p>{{ order.shipping_method }}</p>
                                <p>{{ order.shipping_time }}</p>
                            </dd>
                        </div>
                    </dl>

                    <h3 class="sr-only">Summary</h3>

                    <dl class="space-y-6 border-t border-gray-200 pt-10 text-sm">
                        <div class="flex justify-between">
                            <dt class="font-medium text-gray-900">Subtotal</dt>
                            <dd class="text-gray-700">{{ order.subtotal }}</dd>
                        </div>

                        <div class="flex justify-between">
                            <dt class="font-medium text-gray-900">Shipping</dt>
                            <dd class="text-gray-700">{{ order.shipping_cost }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="font-medium text-gray-900">Total</dt>
                            <dd class="text-gray-900">{{ order.total }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    </AppLayout>
</template>

<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";

const { props } = usePage();
const order = ref(props.order);
</script>
