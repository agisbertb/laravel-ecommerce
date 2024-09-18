<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'inline-flex items-center border-b-2 border-blue-400 text-sm font-bold leading-5 text-gray-900 focus:outline-none focus:border-blue-700 transition duration-150 ease-in-out'
        : 'inline-flex items-center border-b-2 border-transparent text-sm font-bold leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
