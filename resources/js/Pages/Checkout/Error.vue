<template>
    <AppLayout title="Payment Error">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Payment Error
            </h2>
        </template>
        <div class="container mx-auto py-12 px-4">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">We encountered a problem</h3>
                <p>Unfortunately, there was an issue processing your payment. Please try again or contact our support if the problem persists.</p>
                <p class="mt-4">Error Message: {{ errorMessage }}</p>
                <a href="/checkout" class="mt-6 px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Return to Checkout
                </a>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const errorMessage = ref('');

if (route.query.message) {
    errorMessage.value = route.query.message;
}
</script>
