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
                            <template v-for="item in navigation" :key="item.name">
                                <div v-if="!item.children">
                                    <a @click.prevent="currentSection = item.name" :class="[currentSection === item.name ? 'bg-gray-100 text-gray-900' : 'bg-white text-gray-600 hover:bg-gray-50 hover:text-gray-900', 'group flex w-full items-center rounded-md py-2 pl-2 text-sm font-medium']" href="#">
                                        <component :is="item.icon" :class="[currentSection === item.name ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500', 'mr-3 h-6 w-6 flex-shrink-0']" aria-hidden="true" />
                                        {{ item.name }}
                                    </a>
                                </div>
                            </template>
                        </nav>
                    </div>
                </div>

                <!-- Content -->
                <div class="flex-grow p-6">
                    <div v-if="currentSection === 'Profile Data'">
                        <div>
                            <h2 class="text-xl font-semibold mb-4">Profile Data</h2>
                            <UpdateProfileInformationForm :user="user" />
                            <SectionBorder />
                            <UpdatePasswordForm />
                            <SectionBorder />
                            <TwoFactorAuthenticationForm />
                            <SectionBorder />
                            <DeleteAccountSection />

                        </div>
                    </div>
                    <div v-else-if="currentSection === 'Addresses'">
                        <div class="space-y-12">
                            <section class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
                                <div>
                                    <h2 class="text-base font-semibold leading-7 text-gray-900">Shipping Addresses</h2>
                                </div>

                                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                                    <div v-for="address in addresses.filter(address => address.type === 'Shipping')" :key="address.id" class="col-span-full bg-white shadow rounded-lg p-4 mb-6">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <p class="font-semibold text-gray-900">
                                                    {{ address.name }} <span v-if="address.default" class="text-green-500">(Default)</span>
                                                </p>
                                                <p class="text-gray-600">{{ address.address }}</p>
                                                <p class="text-gray-600">{{ address.city }}, {{ address.state }}, {{ address.country }} {{ address.zip_code }}</p>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 p-4 mt-4 flex flex-col sm:flex-row justify-end items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-2 mt-3">
                                            <Link :href="`/profile/addresses/${address.id}/edit`" class="w-full sm:w-auto">
                                                <PrimaryButton class="w-full sm:w-auto">
                                                    Edit
                                                </PrimaryButton>
                                            </Link>
                                            <DangerButton
                                                class="w-full sm:w-auto"
                                                :disabled="false"
                                                @click="deleteAddress(address.id)"
                                            >
                                                Delete
                                            </DangerButton>
                                        </div>
                                    </div>
                                    <div class="col-span-full flex justify-center">
                                        <AddButton @click="navigateToCreateAddress('Shipping')">
                                            Add new Shipping address
                                        </AddButton>
                                    </div>
                                </div>
                            </section>

                            <section class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
                                <div>
                                    <h2 class="text-base font-semibold leading-7 text-gray-900">Billing Addresses</h2>
                                </div>

                                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                                    <div v-for="address in addresses.filter(address => address.type === 'Billing')" :key="address.id" class="col-span-full bg-white shadow rounded-lg p-4 mb-6">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <p class="font-semibold text-gray-900">
                                                    {{ address.name }} <span v-if="address.default" class="text-green-500">(Default)</span>
                                                </p>
                                                <p class="text-gray-600">{{ address.address }}</p>
                                                <p class="text-gray-600">{{ address.city }}, {{ address.state }}, {{ address.country }} {{ address.zip_code }}</p>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 p-4 mt-4 flex flex-col sm:flex-row justify-end items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-2 mt-3">
                                            <Link :href="`/profile/addresses/${address.id}/edit`" class="w-full sm:w-auto">
                                                <PrimaryButton class="w-full sm:w-auto">
                                                    Edit
                                                </PrimaryButton>
                                            </Link>
                                            <DangerButton
                                                class="w-full sm:w-auto"
                                                :disabled="false"
                                                @click="deleteAddress(address.id)"
                                            >
                                                Delete
                                            </DangerButton>
                                        </div>
                                    </div>
                                    <div class="col-span-full flex justify-center">
                                        <AddButton @click="navigateToCreateAddress('Billing')">
                                            Add new Billing address
                                        </AddButton>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div v-else-if="currentSection === 'Create Address'">
                        <div>
                            <h2 class="text-xl font-semibold mb-4">Add New Address</h2>
                            <form @submit.prevent="submitCreateAddress" class="space-y-6">
                                <!-- Form fields -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                    <input type="text" id="name" v-model="createForm.name" required
                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                    <input type="text" id="address" v-model="createForm.address" required
                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                    <input type="text" id="city" v-model="createForm.city" required
                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="state" class="block text-sm font-medium text-gray-700">State</label>
                                    <input type="text" id="state" v-model="createForm.state" required
                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                                    <input type="text" id="country" v-model="createForm.country" required
                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="zip_code" class="block text-sm font-medium text-gray-700">Zip Code</label>
                                    <input type="text" id="zip_code" v-model="createForm.zip_code" required
                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="default" class="flex items-center space-x-2">
                                        <input type="checkbox" id="default" v-model="createForm.default"
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <span class="text-sm font-medium text-gray-700">Set as default address</span>
                                    </label>
                                </div>
                                <div class="flex justify-end">
                                    <PrimaryButton type="submit">
                                        Create
                                    </PrimaryButton>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div v-else-if="currentSection === 'Wishlist'">
                        <!-- Implement your wishlist component later -->
                    </div>
                    <div v-else-if="currentSection === 'Orders'">
                        <ProfileOrders :orders="orders" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {ref, defineProps, reactive} from 'vue';
