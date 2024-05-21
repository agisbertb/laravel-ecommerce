<!--
  This example requires some changes to your config:

  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<template>
    <div class="bg-white">
        <!-- Mobile menu -->
        <TransitionRoot as="template" :show="open">
            <Dialog as="div" class="relative z-40 lg:hidden" @close="open = false">
                <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-black bg-opacity-25" />
                </TransitionChild>

                <div class="fixed inset-0 z-40 flex">
                    <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
                        <DialogPanel class="relative flex w-full max-w-xs flex-col overflow-y-auto bg-white pb-12 shadow-xl">
                            <div class="flex px-4 pb-2 pt-5">
                                <button type="button" class="-m-2 inline-flex items-center justify-center rounded-md p-2 text-gray-400" @click="open = false">
                                    <span class="sr-only">Close menu</span>
                                    <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                                </button>
                            </div>

                            <!-- Links -->
                            <TabGroup as="div" class="mt-2">
                                <div class="border-b border-gray-200">
                                    <TabList class="-mb-px flex space-x-8 px-4">
                                        <Tab as="template" v-for="category in navigation.categories" :key="category.name" v-slot="{ selected }">
                                            <button :class="[selected ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-900', 'flex-1 whitespace-nowrap border-b-2 px-1 py-4 text-base font-medium']">{{ category.name }}</button>
                                        </Tab>
                                    </TabList>
                                </div>
                                <TabPanels as="template">
                                    <TabPanel v-for="(category, categoryIdx) in navigation.categories" :key="category.name" class="space-y-12 px-4 pb-6 pt-10">
                                        <div class="grid grid-cols-1 items-start gap-x-6 gap-y-10">
                                            <div class="grid grid-cols-1 gap-x-6 gap-y-10">
                                                <div>
                                                    <p :id="`mobile-featured-heading-${categoryIdx}`" class="font-medium text-gray-900">Featured</p>
                                                    <ul role="list" :aria-labelledby="`mobile-featured-heading-${categoryIdx}`" class="mt-6 space-y-6">
                                                        <li v-for="item in category.featured" :key="item.name" class="flex">
                                                            <a :href="item.href" class="text-gray-500">{{ item.name }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div>
                                                    <p id="mobile-categories-heading" class="font-medium text-gray-900">Categories</p>
                                                    <ul role="list" aria-labelledby="mobile-categories-heading" class="mt-6 space-y-6">
                                                        <li v-for="item in category.categories" :key="item.name" class="flex">
                                                            <a :href="item.href" class="text-gray-500">{{ item.name }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-1 gap-x-6 gap-y-10">
                                                <div>
                                                    <p id="mobile-collection-heading" class="font-medium text-gray-900">Collection</p>
                                                    <ul role="list" aria-labelledby="mobile-collection-heading" class="mt-6 space-y-6">
                                                        <li v-for="item in category.collection" :key="item.name" class="flex">
                                                            <a :href="item.href" class="text-gray-500">{{ item.name }}</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div>
                                                    <p id="mobile-brand-heading" class="font-medium text-gray-900">Brands</p>
                                                    <ul role="list" aria-labelledby="mobile-brand-heading" class="mt-6 space-y-6">
                                                        <li v-for="item in category.brands" :key="item.name" class="flex">
                                                            <a :href="item.href" class="text-gray-500">{{ item.name }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </TabPanel>
                                </TabPanels>
                            </TabGroup>



                            <div class="space-y-6 border-t border-gray-200 px-4 py-6">
                                <!-- Currency selector -->
                                <form>
                                    <div class="inline-block">
                                        <label for="mobile-currency" class="sr-only">Currency</label>
                                        <div class="group relative -ml-2 rounded-md border-transparent focus-within:ring-2 focus-within:ring-white">
                                            <select id="mobile-currency" name="currency" class="flex items-center rounded-md border-transparent bg-none py-0.5 pl-2 pr-5 text-sm font-medium text-gray-700 focus:border-transparent focus:outline-none focus:ring-0 group-hover:text-gray-800">
                                                <option v-for="currency in currencies" :key="currency">{{ currency }}</option>
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center">
                                                <ChevronDownIcon class="h-5 w-5 text-gray-500" aria-hidden="true" />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </Dialog>
        </TransitionRoot>

        <header class="relative">
            <nav aria-label="Top">
                <!-- Secondary navigation -->
                <div class="bg-white">
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div class="border-b border-gray-200">
                            <div class="flex h-16 items-center justify-between">
                                <div class="hidden h-full lg:flex">
                                    <!-- Mega menus -->
                                    <PopoverGroup class="ml-8">
                                        <div class="flex h-full justify-center space-x-8">
                                            <Popover v-for="(category, categoryIdx) in navigation.categories" :key="category.name" class="flex" v-slot="{ open }">
                                                <div class="relative flex">
                                                    <PopoverButton :class="[open ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-700 hover:text-gray-800', 'relative z-10 -mb-px flex items-center border-b-2 pt-px text-sm font-medium transition-colors duration-200 ease-out']">{{ category.name }}</PopoverButton>
                                                </div>

                                                <transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0" enter-to-class="opacity-100" leave-active-class="transition ease-in duration-150" leave-from-class="opacity-100" leave-to-class="opacity-0">
                                                    <PopoverPanel class="absolute inset-x-0 top-full text-gray-500 sm:text-sm">
                                                        <!-- Presentational element used to render the bottom shadow, if we put the shadow on the actual panel it pokes out the top, so we use this shorter element to hide the top of the shadow -->
                                                        <div class="absolute inset-0 top-1/2 bg-white shadow" aria-hidden="true" />

                                                        <div class="relative bg-white">
                                                            <div class="mx-auto max-w-7xl px-8">
                                                                <div class="grid grid-cols-2 items-start gap-x-8 gap-y-10 pb-12 pt-10">
                                                                    <div class="grid grid-cols-2 gap-x-8 gap-y-10">
                                                                        <div>
                                                                            <p :id="`desktop-featured-heading-${categoryIdx}`" class="font-medium text-gray-900">Featured</p>
                                                                            <ul role="list" :aria-labelledby="`desktop-featured-heading-${categoryIdx}`" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                                <li v-for="item in category.featured" :key="item.name" class="flex">
                                                                                    <a :href="item.href" class="hover:text-gray-800">{{ item.name }}</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                        <div>
                                                                            <p id="desktop-categories-heading" class="font-medium text-gray-900">Categories</p>
                                                                            <ul role="list" aria-labelledby="desktop-categories-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                                <li v-for="item in category.categories" :key="item.name" class="flex">
                                                                                    <a :href="item.href" class="hover:text-gray-800">{{ item.name }}</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="grid grid-cols-2 gap-x-8 gap-y-10">
                                                                        <div>
                                                                            <p id="desktop-collection-heading" class="font-medium text-gray-900">Collection</p>
                                                                            <ul role="list" aria-labelledby="desktop-collection-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                                <li v-for="item in category.collection" :key="item.name" class="flex">
                                                                                    <a :href="item.href" class="hover:text-gray-800">{{ item.name }}</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>

                                                                        <div>
                                                                            <p id="desktop-brand-heading" class="font-medium text-gray-900">Brands</p>
                                                                            <ul role="list" aria-labelledby="desktop-brand-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                                <li v-for="item in category.brands" :key="item.name" class="flex">
                                                                                    <a :href="item.href" class="hover:text-gray-800">{{ item.name }}</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </PopoverPanel>
                                                </transition>
                                            </Popover>

                                            <a v-for="page in navigation.pages" :key="page.name" :href="page.href" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800">{{ page.name }}</a>
                                        </div>
                                    </PopoverGroup>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import {
    Dialog,
    DialogPanel,
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
    Tab,
    TabGroup,
    TabList,
    TabPanel,
    TabPanels,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
import { Bars3Icon, MagnifyingGlassIcon, ShoppingCartIcon, UserIcon, XMarkIcon } from '@heroicons/vue/24/outline'
import { ChevronDownIcon } from '@heroicons/vue/20/solid'

const currencies = ['CAD', 'USD', 'AUD', 'EUR', 'GBP']
const navigation = {
    categories: [
        {
            name: 'Women',
            featured: [
                { name: 'Sleep', href: '#' },
                { name: 'Swimwear', href: '#' },
                { name: 'Underwear', href: '#' },
            ],
            collection: [
                { name: 'Everything', href: '#' },
                { name: 'Core', href: '#' },
                { name: 'New Arrivals', href: '#' },
                { name: 'Sale', href: '#' },
            ],
            categories: [
                { name: 'Basic Tees', href: '#' },
                { name: 'Artwork Tees', href: '#' },
                { name: 'Bottoms', href: '#' },
                { name: 'Underwear', href: '#' },
                { name: 'Accessories', href: '#' },
            ],
            brands: [
                { name: 'Full Nelson', href: '#' },
                { name: 'My Way', href: '#' },
                { name: 'Re-Arranged', href: '#' },
                { name: 'Counterfeit', href: '#' },
                { name: 'Significant Other', href: '#' },
            ],
        },
        {
            name: 'Men',
            featured: [
                { name: 'Casual', href: '#' },
                { name: 'Boxers', href: '#' },
                { name: 'Outdoor', href: '#' },
            ],
            collection: [
                { name: 'Everything', href: '#' },
                { name: 'Core', href: '#' },
                { name: 'New Arrivals', href: '#' },
                { name: 'Sale', href: '#' },
            ],
            categories: [
                { name: 'Artwork Tees', href: '#' },
                { name: 'Pants', href: '#' },
                { name: 'Accessories', href: '#' },
                { name: 'Boxers', href: '#' },
                { name: 'Basic Tees', href: '#' },
            ],
            brands: [
                { name: 'Significant Other', href: '#' },
                { name: 'My Way', href: '#' },
                { name: 'Counterfeit', href: '#' },
                { name: 'Re-Arranged', href: '#' },
                { name: 'Full Nelson', href: '#' },
            ],
        },
    ],
    pages: [
        { name: 'Company', href: '#' },
        { name: 'Stores', href: '#' },
    ],
}

const open = ref(false)
</script>
