<template>
    <div class="bg-white">
        <header class="relative bg-white">
            <p class="flex h-10 items-center justify-center bg-indigo-600 px-4 text-sm font-bold text-white sm:px-6 lg:px-8">
                Get free delivery on orders over $100
            </p>

            <nav aria-label="Top" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="border-b border-gray-200">
                    <div class="flex items-center h-24">
                        <!-- Botón para menú móvil -->
                        <button type="button" class="relative rounded-md bg-white p-2 text-gray-400 lg:hidden" @click="open = true">
                            <span class="absolute -inset-0.5" />
                            <span class="sr-only">Open menu</span>
                            <Bars3Icon class="h-6 w-6" aria-hidden="true" />
                        </button>

                        <!-- Logo -->
                        <div class="ml-4 flex lg:ml-0">
                            <a href="/">
                                <span class="sr-only">{{ siteSettings.site_name }}</span>
                                <div class="flex items-center">
                                    <img v-if="logoUrl" :src="logoUrl" class="h-auto max-h-16 w-auto" alt="Site Logo" />
                                    <span v-else>TODO</span>
                                </div>
                            </a>
                        </div>

                        <!-- Buscador -->
                        <SearchBar />

                        <!-- Iconos de wishlist, carrito y login -->
                        <div class="ml-auto flex items-center">
                            <!-- Wishlist -->
                            <div class="flex lg:ml-6">
                                <NavLink :href="route('profile.wishlist')" class="group -m-2 p-2 flex items-center">
                                    <HeartIcon class="h-8 w-8 text-gray-500 group-hover:text-gray-600" aria-hidden="true" />
                                    <span class="sr-only">Wishlist</span>
                                </NavLink>
                            </div>

                            <!-- Cart -->
                            <div class="ml-4 flow-root lg:ml-6">
                                <NavLink :href="route('cart.index')" class="group flex items-center p-2">
                                    <ShoppingBagIcon class="h-8 w-8 flex-shrink-0 text-gray-500 group-hover:text-gray-600" aria-hidden="true" />
                                    <span class="ml-2 text-sm font-bold text-gray-700 group-hover:text-gray-800">{{ cartCount }}</span>
                                    <span class="sr-only">items in cart, view bag</span>
                                </NavLink>
                            </div>

                            <!-- Login/Register -->
                            <template v-if="!$page.props.auth.user">
                                <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6 ml-4 flow-root lg:ml-6">
                                    <NavLink :href="route('login')" class="text-sm font-bold text-gray-500 hover:text-gray-600">Login</NavLink>
                                    <span class="h-6 w-px bg-gray-200" aria-hidden="true" />
                                    <NavLink :href="route('register')" class="text-sm font-bold text-gray-500 hover:text-gray-600">Register</NavLink>
                                </div>
                            </template>

                            <!-- Settings Dropdown -->
                            <div v-else class="ms-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-bold rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            <UserCircleIcon class="h-8 w-8 flex-shrink-0 text-gray-500 group-hover:text-gray-600" aria-hidden="true" />
                                        </button>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Manage Account
                                        </div>

                                        <DropdownLink :href="route('profile.index')">
                                            Profile
                                        </DropdownLink>

                                        <div class="border-t border-gray-200" />

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <DropdownLink as="button">
                                                Log Out
                                            </DropdownLink>
                                        </form>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Nuevo bloque de navegación -->
            <nav aria-label="Secondary" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="border-b border-gray-200">
                    <div class="flex items-center h-12">
                        <div class="ml-4 flex lg:ml-0">
                            <Link :href="route('categories.index')" class="text-lg font-bold text-gray-500 hover:text-gray-600">All Categories</Link>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
    </div>

    <main>
        <slot />
    </main>

    <FooterSection :siteSettings="siteSettings"/>
</template>

<script setup>
import { ref, computed } from 'vue';
import {
    Bars3Icon,
    HeartIcon,
    ShoppingBagIcon,
    UserCircleIcon,
} from '@heroicons/vue/24/outline';
import NavLink from "@/Components/NavLink.vue";
import { router, Link } from "@inertiajs/vue3";
import DropdownLink from "@/Components/DropdownLink.vue";
import Dropdown from '@/Components/Dropdown.vue';
import FooterSection from '@/Components/FooterSection.vue';
import SearchBar from '@/Components/SearchBar.vue';

const open = ref(false);

const props = defineProps({
    title: String,
    siteSettings: {
        type: Object,
        default: () => ({site_logo: '', footer_logo: '', footer_text: ''}),
    },
});

const showingNavigationDropdown = ref(false);

const logout = () => {
    router.post(route('logout'));
};

import useCart from '@/Composables/useCart';

const {cartCount} = useCart();

const logoUrl = computed(() => {
    return props.siteSettings.site_logo ? `/${props.siteSettings.site_logo}` : '';
});
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.3s;
}

.fade-enter-from, .fade-leave-to {
    opacity: 0;
}
</style>
