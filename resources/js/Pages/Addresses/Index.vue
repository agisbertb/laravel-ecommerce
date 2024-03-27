<script setup>
import { Inertia } from '@inertiajs/inertia';
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';

const props = defineProps({
  addresses: Object,
});

const handleAction = (url, method = 'get') => {
  Inertia[method](url, {}, {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => {
      if (method !== 'get') {
        Inertia.reload({ only: ['addresses'], preserveState: true });
      }
    }
  });
};

const destroy = (id) => {
  if (confirm('Are you sure you want to delete this address?')) {
    Inertia.delete(`/addresses/${id}`, {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        Inertia.reload({ only: ['addresses'] });
      }
    });
  }
};
</script>

<template>
  <AppLayout title="Mis direcciones">
    <template #header>
      <h2 class="text-center font-semibold text-2xl text-gray-800 leading-tight my-8">
        My Addresses
      </h2>
    </template>

    <section class="max-w-4xl mx-auto mt-10">
      <div class="mb-10">
        <h4 class="text-lg font-semibold mb-4 text-center">Shipping Addresses</h4>
        <div v-for="address in addresses.filter(address => address.type === 'Shipping')" :key="address.id"
          class="bg-white shadow rounded-lg p-4 mb-6">
          <div class="text-center">
            <p class="font-semibold">
              {{ address.name }} <span v-if="address.default" class="text-green-500">(Default)</span>
            </p>
            <p>{{ address.address }}</p>
            <p>{{ address.city }}, {{ address.state }}, {{ address.country }} {{ address.zip_code }}</p>
            <div class="flex justify-center space-x-2 mt-3">
              <button @click="handleAction(`/addresses/${address.id}/edit`)"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">Edit</button>
              <button @click="destroy(address.id)" class="text-red-600 hover:underline" tabindex="-1"
                type="button">Delete</button>
            </div>
          </div>
        </div>
        <div class="flex justify-center">
          <button @click="handleAction('/addresses/create/Shipping')"
            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700 transition-colors">Add new shipping
            address</button>
        </div>
      </div>
    </section>

    <section class="max-w-4xl mx-auto">
      <div class="mb-10">
        <h4 class="text-lg font-semibold mb-4 text-center">Billing addresses</h4>
        <div v-for="address in addresses.filter(address => address.type === 'Billing')" :key="address.id"
          class="bg-white shadow rounded-lg p-4 mb-6">
          <div class="text-center">
            <p class="font-semibold">
              {{ address.name }} <span v-if="address.default" class="text-green-500">(Default)</span>
            </p>
            <p>{{ address.address }}</p>
            <p>{{ address.city }}, {{ address.state }}, {{ address.country }} {{ address.zip_code }}</p>
            <div class="flex justify-center space-x-2 mt-3">
              <button @click="handleAction(`/addresses/${address.id}/edit`)"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">Edit</button>
              <button @click="destroy(address.id)" class="text-red-600 hover:underline" tabindex="-1"
                type="button">Delete</button>
            </div>
          </div>
        </div>
        <div class="flex justify-center">
          <button @click="handleAction('/addresses/create/Billing')"
            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700 transition-colors">Add new billing
            address</button>
        </div>
      </div>
    </section>
  </AppLayout>
</template>
