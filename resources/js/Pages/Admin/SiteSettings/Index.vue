<template>
    <AdminLayout title="Site Settings">
        <div class="mx-4 mt-4 mb-14">
            <nav class="flex" aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-4">
                    <li>
                        <div>
                            <Link href="/admin/dashboard" class="text-gray-400 hover:text-gray-500">
                                <HomeIcon class="h-5 w-5 flex-shrink-0" aria-hidden="true"/>
                                <span class="sr-only">Home</span>
                            </Link>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <ChevronRightIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true"/>
                            <Link href="/admin/dashboard" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Admin</Link>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <ChevronRightIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true"/>
                            <a class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Site Settings</a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="mt-4 mx-4">
            <div class="bg-white p-6 rounded-2xl border-b shadow-2xl">
                <div class="flex justify-center px-4 py-8">
                    <div class="w-full max-w-4xl mx-auto bg-white p-8">
                        <div class="mb-8">
                            <h1 class="text-2xl font-bold text-gray-700 mb-1 text-center">Update Site Settings</h1>
                            <p class="text-gray-600 text-sm text-center">Complete the form below to update the site settings.</p>
                        </div>

                        <div class="sm:hidden">
                            <label for="tabs" class="sr-only">Select a tab</label>
                            <select id="tabs" name="tabs" class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" @change="selectTab">
                                <option v-for="tab in tabs" :key="tab.name" :value="tab.name" :selected="tab.current">{{ tab.name }}</option>
                            </select>
                        </div>
                        <div class="hidden sm:block">
                            <div class="border-b border-gray-200">
                                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                    <a v-for="tab in tabs" :key="tab.name" @click="selectTab(tab.name)" :class="[tab.current ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700', 'group inline-flex items-center border-b-2 py-4 px-1 text-sm font-medium']" :aria-current="tab.current ? 'page' : undefined">
                                        <component :is="tab.icon" :class="[tab.current ? 'text-indigo-500' : 'text-gray-400 group-hover:text-gray-500', '-ml-0.5 mr-2 h-5 w-5']" aria-hidden="true" />
                                        <span>{{ tab.name }}</span>
                                    </a>
                                </nav>
                            </div>
                        </div>

                        <!-- Alert Notification -->
                        <AlertNotification title="Success" :message="alertMessage" v-model:visible="showAlert" />

                        <form @submit.prevent="updateSettings" class="space-y-6 mt-4" enctype="multipart/form-data">
                            <div v-if="selectedTab === 'General Settings'">
                                <!-- General Settings -->
                                <div class="mt-4">
                                    <label for="site_name" class="block text-sm font-medium text-gray-700">Site Name</label>
                                    <input v-model="form.site_name" type="text" id="site_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div class="mt-4">
                                    <label for="site_logo" class="block text-sm font-medium text-gray-700">Site Logo</label>
                                    <div class="mt-4 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                        <div class="space-y-1 text-center">
                                            <PhotoIcon v-if="!previews.site_logo" class="mx-auto h-12 w-12 text-gray-400" />
                                            <img v-if="previews.site_logo" :src="previews.site_logo" alt="Site Logo Preview" class="mx-auto h-24 w-24 object-cover rounded-full"/>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="site_logo" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                    <span>Upload a file</span>
                                                    <input id="site_logo" name="site_logo" type="file" class="sr-only" @change="handleFileChange">
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">
                                                PNG, JPG, GIF up to 10MB
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <label for="footer_name" class="block text-sm font-medium text-gray-700">Footer Name</label>
                                    <input v-model="form.footer_name" type="text" id="footer_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div class="mt-4">
                                    <label for="footer_logo" class="block text-sm font-medium text-gray-700">Footer Logo</label>
                                    <div class="mt-4 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                        <div class="space-y-1 text-center">
                                            <PhotoIcon v-if="!previews.footer_logo" class="mx-auto h-12 w-12 text-gray-400" />
                                            <img v-if="previews.footer_logo" :src="previews.footer_logo" alt="Footer Logo Preview" class="mx-auto h-24 w-24 object-cover rounded-full"/>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="footer_logo" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                    <span>Upload a file</span>
                                                    <input id="footer_logo" name="footer_logo" type="file" class="sr-only" @change="handleFileChange">
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">
                                                PNG, JPG, GIF up to 10MB
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <label for="favicon" class="block text-sm font-medium text-gray-700">Favicon</label>
                                    <div class="mt-4 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                        <div class="space-y-1 text-center">
                                            <PhotoIcon v-if="!previews.favicon" class="mx-auto h-12 w-12 text-gray-400" />
                                            <img v-if="previews.favicon" :src="previews.favicon" alt="Favicon Preview" class="mx-auto h-24 w-24 object-cover rounded-full"/>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="favicon" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                    <span>Upload a file</span>
                                                    <input id="favicon" name="favicon" type="file" class="sr-only" @change="handleFileChange">
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">
                                                ICO, PNG up to 10MB
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="selectedTab === 'SEO Settings'">
                                <!-- SEO Settings -->
                                <div class="mt-4">
                                    <label for="seo_title" class="block text-sm font-medium text-gray-700">SEO Title</label>
                                    <input v-model="form.seo_title" type="text" id="seo_title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div class="mt-4">
                                    <label for="seo_description" class="block text-sm font-medium text-gray-700">SEO Description</label>
                                    <textarea v-model="form.seo_description" id="seo_description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                                <div class="mt-4">
                                    <label for="seo_keywords" class="block text-sm font-medium text-gray-700">SEO Keywords</label>
                                    <input v-model="form.seo_keywords" type="text" id="seo_keywords" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div class="mt-4">
                                    <label for="canonical_url" class="block text-sm font-medium text-gray-700">Canonical URL</label>
                                    <input v-model="form.canonical_url" type="url" id="canonical_url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div class="mt-4">
                                    <label for="robots" class="block text-sm font-medium text-gray-700">Robots Meta Tag</label>
                                    <input v-model="form.robots" type="text" id="robots" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div class="mt-4">
                                    <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                                    <input v-model="form.author" type="text" id="author" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <!-- Open Graph Settings -->
                                <div class="mt-4">
                                    <label for="og_title" class="block text-sm font-medium text-gray-700">Open Graph Title</label>
                                    <input v-model="form.og_title" type="text" id="og_title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div class="mt-4">
                                    <label for="og_description" class="block text-sm font-medium text-gray-700">Open Graph Description</label>
                                    <textarea v-model="form.og_description" id="og_description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                                <div class="mt-4">
                                    <label for="og_image" class="block text-sm font-medium text-gray-700">Open Graph Image</label>
                                    <div class="mt-4 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                        <div class="space-y-1 text-center">
                                            <PhotoIcon v-if="!previews.og_image" class="mx-auto h-12 w-12 text-gray-400" />
                                            <img v-if="previews.og_image" :src="previews.og_image" alt="Open Graph Image Preview" class="mx-auto h-24 w-24 object-cover rounded-full"/>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="og_image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                    <span>Upload a file</span>
                                                    <input id="og_image" name="og_image" type="file" class="sr-only" @change="handleFileChange">
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">
                                                PNG, JPG, GIF up to 10MB
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Twitter Settings -->
                                <div class="mt-4">
                                    <label for="twitter_card" class="block text-sm font-medium text-gray-700">Twitter Card</label>
                                    <input v-model="form.twitter_card" type="text" id="twitter_card" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div class="mt-4">
                                    <label for="twitter_title" class="block text-sm font-medium text-gray-700">Twitter Title</label>
                                    <input v-model="form.twitter_title" type="text" id="twitter_title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div class="mt-4">
                                    <label for="twitter_description" class="block text-sm font-medium text-gray-700">Twitter Description</label>
                                    <textarea v-model="form.twitter_description" id="twitter_description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                                <div class="mt-4">
                                    <label for="twitter_image" class="block text-sm font-medium text-gray-700">Twitter Image</label>
                                    <div class="mt-4 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                        <div class="space-y-1 text-center">
                                            <PhotoIcon v-if="!previews.twitter_image" class="mx-auto h-12 w-12 text-gray-400" />
                                            <img v-if="previews.twitter_image" :src="previews.twitter_image" alt="Twitter Image Preview" class="mx-auto h-24 w-24 object-cover rounded-full"/>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="twitter_image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                    <span>Upload a file</span>
                                                    <input id="twitter_image" name="twitter_image" type="file" class="sr-only" @change="handleFileChange">
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">
                                                PNG, JPG, GIF up to 10MB
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="selectedTab === 'Social Links'">
                                <!-- Social Links -->
                                <div class="mt-4">
                                    <label for="facebook_url" class="block text-sm font-medium text-gray-700">Facebook URL</label>
                                    <input v-model="form.facebook_url" type="url" id="facebook_url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div class="mt-4">
                                    <label for="instagram_url" class="block text-sm font-medium text-gray-700">Instagram URL</label>
                                    <input v-model="form.instagram_url" type="url" id="instagram_url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div class="mt-4">
                                    <label for="twitter_url" class="block text-sm font-medium text-gray-700">Twitter URL</label>
                                    <input v-model="form.twitter_url" type="url" id="twitter_url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div class="mt-4">
                                    <label for="youtube_url" class="block text-sm font-medium text-gray-700">YouTube URL</label>
                                    <input v-model="form.youtube_url" type="url" id="youtube_url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                            <div class="flex justify-end mt-4 space-x-4">
                                <button type="submit" class="inline-flex items-center gap-x-2 rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                    <ArrowPathIcon class="-ml-0.5 h-5 w-5" aria-hidden="true"/>
                                    Update Settings
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { reactive, ref, onMounted } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import {
    ChevronRightIcon,
    HomeIcon,
    ArrowPathIcon,
    PhotoIcon,
    UserIcon,
    BuildingOfficeIcon,
    UsersIcon,
} from "@heroicons/vue/20/solid/index.js";
import AlertNotification from "@/Components/AlertNotification.vue";

