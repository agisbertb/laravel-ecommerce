
<template>
    <AppLayout title="Dashboard">
    <div class="bg-white">

        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <nav aria-label="Breadcrumb" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <ol role="list" class="flex items-center space-x-4">
                    <li v-for="breadcrumb in product.breadcrumbs" :key="breadcrumb.id">
                        <div class="flex items-center">
                            <a :href="breadcrumb.href" class="mr-4 text-sm font-medium text-gray-900">{{ breadcrumb.name }}</a>
                            <svg viewBox="0 0 6 20" aria-hidden="true" class="h-5 w-auto text-gray-300">
                                <path d="M4.878 4.34H3.551L.27 16.532h1.327l3.281-12.19z" fill="currentColor" />
                            </svg>
                        </div>
                    </li>
                    <li class="text-sm">
                        <a :href="product.href" aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">{{ product.name }}</a>                    </li>
                </ol>
            </nav>

            <div class="lg:grid lg:grid-cols-2 lg:items-start lg:gap-x-8 mt-8">
                <!-- Image gallery -->
                <TabGroup as="div" class="flex flex-col-reverse">
                    <!-- Image selector -->
                    <div class="mx-auto mt-6 hidden w-full max-w-2xl sm:block lg:max-w-none">
                        <TabList class="grid grid-cols-4 gap-6">
                            <Tab v-for="image in product.images" :key="image.id" class="relative flex h-24 cursor-pointer items-center justify-center rounded-md bg-white text-sm font-medium uppercase text-gray-900 hover:bg-gray-50 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-offset-4" v-slot="{ selected }">
                                <span class="sr-only">{{ image.name }}</span>
                                <span class="absolute inset-0 overflow-hidden rounded-md">
                  <img :src="image.url" alt="" class="h-full w-full object-cover object-center" />
                </span>
                                <span :class="[selected ? 'ring-blue-500' : 'ring-transparent', 'pointer-events-none absolute inset-0 rounded-md ring-2 ring-offset-2']" aria-hidden="true" />
                            </Tab>
                        </TabList>
                    </div>

                    <TabPanels class="aspect-h-1 aspect-w-1 w-full">
                        <TabPanel v-for="image in product.images" :key="image.id">
                            <img :src="image.url" :alt="image.alt" class="h-full w-full object-cover object-center sm:rounded-lg" />
                        </TabPanel>
                    </TabPanels>
                </TabGroup>

                <!-- Product info -->
                <div class="mt-10 px-4 sm:mt-16 sm:px-0 lg:mt-0">
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ product.name }}</h1>

                    <div class="mt-3">
                        <h2 class="sr-only">Product information</h2>
                        <p class="text-3xl tracking-tight text-gray-900">{{ product.price }}€</p>
                    </div>

                    <!-- Reviews -->
                    <div class="mt-3">
                        <h3 class="sr-only">Reviews</h3>
                        <div class="flex items-center">
                            <div class="flex items-center">
                                <StarIcon v-for="rating in [0, 1, 2, 3, 4]" :key="rating" :class="[product.rating > rating ? 'text-yellow-400' : 'text-gray-300', 'h-5 w-5 flex-shrink-0']" aria-hidden="true" />
                            </div>
                            <p class="sr-only">{{ product.rating }} out of 5 stars</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="sr-only">Description</h3>

                        <div class="mt-6 text-base text-gray-700 break-words overflow-hidden" v-html="product.description"></div>

                    </div>

                    <form class="mt-6">
                        <!-- Colors -->


                        <div class="mt-10 flex">
                            <button @click="handleAddToCart" class="flex max-w-xs flex-1 items-center justify-center rounded-md border border-transparent bg-blue-600 px-8 py-3 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-50 sm:w-full">Add to bag</button>

                            <button type="button" class="ml-4 flex items-center justify-center rounded-md px-3 py-3 text-gray-400 hover:bg-gray-100 hover:text-gray-500">
                                <HeartIcon class="h-6 w-6 flex-shrink-0" aria-hidden="true" />
                                <span class="sr-only">Add to favorites</span>
                            </button>
                        </div>
                    </form>

                    <section aria-labelledby="details-heading" class="mt-12">
                        <h2 id="details-heading" class="sr-only">Additional details</h2>

                        <div class="divide-y divide-gray-200 border-t">
                            <Disclosure as="div" v-for="detail in product.details" :key="detail.name" v-slot="{ open }">
                                <h3>
                                    <DisclosureButton class="group relative flex w-full items-center justify-between py-6 text-left">
                                        <span :class="[open ? 'text-blue-600' : 'text-gray-900', 'text-sm font-medium']">{{ detail.name }}</span>
                                        <span class="ml-6 flex items-center">
                      <PlusIcon v-if="!open" class="block h-6 w-6 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
                      <MinusIcon v-else class="block h-6 w-6 text-blue-400 group-hover:text-blue-500" aria-hidden="true" />
                    </span>
                                    </DisclosureButton>
                                </h3>
                                <DisclosurePanel as="div" class="prose prose-sm pb-6">
                                    <ul role="list">
                                        <li v-for="item in detail.items" :key="item">{{ item }}</li>
                                    </ul>
                                </DisclosurePanel>
                            </Disclosure>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    </AppLayout>
</template>

<script setup>

import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue'
import {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    RadioGroup,
    RadioGroupLabel,
    RadioGroupOption,
    Tab,
    TabGroup,
    TabList,
    TabPanel,
    TabPanels,
} from '@headlessui/vue'
import { StarIcon } from '@heroicons/vue/20/solid'
import { HeartIcon, MinusIcon, PlusIcon } from '@heroicons/vue/24/outline'

const props = defineProps({
    product: Object
});

import useCart from '@/Composables/useCart';
const { addToCart } = useCart();

const handleAddToCart = async (event) => {
    event.preventDefault();

    if (!props.product || props.product.id === undefined) {
        console.error('Product is undefined or lacks an ID.');
        return;
    }

    await addToCart({
        id: props.product.id,
        quantity: 1,
        price: props.product.price
    });
};

</script>
