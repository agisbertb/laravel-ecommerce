<template>
    <button @click="toggleWishlist" :class="buttonClass">
        <HeartIconSolid v-if="isInWishlist" class="h-6 w-6 text-red-500 flex-shrink-0" aria-hidden="true" />
        <HeartIconOutline v-else class="h-6 w-6 text-gray-500 flex-shrink-0" aria-hidden="true" />
    </button>
</template>

<script setup>
import {ref, computed, onMounted} from 'vue';
import axios from 'axios';
import {HeartIcon as HeartIconOutline} from '@heroicons/vue/24/outline';
import {HeartIcon as HeartIconSolid} from '@heroicons/vue/24/solid';

const props = defineProps({
    productId: Number,
});

const isInWishlist = ref(false);

const checkWishlist = async () => {
    const response = await axios.get(`/wishlist/check/${props.productId}`);
    isInWishlist.value = response.data.isInWishlist;
};

const toggleWishlist = async () => {
    const response = await axios.post('/wishlist/toggle', {product_id: props.productId});
    isInWishlist.value = response.data.status === 'added';
};

const buttonClass = computed(() => ({
    '': true, // Esta clase está vacía porque no necesitamos cambiar el fondo
}));

onMounted(checkWishlist);
</script>

