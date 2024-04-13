<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    shippingOptions: Array,
});

</script>

<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Shipping Options
            </h2>
        </template>

        <div class="p-16 px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Shipping Options</h1>
                    <p class="mt-2 text-sm text-gray-700">Manage delivery options for your products.</p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <a href="/admin/shipping-options/create">
                        <button type="button"
                                class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add
                            Shipping Option</button>
                    </a>
                </div>
            </div>
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-center text-gray-900 sm:pl-6">Id</th>
                                    <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-center text-gray-900">Name</th>
                                    <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-center text-gray-900">
                                        Price</th>
                                    <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-center text-gray-900">
                                        Estimated Delivery</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                <tr v-for="option in shippingOptions" :key="option.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                    <td class="border-t">
                                        <Link class="flex justify-center items-center px-6 py-4 focus:text-indigo-500"
                                              :href="`/admin/shipping-options/${option.id}/edit`">
                                            {{ option.id }}
                                        </Link>
                                    </td>
                                    <td class="border-t">
                                        <Link class="flex justify-center items-center px-6 py-4 focus:text-indigo-500"
                                              :href="`/admin/shipping-options/${option.id}/edit`">
                                            {{ option.name }}
                                        </Link>
                                    </td>
                                    <td class="border-t">
                                        <Link class="flex justify-center items-center px-6 py-4" :href="`/admin/shipping-options/${option.id}/edit`"
                                              tabindex="-1">
                                            €{{ option.price.toFixed(2) }}
                                        </Link>
                                    </td>
                                    <td class="border-t">
                                        <Link class="flex justify-center items-center px-6 py-4" :href="`/admin/shipping-options/${option.id}/edit`"
                                              tabindex="-1">
                                            {{ option.estimated_delivery }}
                                        </Link>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
