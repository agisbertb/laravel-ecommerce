<script setup>
import { reactive } from 'vue'
import { router, Link } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { ChevronRightIcon, HomeIcon, TrashIcon, ArrowPathIcon } from "@heroicons/vue/20/solid/index.js";


const props = defineProps({
    product: Object,
});

const form = reactive({
    name: props.product.name,
    description: props.product.description,
    price: props.product.price,
    stock: props.product.stock,
    image: props.product.image,
});

function update() {
    router.put(`/admin/products/${props.product.id}`, form);
}
function destroy() {
    if (confirm('Are you sure you want to delete this product?')) {
        router.delete(`/admin/products/${props.product.id}`);
    }
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
                            <Link href="/admin/products"
                                class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Products</Link>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <ChevronRightIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                            <a class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Edit</a>
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
                            <h1 class="text-2xl font-bold text-gray-700 mb-1 text-center">Update this Product</h1>
                            <p class="text-gray-600 text-sm text-center">Complete the form below to update a product in
                                your store.</p>
                        </div>
                        <form @submit.prevent="update" class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                                <input v-model="form.name" type="text" id="name" name="name"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Product...">
                            </div>
                            <div>
                                <label for="description"
                                    class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea v-model="form.description" id="description" name="description" rows="4"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Provide a detailed description of the product"></textarea>
                            </div>
                            <div class="md:flex md:gap-6 md:items-end">
                                <div class="md:w-1/2">
                                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                    <input v-model="form.price" type="text" id="price" name="price"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="0.00">
                                </div>
                                <div class="md:w-1/2">
                                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                                    <input v-model="form.stock" type="number" id="stock" name="stock"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Quantity">
                                </div>
                            </div>
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                                <input v-model="form.image" type="text" id="image" name="image"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div class="flex justify-end mt-4 space-x-4">
                                <button type="button" @click="destroy"
                                    class="inline-flex items-center gap-x-2 rounded-md bg-red-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                    <TrashIcon class="-ml-0.5 h-5 w-5" aria-hidden="true" />
                                    Delete Product
                                </button>
                                <button type="submit"
                                    class="inline-flex items-center gap-x-2 rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                    <ArrowPathIcon class="-ml-0.5 h-5 w-5" aria-hidden="true" />
                                    Update Product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
