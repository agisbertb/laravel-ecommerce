<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link, router } from "@inertiajs/vue3";
import {
    ChevronRightIcon,
    HomeIcon,
    PlusIcon,
    PhotoIcon,
} from "@heroicons/vue/20/solid/index.js";
import { ref } from "vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/pagination";
import "swiper/css/navigation";
import { Pagination, Navigation } from "swiper/modules";

const form = ref({
    name: "",
    description: "",
    price: "",
    stock: "",
    images: [],
    imagePreviews: [],
});

function handleFiles(event) {
    const newFiles = event.target.files;
    if (newFiles) {
        for (let i = 0; i < newFiles.length; i++) {
            form.value.images.push(newFiles[i]);

            const reader = new FileReader();
            reader.onload = (e) => {
                form.value.imagePreviews.push(e.target.result);
            };
            reader.readAsDataURL(newFiles[i]);
        }
    }
}

function store() {
    let formData = new FormData();
    formData.append("name", form.value.name);
    formData.append("description", form.value.description);
    formData.append("price", form.value.price);
    formData.append("stock", form.value.stock);

    for (let i = 0; i < form.value.images.length; i++) {
        formData.append("images[]", form.value.images[i]);
    }

    router.post("/admin/products", formData, {
        headers: {
            "Content-Type": "multipart/form-data",
        },
    });
}

function removeImage(index) {
    form.value.imagePreviews.splice(index, 1);
    form.value.images.splice(index, 1);
}
</script>

<template>
    <AdminLayout title="Create Product">
        <div class="mx-4 mt-4 mb-14">
            <nav class="flex" aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-4">
                    <li>
                        <div>
                            <Link
                                href="/admin/dashboard"
                                class="text-gray-400 hover:text-gray-500"
                            >
                                <HomeIcon
                                    class="h-5 w-5 flex-shrink-0"
                                    aria-hidden="true"
                                />
                                <span class="sr-only">Home</span>
                            </Link>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <ChevronRightIcon
                                class="h-5 w-5 flex-shrink-0 text-gray-400"
                                aria-hidden="true"
                            />
                            <Link
                                href="/admin/dashboard"
                                class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
                                >Admin</Link
                            >
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <ChevronRightIcon
                                class="h-5 w-5 flex-shrink-0 text-gray-400"
                                aria-hidden="true"
                            />
                            <Link
                                href="/admin/products"
                                class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
                                >Products</Link
                            >
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <ChevronRightIcon
                                class="h-5 w-5 flex-shrink-0 text-gray-400"
                                aria-hidden="true"
                            />
                            <Link
                                href="/admin/products/create"
                                class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
                                >Create</Link
                            >
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
                            <h1
                                class="text-2xl font-bold text-gray-700 mb-1 text-center"
                            >
                                Add a New Product
                            </h1>
                            <p class="text-gray-600 text-sm text-center">
                                Complete the form below to list a new product in
                                your store.
                            </p>
                        </div>

                        <form @submit.prevent="store" class="space-y-6">
                            <div>
                                <label
                                    for="name"
                                    class="block text-sm font-medium text-gray-700"
                                    >Product Name</label
                                >
                                <input
                                    v-model="form.name"
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Product..."
                                />
                            </div>
                            <div>
                                <label
                                    for="description"
                                    class="block text-sm font-medium text-gray-700"
                                    >Description</label
                                >
                                <textarea
                                    v-model="form.description"
                                    id="description"
                                    name="description"
                                    rows="4"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Provide a detailed description of the product"
                                ></textarea>
                            </div>
                            <div class="md:flex md:gap-6 md:items-end">
                                <div class="md:w-1/2">
                                    <label
                                        for="price"
                                        class="block text-sm font-medium text-gray-700"
                                        >Price</label
                                    >
                                    <input
                                        v-model="form.price"
                                        type="text"
                                        id="price"
                                        name="price"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="0.00"
                                    />
                                </div>
                                <div class="md:w-1/2">
                                    <label
                                        for="stock"
                                        class="block text-sm font-medium text-gray-700"
                                        >Stock</label
                                    >
                                    <input
                                        v-model="form.stock"
                                        type="number"
                                        id="stock"
                                        name="stock"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Quantity"
                                    />
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label
                                    for="cover-photo"
                                    class="block text-sm font-medium leading-6 text-gray-900"
                                    >Photo</label
                                >
                                <div
                                    class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10"
                                >
                                    <div class="text-center">
                                        <PhotoIcon
                                            class="mx-auto h-12 w-12 text-gray-300"
                                            aria-hidden="true"
                                        />
                                        <div
                                            class="mt-4 flex text-sm leading-6 text-gray-600"
                                        >
                                            <label
                                                for="images"
                                                class="relative cursor-pointer rounded-md bg-white font-semibold text-blue-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-600 focus-within:ring-offset-2 hover:text-blue-500"
                                            >
                                                <span>Upload a file</span>
                                                <input
                                                    id="images"
                                                    name="images[]"
                                                    type="file"
                                                    class="sr-only"
                                                    multiple
                                                    @change="handleFiles"
                                                />
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p
                                            class="text-xs leading-5 text-gray-600"
                                        >
                                            PNG, JPG, GIF up to 10MB
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <Swiper
                                :slidesPerView="1"
                                :spaceBetween="30"
                                :loop="true"
                                :pagination="{
                                    clickable: true,
                                    el: '.swiper-pagination',
                                }"
                                :navigation="{
                                    nextEl: '.swiper-button-next',
                                    prevEl: '.swiper-button-prev',
                                }"
                                :modules="[Pagination, Navigation]"
                                class="mySwiper"
                            >
                                <!-- Slides -->
                                <SwiperSlide
                                    v-for="(image, index) in form.imagePreviews"
                                    :key="index"
                                >
                                    <img
                                        :src="image"
                                        alt="Preview"
                                        class="object-cover rounded-lg shadow-md h-96"
                                    />
                                    <!-- Button to remove the image -->
                                    <button
                                        @click="removeImage(index)"
                                        class="absolute top-0 right-0 m-2 bg-red-500 text-white p-1 rounded-full"
                                    >
                                        <svg
                                            class="w-6 h-6"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"
                                            />
                                        </svg>
                                    </button>
                                </SwiperSlide>

                                <!-- Add Pagination -->
                                <div class="swiper-pagination"></div>

                                <!-- Add Navigation -->
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </Swiper>

                            <div class="flex justify-end mt-4">
                                <button
                                    type="submit"
                                    class="inline-flex items-center gap-x-2 rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                                >
                                    <PlusIcon
                                        class="-ml-0.5 h-5 w-5"
                                        aria-hidden="true"
                                    />
                                    Create product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
