<template>
    <ProfileLayout :siteSettings="siteSettings">
        <div class="py-12 bg-white">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-xl font-semibold mb-4">My Orders</h2>
                        <div v-if="orders.length === 0" class="text-center text-gray-500">
                            You have not placed any orders yet.
                        </div>
                        <div v-else>
                            <div v-for="order in orders" :key="order.id" class="mb-6">
                                <div class="border rounded-lg p-4">
                                    <h3 class="text-lg font-semibold">Order #{{ order.id }}</h3>
                                    <p class="text-gray-600">Placed on: {{ new Date(order.created_at).toLocaleDateString() }}</p>
                                    <div class="mt-4">
                                        <h4 class="font-semibold">Items:</h4>
                                        <ul>
                                            <li v-for="detail in order.details" :key="detail.id" class="ml-4 list-disc">
                                                <div v-if="detail.product">
                                                    <img :src="detail.product.image" alt="Product Image" class="w-16 h-16 object-cover" />
                                                    <span>{{ detail.product.name }} - {{ detail.quantity }} x ${{ detail.price }}</span>
                                                </div>
                                                <div v-else>
                                                    Product details not available - {{ detail.quantity }} x ${{ detail.price }}
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="mt-4">
                                        <h4 class="font-semibold">Total: ${{ order.total }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </ProfileLayout>
</template>

<script setup>
import { defineProps } from 'vue';
import ProfileLayout from "@/Layouts/ProfileLayout.vue";

const props = defineProps({
    orders: Array,
    siteSettings: Object,
});
</script>
