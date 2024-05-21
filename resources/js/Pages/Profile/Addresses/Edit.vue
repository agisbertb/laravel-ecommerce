<template>
    <MyAccountLayout>
        <div>
            <h2 class="text-xl font-semibold mb-4">Edit Address</h2>
            <form @submit.prevent="submit" class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" v-model="form.name" required
                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" id="address" v-model="form.address" required
                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                    <input type="text" id="city" v-model="form.city" required
                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="state" class="block text-sm font-medium text-gray-700">State</label>
                    <input type="text" id="state" v-model="form.state" required
                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                    <input type="text" id="country" v-model="form.country" required
                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="zip_code" class="block text-sm font-medium text-gray-700">Zip Code</label>
                    <input type="text" id="zip_code" v-model="form.zip_code" required
                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="default" class="flex items-center space-x-2">
                        <input type="checkbox" id="default" v-model="form.default"
                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <span class="text-sm font-medium text-gray-700">Set as default address</span>
                    </label>
                </div>

                <div class="flex justify-end">
                    <PrimaryButton type="submit">
                        Update
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </MyAccountLayout>
</template>

<script setup>
import { reactive, defineProps } from 'vue';
import { router } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import MyAccountLayout from '@/Layouts/MyAccountLayout.vue';

const props = defineProps({
    address: Object,
});

const form = reactive({
    id: props.address.id,
    name: props.address.name,
    type: props.address.type,
    address: props.address.address,
    city: props.address.city,
    state: props.address.state,
    country: props.address.country,
    zip_code: props.address.zip_code,
    default: !!props.address.default,
});

function submit() {
    router.put(`/profile/addresses/${form.id}`, form, {
        onSuccess: () => {
            router.visit('/profile/addresses');
        }
    });
}
</script>
