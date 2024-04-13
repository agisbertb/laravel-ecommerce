<script setup>
import { reactive } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue';
import TextInput from '@/Components/TextInput.vue'

const form = reactive({
    name: '',
    price: 0,
    estimated_delivery: '',
});

function store() {
    router.post('/admin/shipping-options', form);
};
</script>

<template>
    <AdminLayout title="Create Shipping Option">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Shipping Option
            </h2>
        </template>
        <div class="flex justify-center items-center h-screen">
            <div>
                <Head title="Create Shipping Option" />
                <h1 class="mb-8 text-3xl font-bold">
                    <Link :href="route('admin.shipping-options.index')" class="text-indigo-400 hover:text-indigo-600">Shipping Options</Link>
                    <span class="text-indigo-400 font-medium">/</span> Create
                </h1>
                <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
                    <form @submit.prevent="store">
                        <div class="flex flex-wrap -mb-4 -mr-3 p-4">
                            <TextInput v-model="form.name" class="pb-4 pr-3 w-full lg:w-1/2" label="Name" />
                            <TextInput v-model="form.price" type="number" class="pb-4 pr-3 w-full lg:w-1/2" label="Price" />
                            <TextInput v-model="form.estimated_delivery" class="pb-4 pr-3 w-full lg:w-1/2" label="Estimated Delivery" />
                        </div>
                        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                            <button class="btn-indigo" type="submit">Create Shipping Option</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
