<template>
    <div class="relative flex-1 flex justify-center px-2 sm:ml-6 lg:ml-6 lg:justify-center hidden sm:block" ref="searchContainerRef">
        <div v-if="openSearch" class="fixed inset-0 bg-black bg-opacity-50 z-10" @click="closeSearch"></div>
        <div class="max-w-2xl w-full relative z-20">
            <label for="search" class="sr-only">Search</label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center">
                    <MagnifyingGlassIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                </div>
                <input
                    id="search"
                    name="search"
                    v-model="searchQuery"
                    @focus="openSearch = true"
                    @input="fetchResults"
                    class="block w-full pl-10 pr-10 py-2 border border-transparent rounded-md leading-5 bg-gray-100 text-gray-900 placeholder-gray-500 focus:outline-none focus:bg-white focus:border-white focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm"
                    placeholder="Search"
                    type="search"
                />
            </div>

            <transition name="fade" enter-active-class="transition-opacity duration-300" leave-active-class="transition-opacity duration-300">
                <div v-if="openSearch" class="absolute z-20 mt-1 w-full max-w-2xl bg-white shadow-lg rounded-md overflow-hidden">
                    <ul class="divide-y divide-gray-200">
                        <li v-for="result in filteredResults" :key="result.id" class="px-4 py-4 hover:bg-gray-100">
                            <Link :href="result.url" class="flex items-center space-x-4">
                                <img :src="result.image_url" class="h-16 w-16 object-cover rounded" alt="">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ result.name }}</p>
                                    <p class="text-sm text-gray-500">{{ result.price }} €</p>
                                </div>
                            </Link>
                        </li>

                        <li v-if="filteredResults.length === 0" class="px-6 py-14 text-center text-sm sm:px-14">
                            <ExclamationCircleIcon type="outline" name="exclamation-circle" class="mx-auto h-6 w-6 text-gray-400" />
                            <p class="mt-4 font-semibold text-gray-900">No results found</p>
                            <p class="mt-2 text-gray-500">No products found for this search term. Please try again.</p>
                        </li>
                    </ul>
                </div>
            </transition>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { MagnifyingGlassIcon, ExclamationCircleIcon } from '@heroicons/vue/24/outline';
import axios from 'axios';
import { Link } from '@inertiajs/vue3';

const openSearch = ref(false);
const searchQuery = ref('');
const searchContainerRef = ref(null);

const results = ref([]);

const filteredResults = computed(() => {
    if (searchQuery.value === '') return [];
    return results.value;
});

onMounted(() => {
    document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside);
});

function handleClickOutside(event) {
    if (searchContainerRef.value && !searchContainerRef.value.contains(event.target)) {
        openSearch.value = false;
    }
}

function closeSearch() {
    openSearch.value = false;
}

async function fetchResults() {
    if (searchQuery.value === '') {
        results.value = [];
        return;
    }

    try {
        const response = await axios.get(route('search.products'), {
            params: {query: searchQuery.value}
        });
        results.value = response.data;
    } catch (error) {
        console.error('Error fetching search results:', error);
    }
}
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.3s;
}

.fade-enter-from, .fade-leave-to {
    opacity: 0;
}
</style>
