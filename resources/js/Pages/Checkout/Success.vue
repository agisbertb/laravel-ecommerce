<template>
    <AppLayout title="Payment Success">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Payment Success
            </h2>
        </template>
        <div class="container mx-auto py-12 px-4">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Thank you for your payment!</h3>
                <p>Your order has been successfully processed and your items will be on their way to you soon.</p>
                <p>Order ID: {{ orderId }}</p>
                <a href="/" class="mt-6 px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Return to Homepage
                </a>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const orderId = ref('');

onMounted(() => {
    orderId.value = route.query.order_id;
});
</script>
