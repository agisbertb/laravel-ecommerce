<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue'
import { useForm } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';


const props = defineProps({
  category: Object,
});

const form = useForm({
  name: props.category.name,
  description: props.category.description,
});

const update = () => {
  form.put(`/admin/categories/${props.category.id}`);
};

const destroy = () => {
  if (confirm('Are you sure you want to delete this category?')) {
    form.delete(`/admin/categories/${props.category.id}`);
  }
};
</script>

<template>
  <AppLayout title="Edit categories">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Categories
      </h2>
    </template>
    <div class="flex justify-center items-center h-screen">
      <div>

        <Head title="Update category" />
        <h1 class="mb-8 text-3xl font-bold">
          <Link :href="route('admin.categories.index')" class="text-indigo-400 hover:text-indigo-600">Categories</Link>
          <span class="text-indigo-400 font-medium">/</span> Update
        </h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
          <form @submit.prevent="update">
            <div class="flex flex-wrap -mb-4 -mr-3 p-4">
              <text-input v-model="form.name" class="pb-4 pr-3 w-full lg:w-1/2" label="Name" />
              <text-input v-model="form.description" class="pb-4 pr-3 w-full lg:w-1/2" label="Description" />
            </div>
            <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
              <button class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete
                category</button>
              <button class="btn-indigo" type="submit">Update category</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>