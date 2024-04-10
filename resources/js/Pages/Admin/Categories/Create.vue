<script setup>
import { reactive, defineProps } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue';
import TextInput from '@/Components/TextInput.vue'

const props = defineProps({
    categories: Array,
});

const form = reactive({
    name: '',
    description: '',
    parent_id: null,
});

function store () {
    router.post('/admin/categories', form);
}
</script>


<template>
    <AdminLayout title="Create categories">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categories
            </h2>
        </template>
        <div class="flex justify-center items-center h-screen">
            <div>

                <Head title="Create category" />
                <h1 class="mb-8 text-3xl font-bold">
                    <Link :href="route('admin.categories.index')" class="text-indigo-400 hover:text-indigo-600">Categories</Link>
                    <span class="text-indigo-400 font-medium">/</span> Create
                </h1>
                <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
                    <form @submit.prevent="store">
                        <div class="flex flex-wrap -mb-4 -mr-3 p-4">
                            <TextInput v-model="form.name" class="pb-4 pr-3 w-full lg:w-1/2" label="Name" />
                            <TextInput v-model="form.description" class="pb-4 pr-3 w-full lg:w-1/2" label="Description" />
                        </div>

                        <div class="pb-4 pr-3 w-full lg:w-1/2">
                            <label for="parent_id" class="form-label">Parent Category</label>
                            <select v-model="form.parent_id" id="parent_id" class="form-select mt-1 block w-full">
                                <option value="">No Parent</option>
                                <option v-for="category in categories" :key="category.id" :value="category.id">{{
                                    category.name }}</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                            <button class="btn-indigo" type="submit">Create category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
