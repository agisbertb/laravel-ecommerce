<script setup>
import { ref, computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
  cartDetails: Array,
    cartTotal: Number

});

const cartDetails = ref(props.cartDetails);

const cartTotal = computed(() => {
    return cartDetails.value.reduce((acc, detail) => acc + (detail.price * detail.quantity), 0);
});

const updateQuantity = (detailIndex, newQuantity) => {
  const detail = props.cartDetails[detailIndex];
  if (newQuantity > 0) {
    detail.quantity = newQuantity;
    Inertia.patch(`/cart/update/${detail.id}`, { quantity: newQuantity }, {
      preserveState: false
    });
  }
};

const removeFromCart = (detailIndex) => {
  const detail = props.cartDetails[detailIndex];
  Inertia.delete(`/cart/remove/${detail.id}`, {
    preserveState: true,
    onSuccess: () => {
      props.cartDetails.splice(detailIndex, 1);
    }
  });
};

</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        CART
      </h2>
    </template>

    <div class="py-6">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">My Cart</h1>
        <div class="bg-white shadow overflow-hidden sm:rounded-md">
          <ul class="divide-y divide-gray-200">
            <li v-for="(detail, index) in cartDetails" :key="detail.id" class="px-4 py-4 flex justify-between sm:px-6">
              <div>
                <div class="text-sm font-medium text-indigo-600">
                  {{ detail.product.name }}
                </div>
                <div class="mt-2">
                  <p class="text-sm text-gray-500">
                    ${{ detail.price }} each
                  </p>
                </div>
              </div>
              <div class="flex items-center">
                <button @click="updateQuantity(index, detail.quantity - 1)" v-if="detail.quantity > 1"
                        class="px-2 py-1 mr-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded">
                  -
                </button>
                <span>{{ detail.quantity }}</span>
                <button @click="updateQuantity(index, detail.quantity + 1)"
                        v-if="detail.quantity < detail.product.stock"
                        class="px-2 py-1 ml-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded">
                  +
                </button>
                <span class="ml-4">
                  Subtotal: ${{ detail.quantity * detail.price }}
                </span>
              </div>
              <button @click="removeFromCart(index)"
                      class="ml-4 px-2 py-1 text-sm font-semibold text-red-700 bg-red-200 rounded">
                Remove
              </button>
            </li>
          </ul>
            <div class="px-4 py-4 sm:px-6">
                <div class="flex justify-between">
                    <span>Total:</span>
                    <span class="font-bold">${{ cartTotal }}</span>
                </div>
                <div class="flex justify-end mt-4">
                    <a href="/cart/address" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Checkout
                    </a>
                </div>
            </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

