<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { HomeIcon, ChevronLeftIcon, ChevronRightIcon, PlusIcon } from '@heroicons/vue/20/solid';
import { ref, watch, onMounted, onBeforeUnmount } from 'vue';
import {
    BarsArrowUpIcon,
    ChevronDownIcon,
    MagnifyingGlassIcon,
    TrashIcon,
    PencilSquareIcon
} from "@heroicons/vue/20/solid/index.js";
import AlertNotification from "@/Components/AlertNotification.vue";

const props = defineProps({
    users: Object,
    flash: Object,
});

const pages = [
    { name: 'Admin', href: '/admin/dashboard', current: false },
    { name: 'Users', href: '/admin/users', current: true },
];

const showDropdown = ref(false);
const orderBy = ref('');
const searchQuery = ref('');
const showAlert = ref(false);
const alertMessage = ref('');


const closeDropdown = (event) => {
    if (!event.target.closest('.dropdown-button') && !event.target.closest('.dropdown-menu')) {
        showDropdown.value = false;
    }
};

onMounted(() => {
    if (props.flash && props.flash.success) {
        alertMessage.value = props.flash.success;
        showAlert.value = true;

        setTimeout(() => {
            showAlert.value = false;
        }, 5000);
    }
});

onBeforeUnmount(() => {
    window.removeEventListener('click', closeDropdown);
});

watch(searchQuery, (newValue) => {
    fetchusers(newValue);
});

watch(() => props.flash.success, (newValue) => {
    if (newValue) {
        alertMessage.value = newValue;
        showAlert.value = true;

        setTimeout(() => {
            showAlert.value = false;
        }, 5000);
    }
}, { immediate: true });


const paginationRange = (current, last) => {
    let start = current - 1;
    let end = current + 1;
    const range = [];

    if (start < 1) {
        start = 1;
    }
    if (end > last) {
        end = last;
    }

    for (let i = start; i <= end; i++) {
        range.push(i);
    }

    if (start > 2) {
        range.unshift('...');
        range.unshift(1);
    }

    if (end < last - 1) {
        range.push('...');
        range.push(last);
    } else if (end === last - 1) {
        range.push(last);
    }

    return range;
};


function fetchusers(query, order = orderBy.value) {
    router.get('/admin/users', { search: query, order: order }, {
        preserveState: true,
        replace: true,
        preserveScroll: true,
    });
}

function sortBy(order) {
    orderBy.value = order;
    fetchusers(searchQuery.value, order);
    showDropdown.value = false;
}

function destroy(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        router.delete(`/admin/users/${userId}`);
    }
}



</script>


