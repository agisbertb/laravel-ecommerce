<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3';
import { ref, onMounted, watch } from 'vue';
import {
    HomeIcon, ChevronRightIcon, AdjustmentsVerticalIcon,
} from '@heroicons/vue/20/solid';
import AlertNotification from "@/Components/AlertNotification.vue";

const props = defineProps({
    categories: Object,
    flash: Object,
});

const pages = [
    { name: 'Admin', href: '/admin/dashboard', current: false },
    { name: 'Categories', href: '/admin/categories', current: true },
    { name: 'Featured', href: '/admin/categories/featured', current: true },
];

const showAlert = ref(false);
const alertMessage = ref('');

onMounted(() => {
    if (props.flash && props.flash.success) {
        alertMessage.value = props.flash.success;
        showAlert.value = true;

        setTimeout(() => {
            showAlert.value = false;
        }, 5000);
    }
});

watch(() => props.flash.success, (newValue) => {
    if (newValue) {
        alertMessage.value = newValue;
        showAlert.value = true;

        setTimeout(() => {
            showAlert.value = false;
        }, 5000);
    }
}, { immediate: true });

</script>

<template>
    <AdminLayout title="Categories">
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
                            <Link href="/admin/categories"
                                  class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Categories</Link>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <ChevronRightIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                            <Link href="/admin/categories/featured"
                                  class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Featured</Link>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <AlertNotification
            title="Success"
            :message="alertMessage"
            v-model:visible="showAlert"
        />

        <div class="mt-4 mx-4">
            <div class="bg-white p-6 rounded-2xl border-b shadow-2xl">

                <div class="sm:flex sm:items-center sm:justify-end">

                    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex sm:flex-row-reverse">
                        <Link href="/admin/categories/featured/manage">
                            <button type="button" class="inline-flex items-center gap-x-2 rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                <AdjustmentsVerticalIcon class="-ml-0.5 h-5 w-5" aria-hidden="true" />
                                Manage Featured
                            </button>
                        </Link>
                    </div>
                </div>
                <div class="mt-8 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-100">
                                    <tr>
                                        <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-center text-gray-900">Name</th>
                                        <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-center text-gray-900">Parent Category</th>
                                        <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-center text-gray-900">Description</th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="category in categories" :key="category.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                        <td class="border-t text-center">
                                            <span class="flex justify-center items-center px-6 py-4 focus:text-blue-500">
                                                {{ category.name }}
                                            </span>
                                        </td>
                                        <td class="border-t">
                                            <span class="flex justify-center items-center px-6 py-4">
                                                {{ category.parent ? category.parent.name : 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="border-t">
                                            <span class="flex justify-center items-center px-6 py-4">
                                                {{ category.description }}
                                            </span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
