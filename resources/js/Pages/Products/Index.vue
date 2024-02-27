<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Products
            </h2>
        </template>

        <div class="p-16 px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900">Products</h1>
        <p class="mt-2 text-sm text-gray-700">bla bla bla</p>
      </div>
      <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <button type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add user</button>
      </div>
    </div>
    <div class="mt-8 flow-root">
      <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-center text-gray-900 sm:pl-6">Id</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-center text-gray-900">Name</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-center text-gray-900">Description</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-center text-gray-900">Price</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-center text-gray-900">Stock</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-center text-gray-900">Image</th>
                  
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-for="product in products" :key="product.id">
                  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-center text-sm font-medium text-gray-900 sm:pl-6">{{ product.id }}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-center text-sm text-gray-500">{{ product.name }}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-center text-sm text-gray-500">{{ product.description }}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-center text-sm text-gray-500">{{ product.price }}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-center text-sm text-gray-500">{{ product.stock }}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-center text-sm text-gray-500">{{ product.image }}</td>
                                    
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


    </AppLayout>
</template>
  
<script>
export default {
    props: {
        products: Array,
    },
}
</script>