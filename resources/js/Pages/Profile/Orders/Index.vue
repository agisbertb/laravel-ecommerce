<template>
    <ProfileLayout :siteSettings="siteSettings">
        <div class="bg-white">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Your Orders</h1>
                <p class="mt-2 text-sm text-gray-500">Check the status of recent orders, manage returns, and discover similar products.</p>
                <div class="mt-12 space-y-16 sm:mt-16">
                    <section v-for="order in orders" :key="order.id" :aria-labelledby="`${order.id}-heading`">
                        <div class="space-y-1 md:flex md:items-baseline md:space-x-4 md:space-y-0">
                            <h2 :id="`${order.id}-heading`" class="text-lg font-medium text-gray-900 md:flex-shrink-0">Order #{{ order.id }}</h2>
                            <div class="space-y-5 sm:flex sm:items-baseline sm:justify-between sm:space-y-0 md:min-w-0 md:flex-1">
                                <p class="text-sm font-medium text-gray-500">Created at {{ new Date(order.created_at).toLocaleDateString() }}</p>
                            </div>
                        </div>
                        <div class="-mb-6 mt-6 flow-root divide-y divide-gray-200 border-t border-gray-200">
                            <div v-for="detail in order.details" :key="detail.id" class="py-6 sm:flex">
                                <div class="flex space-x-4 sm:min-w-0 sm:flex-1 sm:space-x-6 lg:space-x-8">
                                    <img :src="detail.product.image_url" :alt="detail.product.name" class="h-20 w-20 flex-none rounded-md object-cover object-center sm:h-48 sm:w-48" />
                                    <div class="min-w-0 flex-1 pt-1.5 sm:pt-0">
                                        <h3 class="text-sm font-medium text-gray-900">
                                            <Link :href="detail.product.href">{{ detail.product.name }}</Link>
                                        </h3>
                                        <p class="mt-1 font-medium text-gray-900">{{ detail.price }} €</p>
                                    </div>
                                </div>
                                <div class="mt-6 space-y-4 sm:ml-6 sm:mt-0 sm:w-40 sm:flex-none">
                                    <Link :href="detail.product.href" class="flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-2.5 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-full sm:flex-grow-0">Buy again</Link>
                                    <Link :href="detail.product.categoryHref" class="flex w-full items-center justify-center rounded-md border border-gray-300 bg-white px-2.5 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-full sm:flex-grow-0">Shop similar</Link>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </ProfileLayout>
</template>

<script setup>
import { defineProps } from 'vue';
import ProfileLayout from "@/Layouts/ProfileLayout.vue";
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    orders: Array,
    siteSettings: Object,
});
</script>
