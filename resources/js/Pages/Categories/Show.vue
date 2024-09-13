<template>
    <AppLayout :siteSettings="siteSettings" :title="category.name">
        <div class="bg-white">
            <main class="pb-24">
                <!-- Title Section -->
                <div class="px-4 py-16 text-center sm:px-6 lg:px-8">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900">{{ category.name }}</h1>
                    <p class="mx-auto mt-4 max-w-xl text-base text-gray-500">
                        {{ category.description }}
                    </p>
                </div>

                <!-- Filters Section -->
                <Disclosure as="section" aria-labelledby="filter-heading" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 items-center">
                    <h2 id="filter-heading" class="sr-only">Filters</h2>
                    <div class="col-start-1 row-start-1 py-4 border-b border-t border-gray-200">
                        <div class="mx-auto flex max-w-7xl justify-end px-4 sm:px-6 lg:px-8">
                            <Menu as="div" class="relative inline-block">
                                <div class="flex">
                                    <MenuButton class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900">
                                        Sort
                                        <ChevronDownIcon class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
                                    </MenuButton>
                                </div>

                                <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                                    <MenuItems class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none">
                                        <div class="py-1">
                                            <MenuItem v-for="option in sortOptions" :key="option.name" v-slot="{ active }">
                                                <a @click.prevent="sortBy(option.order)" :class="[option.current ? 'font-medium text-gray-900' : 'text-gray-500', active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm']">{{ option.name }}</a>
                                            </MenuItem>
                                        </div>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </div>
                    </div>
                </Disclosure>

                <!-- Product Grid Section -->
                <section aria-labelledby="products-heading" class="mx-auto max-w-7xl overflow-hidden sm:px-6 lg:px-8">
                    <h2 id="products-heading" class="sr-only">Products</h2>

                    <div class="border-b border-gray-200">
                        <div class="-mx-px grid grid-cols-2 sm:mx-0 md:grid-cols-3 lg:grid-cols-4">
                            <div v-for="product in products.data" :key="product.id" class="group relative p-4 sm:p-6">
                                <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-200 duration-300 ease-in-out group-hover:scale-110">
                                    <Link :href="route('products.show', product.slug)">
                                        <img :src="product.image_url" :alt="product.imageAlt" class="h-full w-full object-cover object-center" />
                                    </Link>
                                </div>
                                <div class="pb-4 pt-10 text-center">
                                    <h3 class="text-sm font-medium text-gray-900">
                                        <Link :href="route('products.show', product.slug)">
                                            <span aria-hidden="true" class="absolute inset-0" />
                                            {{ product.name }}
                                        </Link>
                                    </h3>
                                    <div class="mt-3 flex flex-col items-center">
                                        <p class="sr-only">{{ product.rating }} out of 5 stars</p>
                                        <div class="flex items-center">
                                            <StarIcon v-for="rating in [0, 1, 2, 3, 4]" :key="rating" :class="[product.average_rating > rating ? 'text-yellow-400' : 'text-gray-300', 'h-5 w-5 flex-shrink-0']" aria-hidden="true" />
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500">{{ product.total_reviews }} reviews</p>
                                    </div>
                                    <p class="mt-4 text-base font-medium text-gray-900">{{ product.price }} €</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Pagination Section -->
                <nav aria-label="Pagination" class="mx-auto mt-6 flex max-w-7xl justify-between px-4 text-sm font-medium text-gray-700 sm:px-6 lg:px-8">
                    <div class="min-w-0 flex-1">
                        <a @click.prevent="changePage(products.prev_page_url)" class="inline-flex h-10 items-center rounded-md border border-gray-300 bg-white px-4 hover:bg-gray-100 focus:border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-opacity-25 focus:ring-offset-1 focus:ring-offset-indigo-600" :class="{ 'cursor-not-allowed': !products.prev_page_url }" :aria-disabled="!products.prev_page_url">Previous</a>
                    </div>
                    <div class="hidden space-x-2 sm:flex">
                        <template v-for="page in products.last_page" :key="page">
                            <a v-if="page === '...' || page === products.current_page || Math.abs(page - products.current_page) < 3" @click.prevent="changePage(page)" :class="[page === products.current_page ? 'border-indigo-600 ring-1 ring-indigo-600' : 'border-gray-300', 'inline-flex h-10 items-center rounded-md border bg-white px-4 hover:bg-gray-100 focus:border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-opacity-25 focus:ring-offset-1 focus:ring-offset-indigo-600']">{{ page }}</a>
                            <span v-else-if="Math.abs(page - products.current_page) === 3" class="inline-flex h-10 items-center px-1.5 text-gray-500">...</span>
                        </template>
                    </div>
                    <div class="flex min-w-0 flex-1 justify-end">
                        <a @click.prevent="changePage(products.next_page_url)" class="inline-flex h-10 items-center rounded-md border border-gray-300 bg-white px-4 hover:bg-gray-100 focus:border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-opacity-25 focus:ring-offset-1 focus:ring-offset-indigo-600" :class="{ 'cursor-not-allowed': !products.next_page_url }" :aria-disabled="!products.next_page_url">Next</a>
                    </div>
                </nav>
            </main>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref } from 'vue'
import { Disclosure, Menu, MenuButton, MenuItem, MenuItems, TransitionChild } from '@headlessui/vue'
import { ChevronDownIcon, StarIcon } from '@heroicons/vue/20/solid'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link, router } from '@inertiajs/vue3'

const sortOptions = [
    {name: 'Newest', order: 'newest_desc', current: true},
    {name: 'Price: Low to High', order: 'price_asc', current: false},
    {name: 'Price: High to Low', order: 'price_desc', current: false},
]

const props = defineProps(['category', 'products', 'siteSettings'])

function sortBy(order) {
    const url = new URL(window.location.href);
    url.searchParams.set('order', order);
    router.visit(url.toString(), {
        preserveState: true,
        preserveScroll: true,
    });
}

function changePage(pageUrl) {
    if (pageUrl) {
        router.visit(pageUrl, {
            preserveState: true,
            preserveScroll: true,
        });
    }
}
</script>
