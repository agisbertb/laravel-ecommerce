<template>
    <AdminLayout title="Manage Favorite Products">
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
                            <Link href="/admin/products"
                                  class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Products</Link>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <ChevronRightIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                            <Link href="/admin/products/favorite"
                                  class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Favorite</Link>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <ChevronRightIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                            <Link href="/admin/products/favorite/manage"
                                  class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Manage</Link>
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
                            <h1 class="text-2xl font-bold text-gray-700 mb-1 text-center">Manage Favorite Products</h1>
                            <p class="text-gray-600 text-sm text-center">Select the 3 products you want to mark as favorites on the main page.</p>
                        </div>

                        <form @submit.prevent="saveProduct" class="space-y-6">
                            <div v-for="(product, index) in form.favorite" :key="index">
                                <label class="block text-gray-700 text-sm font-bold mb-2" :for="'favorite' + index">
                                    Favorite Product {{ index + 1 }}
                                </label>
                                <select :id="'favorite' + index" v-model="form.favorite[index]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Select a product</option>
                                    <option v-for="product in products" :key="product.id" :value="product.id">
                                        {{ product.name }}
                                    </option>
                                </select>
                            </div>

                            <div class="flex items-center justify-between mt-6">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                    Save Products
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { reactive, defineProps } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import { ChevronRightIcon, HomeIcon } from "@heroicons/vue/20/solid/index.js";

const props = defineProps({
    products: Array,
    favoriteProducts: Array
});

const form = reactive({
    favorite: Array(3).fill('')
});

props.favoriteProducts.forEach((id, index) => {
    form.favorite[index] = id;
});

function saveProduct() {
    router.put('/admin/products/favorite/save', {
        favorite: form.favorite
    }, {
        onSuccess: () => {
            router.visit('/admin/products/favorite');
        },
        onError: (error) => {
            console.error('Error while saving favorite products:', error);
            alert('Error while saving favorite products: ' + error.message);
        }
    });
}
</script>
