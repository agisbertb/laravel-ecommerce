<template>
    <ProfileLayout>
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
                        <Link :href="`/profile/addresses/create/Shipping`">
                            <AddButton>
                                Add new Shipping address
                            </AddButton>
                        </Link>
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
                                @click="delete ress(address.id)"
                            >
                                Delete
                            </DangerButton>
                        </div>
                    </div>
                    <div class="col-span-full flex justify-center">
                        <Link :href="`/profile/addresses/create/Billing`">
                            <AddButton>
                                Add new Billing address
                            </AddButton>
                        </Link>
                    </div>
                </div>
            </section>
        </div>
    </ProfileLayout>
</template>

<script setup>
import { defineProps } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import DangerButton from "@/Components/DangerButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ProfileLayout from '@/Layouts/ProfileLayout.vue';
import AddButton from "@/Components/AddButton.vue";

const props = defineProps({
    addresses: Array,
});

function deleteAddress(id) {
    if (confirm('Are you sure you want to delete this address?')) {
        router.delete(`/profile/addresses/${id}`, {
            onSuccess: () => {
                router.visit('/profile/addresses');
            }
        });
    }
}
</script>