<template>
    <AdminLayout title="users">
        <div class="mx-4 mt-4 mb-14">
            <nav class="flex" aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-4">
                    <li>
                        <div>
                            <Link href="/admin/dashboard" class="text-gray-400 hover:text-gray-500">
                                <HomeIcon class="h-5 w-5 flex-shrink-0" aria-hidden="true" />
                                <span class="sr-only">Home</span>
                            </Link>
                        </div>
                    </li>
                    <li v-for="page in pages" :key="page.name">
                        <div class="flex items-center">
                            <ChevronRightIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                            <a :href="page.href" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
                               :aria-current="page.current ? 'page' : undefined">{{ page.name }}</a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <AlertNotification title="Success" :message="alertMessage" v-model:visible="showAlert" />

        <div class="mt-4 mx-4">
            <div class="bg-white p-6 rounded-2xl border-b shadow-2xl">

                <div class="sm:flex sm:items-center sm:justify-between">

                    <div class="relative inline-block text-left">
                        <label for="mobile-search-candidate" class="sr-only">Search</label>
                        <label for="desktop-search-candidate" class="sr-only">Search</label>
                        <div class="flex rounded-md shadow-sm">
                            <div class="relative flex-grow focus-within:z-10">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <MagnifyingGlassIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                </div>
                                <input v-model="searchQuery" id="mobile-search-candidate" name="search" type="search"
                                       class="block w-full rounded-none rounded-l-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:hidden"
                                       placeholder="Search" />
                                <input v-model="searchQuery" id="desktop-search-candidate" name="search-mobile"
                                       type="search"
                                       class="hidden w-full rounded-none rounded-l-md border-0 py-1.5 pl-10 text-sm leading-6 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:block"
                                       placeholder="Search users" />
                            </div>
                            <button @click="showDropdown = !showDropdown" type="button"
                                    class="dropdown-button relative -ml-px inline-flex items-center gap-x-1.5 rounded-r-md px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                <BarsArrowUpIcon class="-ml-0.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                                Sort
                                <ChevronDownIcon class="-mr-1 h-5 w-5 text-gray-400" aria-hidden="true" />
                            </button>

                            <transition name="dropdown" enter-active-class="transition ease-out duration-200"
                                        enter-from-class="transform scale-95 opacity-0"
                                        enter-to-class="transform scale-100 opacity-100"
                                        leave-active-class="transition ease-in duration-150"
                                        leave-from-class="transform scale-100 opacity-100"
                                        leave-to-class="transform scale-95 opacity-0">

                                <div v-show="showDropdown"
                                     class="dropdown-menu absolute right-0 top-full mt-1 rounded-md bg-white shadow-lg overflow-hidden transition ease-out duration-200 transform origin-top-right"
                                     :class="{ 'scale-100 opacity-100': showDropdown, 'scale-95 opacity-0': !showDropdown }">
                                    <ul class="text-gray-700">
                                        <li>
                                            <button class="block px-4 py-2 hover:bg-gray-100 w-full text-left text-sm" @click="sortBy('name_asc')">Name: A to Z</button>
                                        </li>
                                        <li>
                                            <button class="block px-4 py-2 hover:bg-gray-100 w-full text-left text-sm" @click="sortBy('name_desc')">Name: Z to A</button>
                                        </li>
                                    </ul>
                                </div>
                            </transition>
                        </div>
                    </div>

                    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex sm:flex-row-reverse">
                        <Link href="/admin/users/create">
                            <button type="button"
                                    class="inline-flex items-center gap-x-2 rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                <PlusIcon class="-ml-0.5 h-5 w-5" aria-hidden="true" />
                                Add user
                            </button>
                        </Link>
                    </div>
                </div>
                <div class="mt-8 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-100">
                                    <tr>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-sm font-semibold text-center text-gray-900">
                                            Name</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-sm font-semibold text-center text-gray-900">
                                            Email</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-sm font-semibold text-center text-gray-900">
                                            Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="user in users.data" :key="user.id"
                                        class="hover:bg-gray-100 focus-within:bg-gray-100">
                                        <td class="border-t">
                                            <Link class="flex justify-center items-center px-6 py-4"
                                                  :href="`/admin/users/${user.id}/edit`" tabindex="-1">
                                                {{ user.name }}
                                            </Link>
                                        </td>
                                        <td class="border-t">
                                            <Link
                                                class="flex justify-center items-center px-6 py-4 focus:text-blue-500"
                                                :href="`/admin/users/${user.id}/edit`">
                                                {{ user.email }}
                                            </Link>
                                        </td>

                                        <td class="border-t">
                                            <div class="flex justify-center space-x-4">

                                                <Link
                                                    class="inline-flex items-center gap-x-2 rounded-md bg-green-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600"
                                                    :href="`/admin/users/${user.id}/edit`" tabindex="-1">
                                                    <PencilSquareIcon class="-ml-0.5 h-5 w-5" aria-hidden="true" />
                                                </Link>

                                                <button type="button" @click="destroy(user.id)"
                                                        class="inline-flex items-center gap-x-2 rounded-md bg-red-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                                    <TrashIcon class="-ml-0.5 h-5 w-5" aria-hidden="true" />
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <div class="flex items-center border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                                    <div class="text-sm text-gray-700">
                                        Showing
                                        <span class="font-medium">{{ users.from }}</span>
                                        to
                                        <span class="font-medium">{{ users.to }}</span>
                                        of
                                        <span class="font-medium">{{ users.total }}</span>
                                        results
                                    </div>

                                    <div class="flex justify-end flex-grow">
                                        <nav class="inline-flex rounded-md shadow-sm" aria-label="Pagination">
                                            <a v-if="users.prev_page_url" :href="users.prev_page_url"
                                               class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                                <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a v-else
                                               class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-300">
                                                <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
                                                <span class="sr-only">Previous</span>
                                            </a>

                                            <template
                                                v-for="page in paginationRange(users.current_page, users.last_page)"
                                                :key="page">
                                                <a :href="`?page=${page}`" :class="{
                        'bg-blue-600 text-white border-blue-600': page === users.current_page,
                        'border-t border-b border-gray-300 text-gray-700 hover:bg-gray-50': page !== users.current_page,
                        'border-r': page !== users.last_page
                    }" class="relative inline-flex items-center px-4 py-2 text-sm font-medium">
                                                    {{ page }}
                                                </a>
                                            </template>

                                            <a v-if="users.next_page_url" :href="users.next_page_url"
                                               class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                                <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
                                                <span class="sr-only">Next</span>
                                            </a>
                                            <a v-else
                                               class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-300">
                                                <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </nav>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
