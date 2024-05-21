<template>
    <MyAccountLayout :siteSettings="siteSettings">
        <div class="py-12 bg-white">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <ProfileOrders :orders="orders" />
                    </div>
                </div>
            </div>
        </div>
    </MyAccountLayout>
</template>

<script setup>
import { defineProps } from 'vue';
import MyAccountLayout from "@/Layouts/MyAccountLayout.vue";
import ProfileOrders from '@/Components/ProfileOrders.vue';

const props = defineProps({
    orders: Array,
    siteSettings: Object,
});
</script>
