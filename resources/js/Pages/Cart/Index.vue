<template>
    <CartLayout title="Shopping Cart" :siteSettings="siteSettings">
        <div class="bg-white">
            <div class="mx-auto max-w-2xl px-4 pb-24 pt-16 sm:px-6 lg:max-w-7xl lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Shopping Cart</h1>

                <!-- Check if cart is empty -->
                <div v-if="cartDetails.length === 0" class="text-center mt-12">
                    <ExclamationCircleIcon class="h-16 w-16 mx-auto text-gray-400" aria-hidden="true" />
                    <h2 class="text-xl font-medium text-gray-900 mt-4">Your cart is empty</h2>
                    <p class="mt-2 text-sm text-gray-500">Explore a variety of items at great prices from our homepage.</p>
                    <a href="/" class="mt-6 px-6 py-3 bg-blue-600 text-white text-center font-medium rounded hover:bg-blue-700 inline-block">
                        Explore items
                    </a>
                </div>

                <!-- If cart is not empty, show the cart details -->
                <div v-else>
                    <form class="mt-12 lg:grid lg:grid-cols-12 lg:items-start lg:gap-x-12 xl:gap-x-16">
                        <section aria-labelledby="cart-heading" class="lg:col-span-7">
                            <h2 id="cart-heading" class="sr-only">Items in your shopping cart</h2>
                            <ul role="list" class="divide-y divide-gray-200 border-b border-t border-gray-200">
                                <li v-for="(detail, index) in cartDetails" :key="detail.id" class="flex py-6 sm:py-10">
                                    <div class="flex-shrink-0">
                                        <img :src="detail.product.image_url" :alt="detail.product.name" class="h-24 w-24 rounded-md object-cover object-center sm:h-48 sm:w-48" />
                                    </div>
                                    <div class="ml-4 flex flex-1 flex-col justify-between sm:ml-6">
                                        <div class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                                            <div>
                                                <div class="flex justify-between">
                                                    <h3 class="text-sm">
                                                        <a :href="`/products/${detail.product.id}`" class="font-medium text-gray-700 hover:text-gray-800">{{ detail.product.name }}</a>
                                                    </h3>
                                                </div>
                                                <p class="mt-1 text-sm font-medium text-gray-900">{{ detail.price }}€</p>
                                            </div>
                                            <div class="mt-4 sm:mt-0 sm:pr-9">
                                                <label :for="`quantity-${index}`" class="sr-only">Quantity, {{ detail.product.name }}</label>
                                                <select :id="`quantity-${index}`" :name="`quantity-${index}`" class="max-w-full rounded-md border border-gray-300 py-1.5 text-left text-base font-medium leading-5 text-gray-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 sm:text-sm" v-model="detail.quantity" @change="updateQuantity(index, detail.quantity)">
                                                    <option v-for="n in detail.product.stock" :key="n" :value="n">{{ n }}</option>
                                                </select>
                                                <div class="absolute right-0 top-0">
                                                    <button type="button" class="-m-2 inline-flex p-2 text-gray-400 hover:text-gray-500" @click="removeFromCart(index)">
                                                        <span class="sr-only">Remove</span>
                                                        <XMarkIcon class="h-5 w-5" aria-hidden="true" />
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mt-4 flex space-x-2 text-sm text-gray-700">
                                            <CheckIcon v-if="detail.product.stock > 0" class="h-5 w-5 flex-shrink-0 text-green-500" aria-hidden="true" />
                                            <ClockIcon v-else class="h-5 w-5 flex-shrink-0 text-gray-300" aria-hidden="true" />
                                            <span>{{ detail.product.stock > 0 ? 'In stock' : 'Out of stock' }}</span>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </section>

                        <!-- Order summary -->
                        <section aria-labelledby="summary-heading" class="mt-16 rounded-lg bg-gray-50 px-4 py-6 sm:p-6 lg:col-span-5 lg:mt-0 lg:p-8">
                            <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Order summary</h2>
                            <dl class="mt-6 space-y-4">
                                <div class="flex items-center justify-between">
                                    <dt class="text-sm text-gray-600">Subtotal</dt>
                                    <dd class="text-sm font-medium text-gray-900">{{ cartTotal }}€</dd>
                                </div>
                                <!-- Add shipping and tax if needed -->
                                <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                                    <dt class="text-base font-medium text-gray-900">Order total</dt>
                                    <dd class="text-base font-medium text-gray-900">{{ cartTotal }}€</dd>
                                </div>
                            </dl>
                            <div class="mt-6 flex justify-center">
                                <a href="/cart/address" class="w-full max-w-xs px-6 py-3 bg-blue-600 text-white text-center font-medium rounded hover:bg-blue-700">
                                    Save and Continue
                                </a>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </CartLayout>
</template>

<script setup>
import {ref, computed} from 'vue';
import {router} from '@inertiajs/vue3';
import {CheckIcon, ClockIcon, XMarkIcon, ExclamationCircleIcon} from '@heroicons/vue/20/solid';
import CartLayout from '@/Layouts/CartLayout.vue';

const props = defineProps({
    cartDetails: Array,
    cartTotal: Number,
    siteSettings: Object,
});

const cartDetails = ref(props.cartDetails);

const cartTotal = computed(() => {
    return cartDetails.value.reduce((acc, detail) => acc + (detail.price * detail.quantity), 0);
});

const updateQuantity = (detailIndex, newQuantity) => {
    const detail = cartDetails.value[detailIndex];
    if (newQuantity > 0) {
        detail.quantity = newQuantity;
        router.patch(`/cart/update/${detail.id}`, {quantity: newQuantity}, {
            preserveState: false
        });
    }
};

const removeFromCart = (detailIndex) => {
    const detail = cartDetails.value[detailIndex];
    router.delete(`/cart/remove/${detail.id}`, {
        preserveState: true,
        onSuccess: () => {
            cartDetails.value.splice(detailIndex, 1);
        }
    });
};
</script>
