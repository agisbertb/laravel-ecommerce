<template>
    <AppLayout title="Payment Method">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Payment
            </h2>
        </template>
        <div class="container mx-auto py-12 px-4 flex flex-wrap justify-between">
            <!-- Payment Methods Section -->
            <div class="w-full md:w-2/3 lg:w-1/2 p-4">
                <h2 class="text-xl font-semibold mb-6">Payment Method</h2>

                <!-- Radio button for Credit Card option -->
                <div class="mb-4" v-for="method in paymentMethods" :key="method.id">
                    <input type="radio" :id="method.id" name="paymentMethod" :value="method.id" v-model="selectedPaymentMethod" class="form-radio h-5 w-5 text-blue-600">
                    <label :for="method.id" class="ml-2">
                        {{ method.name }}
                    </label>
                </div>

                <!-- Confirm Button -->
                <button class="mt-4 w-full bg-blue-600 text-white p-3 rounded hover:bg-blue-700">
                    Save and Continue
                </button>
            </div>

            <div v-if="form" v-html="form"></div>

            <!-- Order Summary Section -->
            <div class="w-full md:w-1/3 bg-white shadow rounded-lg p-6 sticky top-20">
                <h3 class="text-lg font-semibold mb-4">Order Summary</h3>
                <div class="mb-6">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal:</span>
                        <span class="font-bold">${{ cartTotal }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Shipping:</span>
                        <span>Free</span>
                    </div>
                    <div class="flex justify-between mt-4">
                        <span class="font-bold text-lg">Total:</span>
                        <span class="font-bold text-lg">${{ cartTotal }}</span>
                    </div>
                </div>
                <a href="/cart/payment" class="w-full px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Save and Continue
                </a>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, onMounted } from 'vue';
import axios from 'axios';
  
  const form = ref('');
  
  onMounted(async () => {
    try {
      const response = await axios.get('/redsys');
      form.value = response.data.form;
    } catch (error) {
      console.error('Error fetching Redsys form:', error);
    }
  });

const props = defineProps({
    cartTotal: Number,
    paymentMethods: Array
});


const selectedPaymentMethod = ref('');
</script>