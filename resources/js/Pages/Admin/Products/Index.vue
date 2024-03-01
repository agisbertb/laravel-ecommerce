<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/inertia-vue3'


const props = defineProps({
  products: Array,
});

</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        products
      </h2>
    </template>

    <div class="p-16 px-4 sm:px-6 lg:px-8">
      <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
          <h1 class="text-base font-semibold leading-6 text-gray-900">products</h1>
          <p class="mt-2 text-sm text-gray-700">bla bla bla</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
          <a href="/admin/products/create">
            <button type="button"
              class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add
              product</button>
          </a>
        </div>
      </div>
      <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col"
                      class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-center text-gray-900 sm:pl-6">Id</th>
                    <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-center text-gray-900">Name
                    </th>
                    <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-center text-gray-900">
                      Description</th>
                      <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-center text-gray-900">
                      Price</th>
                      <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-center text-gray-900">
                      Stock</th>
                      <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-center text-gray-900">
                      Image</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                  <tr v-for="product in products" :key="product.id" class="hover:bg-gray-100 focus-within:bg-gray-100">

                    <td class="border-t">
                      <Link class="flex justify-center items-center px-6 py-4 focus:text-indigo-500"
                        :href="`/admin/products/${product.id}/edit`">
                      {{ product.id }}
                      </Link>
                    </td>

                    <td class="border-t">
                      <Link class="flex justify-center items-center px-6 py-4 focus:text-indigo-500"
                        :href="`/admin/products/${product.id}/edit`">
                      {{ product.name }}
                      </Link>
                    </td>
                    <td class="border-t">
                      <Link class="flex justify-center items-center px-6 py-4" :href="`/admin/products/${product.id}/edit`"
                        tabindex="-1">
                      {{ product.description }}
                      </Link>
                    </td>
                    <td class="border-t">
                      <Link class="flex justify-center items-center px-6 py-4" :href="`/admin/products/${product.id}/edit`"
                        tabindex="-1">
                      {{ product.price }}
                      </Link>
                    </td>
                    <td class="border-t">
                      <Link class="flex justify-center items-center px-6 py-4" :href="`/admin/products/${product.id}/edit`"
                        tabindex="-1">
                      {{ product.stock }}
                      </Link>
                    </td>
                    <td class="border-t">
                      <Link class="flex justify-center items-center px-6 py-4" :href="`/admin/products/${product.id}/edit`"
                        tabindex="-1">
                      {{ product.image }}
                      </Link>
                    </td>
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