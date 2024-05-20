<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { HomeIcon, ChevronLeftIcon, ChevronRightIcon, PlusIcon } from '@heroicons/vue/20/solid';
import { ref, watch, onMounted, onBeforeUnmount } from 'vue';
import { BarsArrowUpIcon, ChevronDownIcon, MagnifyingGlassIcon, TrashIcon, PencilSquareIcon } from "@heroicons/vue/20/solid/index.js";
import AlertNotification from "@/Components/AlertNotification.vue";

const props = defineProps({
    payments: Object,
    flash: Object,
});

const pages = [
    { name: 'Admin', href: '/admin/dashboard', current: false },
    { name: 'Payments', href: '/admin/payments', current: true },
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
    fetchPayments(newValue);
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

function fetchPayments(query, order = orderBy.value) {
    router.get('/admin/payments', { search: query, order: order }, {
        preserveState: true,
        replace: true,
        preserveScroll: true,
    });
}

function sortBy(order) {
    orderBy.value = order;
    fetchPayments(searchQuery.value, order);
    showDropdown.value = false;
}

function destroy(paymentId) {
    if (confirm('Are you sure you want to delete this payment?')) {
        router.delete(`/admin/payments/${paymentId}`);
    }
}

const statusClasses = {
    pending: 'text-yellow-400 bg-yellow-400/10',
    paid: 'text-green-400 bg-green-400/10',
    failed: 'text-red-400 bg-red-400/10',
    refunded: 'text-blue-400 bg-blue-400/10'
};
</script>

<template>
    <AdminLayout title="Payments">
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
                                       placeholder="Search payments" />
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
                                            <button class="block px-4 py-2 hover:bg-gray-100 w-full text-left text-sm"
                                                    @click="sortBy('amount_asc')">Amount: Low to High</button>
                                        </li>
                                        <li>
                                            <button class="block px-4 py-2 hover:bg-gray-100 w-full text-left text-sm"
                                                    @click="sortBy('amount_desc')">Amount: High to Low</button>
                                        </li>
                                        <li>
                                            <button class="block px-4 py-2 hover:bg-gray-100 w-full text-left text-sm"
                                                    @click="sortBy('status_asc')">Status: A to Z</button>
                                        </li>
                                        <li>
                                            <button class="block px-4 py-2 hover:bg-gray-100 w-full text-left text-sm"
                                                    @click="sortBy('status_desc')">Status: Z to A</button>
                                        </li>
                                    </ul>
                                </div>
                            </transition>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-100">
                                    <tr>
                                        <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-center text-gray-900">Payment ID</th>
                                        <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-center text-gray-900">User</th>
                                        <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-center text-gray-900">Status</th>
                                        <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-center text-gray-900">Method</th>
                                        <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-center text-gray-900">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="payment in payments.data" :key="payment.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                        <td class="border-t px-6 py-4 text-center">
                                            {{ payment.id }}
                                        </td>
                                        <td class="border-t px-6 py-4 text-center">
                                            {{ payment.order.user.name }}
                                        </td>
                                        <td class="border-t px-6 py-4 text-center">
                                            <div class="flex items-center justify-center gap-x-2">
                                                <div :class="[statusClasses[payment.status], 'flex-none rounded-full p-1']">
                                                    <div class="h-1.5 w-1.5 rounded-full bg-current" />
                                                </div>
                                                <div class="text-gray-900">{{ payment.status }}</div>
                                            </div>
                                        </td>
                                        <td class="border-t px-6 py-4 text-center">
                                            {{ payment.method }}
                                        </td>
                                        <td class="border-t px-6 py-4 text-center">
                                            {{ payment.amount }} €
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <div class="flex items-center border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                                    <div class="text-sm text-gray-700">
                                        Showing
                                        <span class="font-medium">{{ payments.from }}</span>
                                        to
                                        <span class="font-medium">{{ payments.to }}</span>
                                        of
                                        <span class="font-medium">{{ payments.total }} </span>
                                        results
                                    </div>
                                    <div class="flex justify-end flex-grow">
                                        <nav class="inline-flex rounded-md shadow-sm" aria-label="Pagination">
                                            <a v-if="payments.prev_page_url" :href="payments.prev_page_url" class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                                <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a v-else class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-300">
                                                <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
                                                <span class="sr-only">Previous</span>
                                            </a>

                                            <template v-for="page in paginationRange(payments.current_page, payments.last_page)" :key="page">
                                                <a :href="`?page=${page}`" :class="{
                                                    'bg-blue-600 text-white border-blue-600': page === payments.current_page,
                                                    'border-t border-b border-gray-300 text-gray-700 hover:bg-gray-50': page !== payments.current_page,
                                                    'border-r': page !== payments.last_page
                                                }" class="relative inline-flex items-center px-4 py-2 text-sm font-medium">
                                                    {{ page }}
                                                </a>
                                            </template>

                                            <a v-if="payments.next_page_url" :href="payments.next_page_url" class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                                <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
                                                <span class="sr-only">Next</span>
                                            </a>
                                            <a v-else class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-300">
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
