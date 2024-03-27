<script setup>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
  type: String,
});

const addressType = ref(props.type || '');
const name = ref('');
const address = ref('');
const city = ref('');
const state = ref('');
const country = ref('');
const zipCode = ref('');
const isDefault = ref(false);

const submit = () => {
  Inertia.post('/addresses', {
    type: addressType.value,
    name: name.value,
    address: address.value,
    city: city.value,
    state: state.value,
    country: country.value,
    zip_code: zipCode.value,
    default: isDefault.value,
  });
};


</script>

<template>
  <AppLayout title="Add New Address">
    <section class="max-w-4xl mx-auto mt-10">
      <form @submit.prevent="submit" class="space-y-6">

        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
          <input type="text" id="name" v-model="name" required
            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
          <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
          <input type="text" id="address" v-model="address" required
            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
          <label for="city" class="block text-sm font-medium text-gray-700">City</label>
          <input type="text" id="city" v-model="city" required
            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
          <label for="state" class="block text-sm font-medium text-gray-700">State</label>
          <input type="text" id="state" v-model="state" required
            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
          <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
          <input type="text" id="country" v-model="country" required
            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
          <label for="zip_code" class="block text-sm font-medium text-gray-700">Zip Code</label>
          <input type="text" id="zip_code" v-model="zipCode" required
            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
          <label for="default" class="flex items-center space-x-2">
            <input type="checkbox" id="default" v-model="isDefault"
              class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <span class="text-sm font-medium text-gray-700">Set as default address</span>
          </label>
        </div>


        <div class="flex justify-end">
          <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">Create</button>
        </div>
      </form>
    </section>
  </AppLayout>
</template>