const props = defineProps({
    settings: Object,
    flash: Object,
});

const tabs = ref([
    { name: 'General Settings', icon: UserIcon, current: true },
    { name: 'SEO Settings', icon: BuildingOfficeIcon, current: false },
    { name: 'Social Links', icon: UsersIcon, current: false },
]);

const selectedTab = ref('General Settings');

const form = reactive({
    site_name: props.settings.site_name || '',
    footer_name: props.settings.footer_name || '',
    seo_title: props.settings.seo_title || '',
    seo_description: props.settings.seo_description || '',
    seo_keywords: props.settings.seo_keywords || '',
    canonical_url: props.settings.canonical_url || '',
    robots: props.settings.robots || '',
    author: props.settings.author || '',
    facebook_url: props.settings.facebook_url || '',
    instagram_url: props.settings.instagram_url || '',
    twitter_url: props.settings.twitter_url || '',
    youtube_url: props.settings.youtube_url || '',
    og_title: props.settings.og_title || '',
    og_description: props.settings.og_description || '',
    twitter_card: props.settings.twitter_card || '',
    twitter_title: props.settings.twitter_title || '',
    twitter_description: props.settings.twitter_description || '',
    site_logo: null,
    footer_logo: null,
    favicon: null,
    og_image: null,
    twitter_image: null,
});

