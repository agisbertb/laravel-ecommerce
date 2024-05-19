<script setup>
import { reactive, defineProps } from 'vue';
import { router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    address: Object,
    siteSettings: Object,
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

function update() {
    router.put(`/addresses/${props.address.id}`, form);
}
</script>

<template>
    <AppLayout :siteSettings="siteSettings" title="Edit Address">
        <section class="max-w-4xl mx-auto mt-10">
            <form @submit.prevent="update" class="space-y-6">
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
                        <span class="text-sm font-medium text-gray-700">Set as default</span>
                    </label>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">Update</button>
                </div>
            </form>
        </section>
    </AppLayout>
</template>
