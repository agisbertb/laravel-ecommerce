<script setup>
import { reactive, ref } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { ChevronRightIcon, HomeIcon, TrashIcon, ArrowPathIcon, PhotoIcon } from "@heroicons/vue/20/solid/index.js";
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/navigation';
import { Pagination, Navigation } from 'swiper/modules';

const props = defineProps({
    category: Object,
    categories: Array,
});

const form = reactive({
    name: props.category.name || '',
    description: props.category.description || '',
    parent_id: props.category.parent_id || '',
    image: null
});

const imagePreview = ref(props.category.image ? `/storage/${props.category.image}` : '');

function update() {
    const formData = new FormData();
    formData.append('name', form.name);
    formData.append('description', form.description);
    formData.append('parent_id', form.parent_id || '');
    if (form.image instanceof File) {
        formData.append('image', form.image);
    } else {
        formData.append('image', '');
    }

    formData.append('_method', 'PUT');

    router.post(`/admin/categories/${props.category.id}`, formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        },
        onError: (error) => {
            console.error('Error:', error);
            alert('Error updating the category.');
        }
    });
}

function handleImageChange(event) {
    const file = event.target.files[0];
    if (file) {
        form.image = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}

function destroy() {
    if (confirm('Are you sure you want to delete this category?')) {
        router.delete(`/admin/categories/${props.category.id}`);
    }
}

function removeImage() {
    form.image = null;
    imagePreview.value = '';
}
</script>

<template>
    <AdminLayout title="Update category">
        <div class="mx-4 mt-4 mb-14">
            <nav class="flex" aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-4">
                    <li>
                        <div>
                            <Link href="/admin/dashboard" class="text-gray-400 hover:text-gray-500">
                                <HomeIcon class="h-5 w-5 flex-shrink-0" aria-hidden="true"/>
                                <span class="sr-only">Home</span>
                            </Link>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <ChevronRightIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true"/>
                            <Link href="/admin/dashboard"
                                  class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Admin
                            </Link>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <ChevronRightIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true"/>
                            <Link href="/admin/categories"
                                  class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Categories
                            </Link>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <ChevronRightIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true"/>
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
                            <h1 class="text-2xl font-bold text-gray-700 mb-1 text-center">Update {{ form.name }}</h1>
                            <p class="text-gray-600 text-sm text-center">Complete the form below to update a category in
                                your store.</p>
                        </div>
                        <form @submit.prevent="update" class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                                <input v-model="form.name" type="text" id="name" name="name"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="category...">
                            </div>
                            <div>
                                <label for="description"
                                       class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea v-model="form.description" id="description" name="description" rows="4"
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                          placeholder="Provide a detailed description of the category"></textarea>
                            </div>
                            <div>
                                <label for="parent_id" class="block text-sm font-medium text-gray-700">Parent Category</label>
                                <select v-model="form.parent_id" id="parent_id" name="parent_id"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">No parent</option>
                                    <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                                </select>
                            </div>

                            <div>
                                <label for="image" class="block text-base font-bold text-gray-900">Category Image</label>
                                <div class="mt-4 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <PhotoIcon class="mx-auto h-12 w-12 text-gray-400" />
                                        <div class="flex text-sm text-gray-600">
                                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                <span>Upload a file</span>
                                                <input id="image" name="image" type="file" class="sr-only" @change="handleImageChange">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            PNG, JPG, GIF up to 10MB
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Swiper for image preview -->
                            <Swiper :modules="[Pagination, Navigation]" class="mySwiper" spaceBetween={30} slidesPerView={1} navigation pagination>
                                <SwiperSlide v-if="imagePreview">
                                    <img :src="imagePreview" alt="Preview" class="object-cover rounded-lg shadow-md h-96" />
                                    <button @click="removeImage" class="absolute top-0 right-0 m-2 bg-red-500 text-white p-1 rounded-full">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </SwiperSlide>
                            </Swiper>

                            <div class="flex justify-end mt-4 space-x-4">
                                <button type="button" @click="destroy"
                                        class="inline-flex items-center gap-x-2 rounded-md bg-red-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                    <TrashIcon class="-ml-0.5 h-5 w-5" aria-hidden="true"/>
                                    Delete category
                                </button>
                                <button type="submit"
                                        class="inline-flex items-center gap-x-2 rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                    <ArrowPathIcon class="-ml-0.5 h-5 w-5" aria-hidden="true"/>
                                    Update category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