const previews = reactive({
    site_logo: props.settings.site_logo ? `/${props.settings.site_logo}` : null,
    footer_logo: props.settings.footer_logo ? `/${props.settings.footer_logo}` : null,
    favicon: props.settings.favicon ? `/${props.settings.favicon}` : null,
    og_image: props.settings.og_image ? `/${props.settings.og_image}` : null,
    twitter_image: props.settings.twitter_image ? `/${props.settings.twitter_image}` : null,
});

const showAlert = ref(false);
const alertMessage = ref('');

onMounted(() => {
    if (props.flash && props.flash.success) {
        alertMessage.value = props.flash.success;
        showAlert.value = true;

        setTimeout(() => {
            showAlert.value = false;
        }, 5000);
    }
});

function handleFileChange(event) {
    const field = event.target.id;
    const file = event.target.files[0];
    form[field] = file;

    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            previews[field] = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}

async function updateSettings() {
    const formData = new FormData();
    Object.keys(form).forEach(key => {
        if (form[key] instanceof File || form[key]) {
            formData.append(key, form[key]);
        }
    });

    try {
        await router.post(route('admin.site-settings.update'), formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        });

        alertMessage.value = 'Settings updated successfully.';
        showAlert.value = true;

        setTimeout(() => {
            showAlert.value = false;
        }, 5000);
    } catch (error) {
        console.error('Error updating settings:', error);
    }
}

function selectTab(tabName) {
    selectedTab.value = tabName;
    tabs.value.forEach(tab => {
        tab.current = (tab.name === tabName);
    });
}
</script>
