<template>
    <div class="flex flex-col min-h-screen bg-white">
        <header class="relative bg-white">
            <div class="border-b border-gray-200">
                <nav aria-label="Top" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center py-4">
                        <!-- Logo -->
                        <div class="ml-4 flex lg:ml-0">
                            <a href="/">
                                <span class="sr-only">{{ siteSettings.site_name }}</span>
                                <div class="flex items-center">
                                    <img v-if="logoUrl" :src="logoUrl" class="h-auto max-h-16 w-auto" alt="Site Logo" />
                                    <span v-else>LOGO HERE</span>
                                </div>
                            </a>
                        </div>
                        <!-- Steps Navigation -->
                        <nav aria-label="Progress" class="ml-10 hidden w-full md:flex">
                            <ol role="list" class="flex w-full space-x-4 md:space-x-8">
                                <li v-for="(step, stepIdx) in steps" :key="step.name" class="relative flex-1">
                                    <template v-if="step.status === 'complete'">
                                        <a :href="step.href" class="group flex items-center">
                                            <span class="flex items-center px-4 py-2 text-sm font-medium">
                                                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-600 group-hover:bg-blue-800">
                                                    <CheckIcon class="h-4 w-4 text-white" aria-hidden="true" />
                                                </span>
                                                <span class="ml-4 text-sm font-medium text-gray-900">{{ step.name }}</span>
                                            </span>
                                        </a>
                                    </template>
                                    <template v-else-if="step.status === 'current'">
                                        <a :href="step.href" class="flex items-center px-4 py-2 text-sm font-medium" aria-current="step">
                                            <span class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-blue-600">
                                                <span class="text-blue-600">{{ step.id }}</span>
                                            </span>
                                            <span class="ml-4 text-sm font-medium text-blue-600">{{ step.name }}</span>
                                        </a>
                                    </template>
                                    <template v-else>
                                        <span class="group flex items-center cursor-not-allowed">
                                            <span class="flex items-center px-4 py-2 text-sm font-medium">
                                                <span class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-gray-300">
                                                    <span class="text-gray-500">{{ step.id }}</span>
                                                </span>
                                                <span class="ml-4 text-sm font-medium text-gray-500">{{ step.name }}</span>
                                            </span>
                                        </span>
                                    </template>
                                    <template v-if="stepIdx !== steps.length - 1">
                                        <!-- Arrow separator for lg screens and up -->
                                        <div class="absolute right-0 top-0 hidden h-full w-5 md:block" aria-hidden="true">
                                            <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                                                <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    </template>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </nav>
            </div>
        </header>

        <main class="flex-grow py-6">
            <slot />
        </main>

        <FooterSection :siteSettings="siteSettings"/>
    </div>
</template>

<script setup>
import {onMounted, ref, defineProps, computed} from 'vue'
import { CheckIcon } from '@heroicons/vue/24/solid'
import FooterSection from "@/Components/FooterSection.vue";

const props = defineProps({
    title: String,
    siteSettings: {
        type: Object,
        default: () => ({site_logo: '', footer_logo: '', footer_text: ''}),
    },
});

const logoUrl = computed(() => {
    return props.siteSettings.site_logo ? `/${props.siteSettings.site_logo}` : '';
});

const steps = ref([
    { id: '01', name: 'My Cart', href: '/cart', status: 'upcoming' },
    { id: '02', name: 'Shipping Address', href: '/cart/address', status: 'upcoming' },
    { id: '03', name: 'Delivery Options', href: '/cart/shipping', status: 'upcoming' },
    { id: '04', name: 'Payment Method', href: '/cart/payment', status: 'upcoming' },
    { id: '05', name: 'Summary', href: '/cart/summary', status: 'upcoming' }
])

onMounted(() => {
    const currentPath = window.location.pathname
    const currentStepIndex = steps.value.findIndex(step => step.href === currentPath)

    steps.value.forEach((step, index) => {
        if (index < currentStepIndex) {
            step.status = 'complete'
        } else if (index === currentStepIndex) {
            step.status = 'current'
        } else {
            step.status = 'upcoming'
        }
    })
})
</script>

<style>

nav[aria-label="Progress"] ol li {
    flex: 1 1 auto;
}
nav[aria-label="Progress"] ol li a {
    display: flex;
    align-items: center;
}
nav[aria-label="Progress"] ol li a span {
    display: flex;
    align-items: center;
}
nav[aria-label="Progress"] ol li span {
    display: flex;
    align-items: center;
}
nav[aria-label="Progress"] ol li span.cursor-not-allowed a {
    pointer-events: none;
}
</style>
