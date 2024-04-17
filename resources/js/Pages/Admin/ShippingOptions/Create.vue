<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { ChevronRightIcon, HomeIcon, PlusIcon } from "@heroicons/vue/20/solid/index.js";
import { ref } from 'vue';

const form = ref({
    name: '',
    price: '',
    estimated_delivery_time: '',
});

function store() {
    router.post('/admin/shipping-options', form.value);
}
</script>

<template>
    <AdminLayout title="Create Product">
        <div class="mx-4 mt-4 mb-14">
            <nav class="flex" aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-4">
                    <li>
                        <div>
                            <Link href="/admin/dashboard" class="text-gray-400 hover:text-gray-500">
                                <HomeIcon class="h-5 w-5 flex-shrink-0" aria-hidden="true" />
                                <span class="sr-only">Home</span>
                            </Link>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <ChevronRightIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                            <Link href="/admin/dashboard"
                                  class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Admin</Link>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <ChevronRightIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                            <Link href="/admin/shipping-options"
                                  class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Products</Link>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <ChevronRightIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                            <Link href="/admin/shipping-options/create"
                                  class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Create</Link>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="mt-4 mx-4">
            <div class="bg-white p-6 rounded-2xl border-b shadow-2xl">

                <div class="flex justify-center px-4 py-8">
                    <div class="w-full max-w-4xl mx-auto bg-white p-8">
                        <div class="mb-8">
                            <h1 class="text-2xl font-bold text-gray-700 mb-1 text-center">Add a New Shipping Store</h1>
                            <p class="text-gray-600 text-sm text-center">Complete the form below to list a new shipping option
                                in your store.</p>
                        </div>

                        <form @submit.prevent="store" class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input v-model="form.name" type="text" id="name" name="name"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="Shipping...">
                            </div>
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Price</label>
                                    <input v-model="form.price" type="number" id="price" name="price"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="0">
                                </div>

                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Estimated Delivery</label>
                                    <input v-model="form.estimated_delivery" type="text" id="estimated_delivery" name="estimated_delivery"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="24h">
                                </div>
                            <div class="flex justify-end mt-4">
                                <button type="submit"
                                        class="inline-flex items-center gap-x-2 rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                    <PlusIcon class="-ml-0.5 h-5 w-5" aria-hidden="true" />
                                    Create shipping option
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </AdminLayout>
</template>
