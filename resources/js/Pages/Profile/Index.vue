<template>
    <AppLayout :siteSettings="siteSettings" title="My account">
        <div class="py-12 bg-white">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
                <!-- Sidebar -->
                <div class="flex flex-col overflow-y-auto border-r border-gray-200 bg-white pb-4 pt-5" style="width: 250px; min-height: calc(100vh - 3rem);">
                    <div class="flex flex-shrink-0 items-center px-4">
                        <h1 class="text-2xl mb-4 font-bold">My Account</h1>
                    </div>
                    <div class="mt-5 flex flex-grow flex-col">
                        <nav class="flex-1 space-y-1 bg-white px-2" aria-label="Sidebar">
                            <Link v-for="item in navigation" :key="item.name" :href="item.link" :class="[{ 'bg-gray-100 text-gray-900': isActive(item.link) }, 'group flex w-full items-center rounded-md py-2 pl-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900']">
                                <component :is="item.icon" :class="[isActive(item.link) ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500', 'mr-3 h-6 w-6 flex-shrink-0']" aria-hidden="true" />
                                {{ item.name }}
                            </Link>
                        </nav>
                    </div>
                </div>
                <!-- Content -->
                <div class="flex-grow p-6">
                    <ProfileData :user="user" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { UserIcon, HomeIcon, HeartIcon, ShoppingBagIcon } from '@heroicons/vue/24/outline';
import ProfileData from '@/Components/ProfileData.vue';

const props = defineProps({
    user: Object,
    siteSettings: Object,
});

const {url} = usePage();

const navigation = [
    {name: 'Profile Data', icon: UserIcon, link: '/profile'},
    {name: 'Addresses', icon: HomeIcon, link: '/profile/addresses'},
    {name: 'Wishlist', icon: HeartIcon, link: '/profile/wishlist'},
    {name: 'Orders', icon: ShoppingBagIcon, link: '/profile/orders'},
];

function isActive(link) {
    return url.startsWith(link);
}
</script>
