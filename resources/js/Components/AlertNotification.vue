<template>
    <transition
        enter-active-class="transform ease-out duration-300 transition"
        enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
        leave-active-class="transition ease-in duration-100"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div
            v-if="visible"
            class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5 fixed top-0 right-0 m-8 z-50"
        >
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <component :is="icon" class="h-6 w-6" :class="iconColor" aria-hidden="true" />
                    </div>
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p class="text-sm font-medium text-gray-900">{{ title }}</p>
                        <p class="mt-1 text-sm text-gray-500">{{ message }}</p>
                    </div>
                    <div class="ml-4 flex flex-shrink-0">
                        <button
                            @click="close"
                            class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            <XMarkIcon class="h-5 w-5" aria-hidden="true" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script setup>
import { ref, watch, computed } from 'vue';
import { CheckCircleIcon, ExclamationCircleIcon, XMarkIcon } from '@heroicons/vue/24/outline';
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    title: String,
    message: String,
    visible: Boolean,
    type: {
        type: String,
        default: 'success', // 'success' o 'error'
    },
});

const emits = defineEmits(['update:visible']);

const icon = computed(() => (props.type === 'success' ? CheckCircleIcon : ExclamationCircleIcon));
const iconColor = computed(() => (props.type === 'success' ? 'text-green-400' : 'text-red-400'));

const visible = ref(props.visible);

const close = () => {
    emits('update:visible', false);
};

watch(
    () => props.visible,
    (newVal) => {
        visible.value = newVal;
        if (newVal) {
            setTimeout(() => {
                emits('update:visible', false);
            }, 3000);
        }
    },
    { immediate: true }
);
</script>
