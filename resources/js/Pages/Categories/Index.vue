<template>
    <AppLayout :siteSettings="siteSettings" title="All Categories">
        <div class="bg-white">
            <div>
                <!-- Mobile filter dialog -->
                <TransitionRoot as="template" :show="mobileFiltersOpen">
                    <Dialog class="relative z-40 lg:hidden" @close="mobileFiltersOpen = false">
                        <TransitionChild
                            as="template"
                            enter="transition-opacity ease-linear duration-300"
                            enter-from="opacity-0"
                            enter-to="opacity-100"
                            leave="transition-opacity ease-linear duration-300"
                            leave-from="opacity-100"
                            leave-to="opacity-0"
                        >
                            <div class="fixed inset-0 bg-black bg-opacity-25" />
                        </TransitionChild>

                        <div class="fixed inset-0 z-40 flex">
                            <TransitionChild
                                as="template"
                                enter="transition ease-in-out duration-300 transform"
                                enter-from="translate-x-full"
                                enter-to="translate-x-0"
                                leave="transition ease-in-out duration-300 transform"
                                leave-from="translate-x-0"
                                leave-to="translate-x-full"
                            >
                                <DialogPanel class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl">
                                    <div class="flex items-center justify-between px-4">
                                        <h2 class="text-lg font-medium text-gray-900">Filters</h2>
                                        <button
                                            type="button"
                                            class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400"
                                            @click="mobileFiltersOpen = false"
                                        >
                                            <span class="sr-only">Close menu</span>
                                            <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                                        </button>
                                    </div>

                                    <!-- Filters -->
                                    <form class="mt-4 border-t border-gray-200">
                                        <Disclosure as="div" class="border-t border-gray-200 px-4 py-6" v-slot="{ open }" :default-open="categoriesOpen">
                                            <h3 class="-mx-2 -my-3 flow-root">
                                                <DisclosureButton class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500">
                                                    <span class="font-medium text-gray-900">Categories</span>
                                                    <span class="ml-6 flex items-center">
                                                        <PlusIcon v-if="!open" class="h-5 w-5" aria-hidden="true" />
                                                        <MinusIcon v-else class="h-5 w-5" aria-hidden="true" />
                                                    </span>
                                                </DisclosureButton>
                                            </h3>
                                            <DisclosurePanel class="pt-6">
                                                <div class="space-y-4">
                                                    <div v-for="category in categories" :key="category.id" class="flex items-center">
                                                        <input
                                                            :id="`filter-category-${category.id}`"
                                                            :name="`categories[]`"
                                                            :value="category.id"
                                                            type="checkbox"
                                                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                            v-model="selectedCategories"
                                                            @change="applyFilters"
                                                        />
                                                        <label :for="`filter-category-${category.id}`" class="ml-3 text-sm text-gray-600">{{ category.name }}</label>
                                                    </div>
                                                </div>
                                            </DisclosurePanel>
                                        </Disclosure>

                                        <Disclosure as="div" class="border-t border-gray-200 px-4 py-6" v-slot="{ open }" :default-open="tagsOpen">
                                            <h3 class="-mx-2 -my-3 flow-root">
                                                <DisclosureButton class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500">
                                                    <span class="font-medium text-gray-900">Tags</span>
                                                    <span class="ml-6 flex items-center">
                                                        <PlusIcon v-if="!open" class="h-5 w-5" aria-hidden="true" />
                                                        <MinusIcon v-else class="h-5 w-5" aria-hidden="true" />
                                                    </span>
                                                </DisclosureButton>
                                            </h3>
                                            <DisclosurePanel class="pt-6">
                                                <div class="space-y-4">
                                                    <div v-for="tag in tags" :key="tag.id" class="flex items-center">
                                                        <input
                                                            :id="`filter-tag-${tag.id}`"
                                                            :name="`tags[]`"
                                                            :value="tag.id"
                                                            type="checkbox"
                                                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                            v-model="selectedTags"
                                                            @change="applyFilters"
                                                        />
                                                        <label :for="`filter-tag-${tag.id}`" class="ml-3 text-sm text-gray-600">{{ tag.name }}</label>
                                                    </div>
                                                </div>
                                            </DisclosurePanel>
                                        </Disclosure>
                                    </form>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </Dialog>
                </TransitionRoot>

                <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex items-baseline justify-between border-b border-gray-200 pb-6 pt-24">
                        <h1 class="text-4xl font-bold tracking-tight text-gray-900">All Categories</h1>

                        <div class="flex items-center">
                            <Menu as="div" class="relative inline-block text-left">
                                <div>
                                    <MenuButton class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900">
                                        Sort
                                        <ChevronDownIcon class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
                                    </MenuButton>
                                </div>

                                <transition
                                    enter-active-class="transition ease-out duration-100"
                                    enter-from-class="transform opacity-0 scale-95"
                                    enter-to-class="transform opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="transform opacity-100 scale-100"
                                    leave-to-class="transform scale-95 opacity-0"
                                >
                                    <MenuItems class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none">
                                        <div class="py-1">
                                            <MenuItem v-for="option in sortOptions" :key="option.name" v-slot="{ active }">
                                                <a @click.prevent="sortBy(option.order)" :class="[option.current ? 'font-medium text-gray-900' : 'text-gray-500', active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm']">{{ option.name }}</a>
                                            </MenuItem>
                                        </div>
                                    </MenuItems>
                                </transition>
                            </Menu>


                            <button type="button" class="-m-2 ml-4 p-2 text-gray-400 hover:text-gray-500 sm:ml-6 lg:hidden" @click="mobileFiltersOpen = true">
                                <span class="sr-only">Filters</span>
                                <FunnelIcon class="h-5 w-5" aria-hidden="true" />
                            </button>
                        </div>
                    </div>

                    <section aria-labelledby="products-heading" class="pb-24 pt-6">
                        <h2 id="products-heading" class="sr-only">Products</h2>

                        <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
                            <!-- Filters -->
                            <form class="hidden lg:block">
                                <Disclosure as="div" class="border-b border-gray-200 py-6" v-slot="{ open }" :default-open="categoriesOpen">
                                    <h3 class="-my-3 flow-root">
                                        <DisclosureButton class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500">
                                            <span class="font-medium text-gray-900">Categories</span>
                                            <span class="ml-6 flex items-center">
                                                <PlusIcon v-if="!open" class="h-5 w-5" aria-hidden="true" />
                                                <MinusIcon v-else class="h-5 w-5" aria-hidden="true" />
                                            </span>
                                        </DisclosureButton>
                                    </h3>
                                    <DisclosurePanel class="pt-6">
                                        <div class="space-y-4">
                                            <div v-for="category in categories" :key="category.id" class="flex items-center">
                                                <input
                                                    :id="`filter-category-${category.id}`"
                                                    :name="`categories[]`"
                                                    :value="category.id"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                    v-model="selectedCategories"
                                                    @change="applyFilters"
                                                />
                                                <label :for="`filter-category-${category.id}`" class="ml-3 text-sm text-gray-600">{{ category.name }}</label>
                                            </div>
                                        </div>
                                    </DisclosurePanel>
                                </Disclosure>

                                <Disclosure as="div" class="border-b border-gray-200 py-6" v-slot="{ open }" :default-open="tagsOpen">
                                    <h3 class="-my-3 flow-root">
                                        <DisclosureButton class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500">
                                            <span class="font-medium text-gray-900">Tags</span>
                                            <span class="ml-6 flex items-center">
                                                <PlusIcon v-if="!open" class="h-5 w-5" aria-hidden="true" />
                                                <MinusIcon v-else class="h-5 w-5" aria-hidden="true" />
                                            </span>
                                        </DisclosureButton>
                                    </h3>
                                    <DisclosurePanel class="pt-6">
                                        <div class="space-y-4">
                                            <div v-for="tag in tags" :key="tag.id" class="flex items-center">
                                                <input
                                                    :id="`filter-tag-${tag.id}`"
                                                    :name="`tags[]`"
                                                    :value="tag.id"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                    v-model="selectedTags"
                                                    @change="applyFilters"
                                                />
                                                <label :for="`filter-tag-${tag.id}`" class="ml-3 text-sm text-gray-600">{{ tag.name }}</label>
                                            </div>
                                        </div>
                                    </DisclosurePanel>
                                </Disclosure>
                            </form>

                            <!-- Product grid -->
                            <div class="lg:col-span-3">
                                <div class="-mx-px grid grid-cols-2 border-l border-gray-200 sm:mx-0 md:grid-cols-3 lg:grid-cols-4">
                                    <div v-for="product in products" :key="product.id" class="group relative border-b border-r border-gray-200 p-4 sm:p-6">
                                        <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-200 group-hover:opacity-75">
                                            <img :src="product.image_url" :alt="product.name" class="h-full w-full object-cover object-center" />
                                        </div>
                                        <div class="pb-4 pt-10 text-center">
                                            <h3 class="text-sm font-medium text-gray-900">
                                                <a :href="product.href">
                                                    <span aria-hidden="true" class="absolute inset-0" />
                                                    {{ product.name }}
                                                </a>
                                            </h3>
                                            <div class="mt-3 flex flex-col items-center">
                                                <p class="sr-only">{{ product.rating }} out of 5 stars</p>
                                                <div class="flex items-center">
                                                    <StarIcon
                                                        v-for="rating in [0, 1, 2, 3, 4]"
                                                        :key="rating"
                                                        :class="[product.rating > rating ? 'text-yellow-400' : 'text-gray-200', 'h-5 w-5 flex-shrink-0']"
                                                        aria-hidden="true"
                                                    />
                                                </div>
                                                <p class="mt-1 text-sm text-gray-500">{{ product.reviewCount }} reviews</p>
                                            </div>
                                            <p class="mt-4 text-base font-medium text-gray-900">{{ product.price }} €</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import {
    Dialog,
    DialogPanel,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
import { XMarkIcon } from '@heroicons/vue/24/outline'
import { ChevronDownIcon, FunnelIcon, MinusIcon, PlusIcon, Squares2X2Icon, StarIcon } from '@heroicons/vue/20/solid'
import AppLayout from '@/Layouts/AppLayout.vue'

const { products, categories, tags, selectedCategories: serverSelectedCategories, selectedTags: serverSelectedTags, categoriesOpen: serverCategoriesOpen, tagsOpen: serverTagsOpen } = usePage().props

const props = defineProps({
    siteSettings: Object,
})

const selectedCategories = ref(serverSelectedCategories || [])
const selectedTags = ref(serverSelectedTags || [])
const categoriesOpen = ref(serverCategoriesOpen)
const tagsOpen = ref(serverTagsOpen)
const mobileFiltersOpen = ref(false)

onMounted(() => {
    categoriesOpen.value = selectedCategories.value.length > 0;
    tagsOpen.value = selectedTags.value.length > 0;
});

const fetchProducts = (order = null) => {
    console.log('Fetching products with categories:', selectedCategories.value, 'and tags:', selectedTags.value);
    router.get(route('categories.index'), {
        categories: selectedCategories.value,
        tags: selectedTags.value,
        order: order,
    }, {
        preserveState: true,
        replace: true,
        preserveScroll: true,
        onSuccess: () => {
            window.location.reload();
        }
    });
}

watch([selectedCategories, selectedTags], () => {
    console.log('Filters changed.');
    fetchProducts();
    categoriesOpen.value = selectedCategories.value.length > 0;
    tagsOpen.value = selectedTags.value.length > 0;
})

const applyFilters = () => {
    console.log('Applying filters...');
    fetchProducts();
}

const sortOptions = [
    {name: 'Most Popular', href: '#', order: 'popularity_desc', current: true},
    {name: 'Best Rating', href: '#', order: 'rating_desc', current: false},
    {name: 'Newest', href: '#', order: 'newest_desc', current: false},
    {name: 'Price: Low to High', href: '#', order: 'price_asc', current: false},
    {name: 'Price: High to Low', href: '#', order: 'price_desc', current: false},
]

const sortBy = (order) => {
    console.log('Sorting by:', order);
    fetchProducts(order);
}
</script>