import {router, Link} from '@inertiajs/vue3';
import {
    UserIcon,
    HomeIcon,
    HeartIcon,
    ShoppingBagIcon, ShieldCheckIcon
} from '@heroicons/vue/24/outline';
import UpdateProfileInformationForm from '@/Components/UpdateProfileInformationForm.vue';
import UpdatePasswordForm from '@/Components/UpdatePasswordForm.vue';
import DeleteAccountSection from '@/Components/DeleteAccountSection.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import ProfileOrders from '@/Components/ProfileOrders.vue';
import TwoFactorAuthenticationForm from "@/Components/TwoFactorAuthenticationForm.vue";
import AddButton from "@/Components/AddButton.vue";

const props = defineProps({
    user: Object,
    addresses: Array,
    orders: Array,
    siteSettings: Object,

});

const currentSection = ref('Profile Data');
const addressType = ref(null);
const createForm = reactive({
    type: '',
    name: '',
    address: '',
    city: '',
    state: '',
    country: '',
    zip_code: '',
    default: false,
});

const navigation = [
    {name: 'Profile Data', icon: UserIcon, current: true},
    {
        name: 'Addresses',
        icon: HomeIcon,
        current: false,
    },
    {
        name: 'Wishlist',
        icon: HeartIcon,
        current: false,
    },
    {
        name: 'Orders',
        icon: ShoppingBagIcon,
        current: false,
    },
];

function navigateToCreateAddress(type) {
    currentSection.value = 'Create Address';
    addressType.value = type;
    createForm.type = type;
}

function deleteAddress(id) {
    router.delete(`/profile/addresses/${id}`, {
        onSuccess: () => {
            currentSection.value = 'Addresses';
            fetchAddresses();
        },
    });
}

function fetchAddresses() {
    router.get('/profile/addresses', {}, {
        preserveState: true,
        replace: true,
        onSuccess: (page) => {
            props.addresses = page.props.addresses;
        },
    });
}

function submitCreateAddress() {
    router.post('/profile/addresses', createForm, {
        onSuccess: () => {
            currentSection.value = 'Addresses';
            fetchAddresses();
        }
    });
}
</script>
