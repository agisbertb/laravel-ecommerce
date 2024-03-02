<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue';
import TextInput from '@/Components/TextInput.vue'
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
  name: '',
  description: '',
  price: '',
  //product_id: '',
  stock: '',
  image: '',    
});

const store = () => {
  form.post('/admin/products');
};
</script>

<template>
  <AdminLayout title="Create products">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Products
      </h2>
    </template>
    <div class="flex justify-center items-center h-screen">
      <div>

        <Head title="Create product" />
        <h1 class="mb-8 text-3xl font-bold">
          <Link :href="route('admin.products.index')" class="text-indigo-400 hover:text-indigo-600">products</Link>
          <span class="text-indigo-400 font-medium">/</span> Create
        </h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
          <form @submit.prevent="store">
            <div class="flex flex-wrap -mb-4 -mr-3 p-4">
            
              <TextInput v-model="form.name" class="pb-4 pr-3 w-full lg:w-1/2" label="Name" placeholder="name" />

              <TextInput v-model="form.description" class="pb-4 pr-3 w-full lg:w-1/2" label="Description" placeholder="description" />

              <TextInput v-model="form.price" class="pb-4 pr-3 w-full lg:w-1/2" label="Price" placeholder="price" />

              <TextInput v-model="form.stock" class="pb-4 pr-3 w-full lg:w-1/2" label="Stock" placeholder="stock" />

              <TextInput v-model="form.image" class="pb-4 pr-3 w-full lg:w-1/2" label="Image" placeholder="image" />
            </div>
            <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
              <button class="btn-indigo" type="submit">Create product</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>