<script setup>
import { reactive, defineProps } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue';
import TextInput from '@/Components/TextInput.vue'

const props = defineProps({
    shippingOption: Object,
});

const form = reactive({
    name: props.shippingOption.name,
    price: props.shippingOption.price,
    estimated_delivery: props.shippingOption.estimated_delivery,
});

function update() {
    router.put(`/admin/shipping-options/${props.shippingOption.id}`, form);
}

const destroy = () => {
    if (confirm('Are you sure you want to delete this shipping option?')) {
        router.delete(`/admin/shipping-options/${props.shippingOption.id}`);
    }
};
</script>

<template>
    <AdminLayout title="Edit Shipping Option">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Shipping Option
            </h2>
        </template>
        <div class="flex justify-center items-center h-screen">
            <div>
                <Head title="Update Shipping Option"/>
                <h1 class="mb-8 text-3xl font-bold">
                    <Link :href="route('admin.shipping-options.index')" class="text-indigo-400 hover:text-indigo-600">
                        Shipping Options
                    </Link>
                    <span class="text-indigo-400 font-medium">/</span> Update
                </h1>
                <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
                    <form @submit.prevent="update">
                        <div class="flex flex-wrap -mb-4 -mr-3 p-4">
                            <TextInput v-model="form.name" class="pb-4 pr-3 w-full lg:w-1/2" label="Name"/>
                            <TextInput v-model="form.price" type="number" class="pb-4 pr-3 w-full lg:w-1/2"
                                       label="Price"/>
                            <TextInput v-model="form.estimated_delivery" class="pb-4 pr-3 w-full lg:w-1/2"
                                       label="Estimated Delivery"/>
                        </div>
                        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                            <button class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">
                                Delete Shipping Option
                            </button>
                            <button class="btn-indigo" type="submit">Update Shipping Option</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
