<template>
    <AppLayout title="Success" :siteSettings="siteSettings">
        <div class="bg-white flex items-center justify-center">
            <div class="max-w-3xl w-full px-4 py-16 sm:px-6 lg:px-8 text-center">
                <div class="max-w-xl mx-auto pb-24">
                    <h1 class="text-base font-medium text-blue-600">Thank you!</h1>
                    <p class="mt-2 text-4xl font-bold tracking-tight sm:text-5xl">It's on the way!</p>
                    <p class="mt-2 text-base text-gray-500">Your order #{{ order.id }} has completed and will be with you soon.</p>
                    <div class="mt-6 pb-96">
                        <a href="/" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Continue Shopping
                        </a>
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
import PrimaryButton from "@/Components/PrimaryButton.vue";

const { props } = usePage();
const order = ref(props.order);
const siteSettings = ref(props.siteSettings);
</script>
