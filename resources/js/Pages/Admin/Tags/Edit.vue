<script setup>
import { reactive, defineProps } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue';
import TextInput from '@/Components/TextInput.vue'

const props = defineProps({
    tag: Object,
});

const form = reactive({
    name: props.tag.name,
    description: props.tag.description,
});

function update() {
    router.put(`/admin/tags/${props.tag.id}`, form);
}

const destroy = () => {
    if (confirm('Are you sure you want to delete this tag?')) {
        router.delete(`/admin/tags/${props.tag.id}`);
    }
};
</script>


<template>
  <AdminLayout title="Edit Tags">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Tags
      </h2>
    </template>
    <div class="flex justify-center items-center h-screen">
      <div>

        <Head title="Update Tag" />
        <h1 class="mb-8 text-3xl font-bold">
          <Link :href="route('admin.tags.index')" class="text-indigo-400 hover:text-indigo-600">Tags</Link>
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
                Tag</button>
              <button class="btn-indigo" type="submit">Update Tag</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
