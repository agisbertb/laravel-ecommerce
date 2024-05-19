<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
    addresses: Object,
    siteSettings: Object,
});

const destroy = (id) => {
    if (confirm('Are you sure you want to delete this address?')) {
        router.delete(`/addresses/${id}`, {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                router.reload({ only: ['addresses'] });
            }
        });
    }
};
</script>

<template>
    <AppLayout :siteSettings="siteSettings" title="My Addresses">
        <template #header>
            <h2 class="text-center font-semibold text-2xl text-gray-800 leading-tight my-8">
                My Addresses
            </h2>
        </template>

        <section class="max-w-4xl mx-auto mt-10">
            <div class="mb-10">
                <h4 class="text-lg font-semibold mb-4 text-center">Shipping Addresses</h4>
                <div v-for="address in addresses.filter(address => address.type === 'Shipping')" :key="address.id"
                     class="bg-white shadow rounded-lg p-4 mb-6">
                    <div class="text-center">
                        <p class="font-semibold">
                            {{ address.name }} <span v-if="address.default" class="text-green-500">(Default)</span>
                        </p>
                        <p>{{ address.address }}</p>
                        <p>{{ address.city }}, {{ address.state }}, {{ address.country }} {{ address.zip_code }}</p>
                        <div class="flex justify-center space-x-2 mt-3">
                            <Link :href="`/addresses/${address.id}/edit`" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">Edit</Link>
                            <button @click="destroy(address.id)" class="text-red-600 hover:underline" tabindex="-1"
                                    type="button">Delete</button>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <Link :href="'/addresses/create/Shipping'" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700 transition-colors">Add new Shipping address</Link>
                </div>
            </div>
        </section>

        <section class="max-w-4xl mx-auto">
            <div class="mb-10">
                <h4 class="text-lg font-semibold mb-4 text-center">Billing addresses</h4>
                <div v-for="address in addresses.filter(address => address.type === 'Billing')" :key="address.id"
                     class="bg-white shadow rounded-lg p-4 mb-6">
                    <div class="text-center">
                        <p class="font-semibold">
                            {{ address.name }} <span v-if="address.default" class="text-green-500">(Default)</span>
                        </p>
                        <p>{{ address.address }}</p>
                        <p>{{ address.city }}, {{ address.state }}, {{ address.country }} {{ address.zip_code }}</p>
                        <div class="flex justify-center space-x-2 mt-3">
                            <Link :href="`/addresses/${address.id}/edit`" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">Edit</Link>
                            <button @click="destroy(address.id)" class="text-red-600 hover:underline" tabindex="-1"
                                    type="button">Delete</button>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <Link :href="'/addresses/create/Billing'" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700 transition-colors">Add new billing address</Link>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
