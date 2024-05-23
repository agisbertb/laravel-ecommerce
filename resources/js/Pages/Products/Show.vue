<template>
    <AppLayout :siteSettings="siteSettings" :title="product.slug">
        <div class="bg-white">
            <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                <div class="lg:grid lg:grid-cols-2 lg:items-start lg:gap-x-8 mt-8">
                    <!-- Image gallery -->
                    <TabGroup as="div" class="flex flex-col-reverse">
                        <!-- Image selector -->
                        <div class="mx-auto mt-6 hidden w-full max-w-2xl sm:block lg:max-w-none">
                            <TabList class="grid grid-cols-4 gap-6">
                                <Tab v-for="image in product.images" :key="image.id" class="relative flex h-24 cursor-pointer items-center justify-center rounded-md bg-white text-sm font-medium uppercase text-gray-900 hover:bg-gray-50 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-offset-4" v-slot="{ selected }">
                                    <span class="sr-only">{{ image.name }}</span>
                                    <span class="absolute inset-0 overflow-hidden rounded-md">
                    <img :src="image.url" alt="" class="h-full w-full object-cover object-center" />
                  </span>
                                    <span :class="[selected ? 'ring-blue-500' : 'ring-transparent', 'pointer-events-none absolute inset-0 rounded-md ring-2 ring-offset-2']" aria-hidden="true" />
                                </Tab>
                            </TabList>
                        </div>

                        <TabPanels class="aspect-h-1 aspect-w-1 w-full">
                            <TabPanel v-for="image in product.images" :key="image.id">
                                <img :src="image.url" :alt="image.alt" class="h-full w-full object-cover object-center sm:rounded-lg" />
                            </TabPanel>
                        </TabPanels>
                    </TabGroup>

                    <!-- Product info -->
                    <div class="mt-10 px-4 sm:mt-16 sm:px-0 lg:mt-0">
                        <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ product.name }}</h1>

                        <div class="mt-3">
                            <h2 class="sr-only">Product information</h2>
                            <p class="text-3xl tracking-tight text-gray-900">{{ product.price }}€</p>
                        </div>

                        <!-- Reviews -->
                        <div class="mt-3">
                            <h3 class="sr-only">Reviews</h3>
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    <StarIcon v-for="rating in [0, 1, 2, 3, 4]" :key="rating" :class="[product.rating > rating ? 'text-yellow-400' : 'text-gray-300', 'h-5 w-5 flex-shrink-0']" aria-hidden="true" />
                                </div>
                                <p class="sr-only">{{ product.rating }} out of 5 stars</p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <h3 class="sr-only">Description</h3>
                            <div class="mt-6 text-base text-gray-700 break-words overflow-hidden" v-html="product.description"></div>
                        </div>

                        <form class="mt-6">
                            <div class="mt-10 flex">
                                <PrimaryButton @click="handleAddToCart" class="flex max-w-xs flex-1 items-center justify-center rounded-md border border-transparent bg-blue-600 px-8 py-3 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-50 sm:w-full">Add to bag</PrimaryButton>
                                <div type="button" class="ml-4 flex items-center justify-center rounded-md px-3 py-3 text-gray-400 hover:bg-gray-100 hover:text-gray-500">
                                    <add-to-wishlist-button :product-id="product.id"></add-to-wishlist-button>
                                </div>
                            </div>
                        </form>

                        <section aria-labelledby="details-heading" class="mt-12">
                            <h2 id="details-heading" class="sr-only">Additional details</h2>
                            <div class="divide-y divide-gray-200 border-t">
                                <Disclosure as="div" v-for="detail in product.details" :key="detail.name" v-slot="{ open }">
                                    <h3>
                                        <DisclosureButton class="group relative flex w-full items-center justify-between py-6 text-left">
                                            <span :class="[open ? 'text-blue-600' : 'text-gray-900', 'text-sm font-medium']">{{ detail.name }}</span>
                                            <span class="ml-6 flex items-center">
                        <PlusIcon v-if="!open" class="block h-6 w-6 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
                        <MinusIcon v-else class="block h-6 w-6 text-blue-400 group-hover:text-blue-500" aria-hidden="true" />
                      </span>
                                        </DisclosureButton>
                                    </h3>
                                    <DisclosurePanel as="div" class="prose prose-sm pb-6">
                                        <ul role="list">
                                            <li v-for="item in detail.items" :key="item">{{ item }}</li>
                                        </ul>
                                    </DisclosurePanel>
                                </Disclosure>
                            </div>
                        </section>
                    </div>
                </div>
            </div>

            <!-- Reviews -->
            <section aria-labelledby="reviews-heading" class="bg-white">
                <div class="mx-auto max-w-2xl px-4 py-24 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-12 lg:gap-x-8 lg:px-8 lg:py-32">
                    <div class="lg:col-span-4">
                        <h2 id="reviews-heading" class="text-2xl font-bold tracking-tight text-gray-900">Customer Reviews</h2>
                        <div class="mt-3 flex items-center">
                            <div>
                                <div class="flex items-center">
                                    <StarIcon v-for="rating in [0, 1, 2, 3, 4]" :key="rating" :class="[reviews.average > rating ? 'text-yellow-400' : 'text-gray-300', 'h-5 w-5 flex-shrink-0']" aria-hidden="true" />
                                </div>
                                <p class="sr-only">{{ reviews.average }} out of 5 stars</p>
                            </div>
                            <p class="ml-2 text-sm text-gray-900">Based on {{ reviews.totalCount }} reviews</p>
                        </div>
                        <div class="mt-6">
                            <h3 class="sr-only">Review data</h3>
                            <dl class="space-y-3">
                                <div v-for="count in [...reviews.counts].reverse()" :key="count.rating" class="flex items-center text-sm">
                                    <dt class="flex flex-1 items-center">
                                        <p class="w-3 font-medium text-gray-900">{{ count.rating }}<span class="sr-only"> star reviews</span></p>
                                        <div aria-hidden="true" class="ml-1 flex flex-1 items-center">
                                            <StarIcon :class="[count.count > 0 ? 'text-yellow-400' : 'text-gray-300', 'h-5 w-5 flex-shrink-0']" aria-hidden="true" />
                                            <div class="relative ml-3 flex-1">
                                                <div class="h-3 rounded-full border border-gray-200 bg-gray-100" />
                                                <div v-if="count.count > 0" class="absolute inset-y-0 rounded-full border border-yellow-400 bg-yellow-400" :style="{ width: `calc(${count.count} / ${reviews.totalCount} * 100%)` }" />
                                            </div>
                                        </div>
                                    </dt>
                                    <dd class="ml-3 w-10 text-right text-sm tabular-nums text-gray-900">{{ Math.round((count.count / reviews.totalCount) * 100) }}%</dd>
                                </div>
                            </dl>
                        </div>
                        <div v-if="userId" class="mt-10">
                            <h3 class="text-lg font-medium text-gray-900">Share your thoughts</h3>
                            <p class="mt-1 text-sm text-gray-600">If you’ve used this product, share your thoughts with other customers</p>
                            <button @click="toggleReviewForm" class="mt-6 inline-flex w-full items-center justify-center rounded-md border border-gray-300 bg-white px-8 py-2 text-sm font-medium text-gray-900 hover:bg-gray-50 sm:w-auto lg:w-full">
                                {{ showReviewForm ? 'Close Review Form' : 'Write a Review' }}
                            </button>
                            <div v-if="showReviewForm && userId" class="mt-4">
                                <form @submit.prevent="submitReview">
                                    <div>
                                        <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                                        <select v-model="form.rating" id="rating" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                                        </select>
                                    </div>
                                    <textarea v-model="form.comment" rows="4" class="w-full p-2 border border-gray-300 rounded-md mt-4" placeholder="Write your review here..."></textarea>
                                    <button type="submit" class="mt-2 bg-blue-500 text-white rounded px-4 py-2">Submit Review</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="mt-16 lg:col-span-7 lg:col-start-6 lg:mt-0">
                        <h3 class="sr-only">Recent reviews</h3>
                        <div class="flow-root">
                            <div class="-my-12 divide-y divide-gray-200">
                                <div v-for="review in reviews.featured" :key="review.id" class="py-12">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <h4 class="text-sm font-bold text-gray-900">{{ review.user.name }}</h4>
                                            <div class="mt-1 flex items-center">
                                                <StarIcon v-for="rating in [0, 1, 2, 3, 4]" :key="rating" :class="[review.rating > rating ? 'text-yellow-400' : 'text-gray-300', 'h-5 w-5 flex-shrink-0']" aria-hidden="true" />
                                            </div>
                                            <p class="mt-4 text-sm text-gray-600">{{ review.comment }}</p>
                                            <button v-if="review.user_id === userId" @click="editReview(review)" class="text-blue-500">Edit</button>
                                            <button v-if="review.user_id === userId" @click="deleteReview(review.id)" class="text-red-500 ml-2">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <AlertNotification v-if="showSuccessNotification" :title="successTitle" :message="successMessage" :type="'success'" v-model:visible="showSuccessNotification" />
        <AlertNotification v-if="showErrorNotification" :title="errorTitle" :message="errorMessage" :type="'error'" v-model:visible="showErrorNotification" />
        <AlertNotification v-if="showCartNotification" title="Product Added" message="Product has been added to your cart." :type="'success'" v-model:visible="showCartNotification" />
    </AppLayout>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import { usePage, useForm } from '@inertiajs/vue3';

import AppLayout from '@/Layouts/AppLayout.vue';
import {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Tab,
    TabGroup,
    TabList,
    TabPanel,
    TabPanels,
} from '@headlessui/vue';
import { StarIcon } from '@heroicons/vue/20/solid';
import { MinusIcon, PlusIcon } from '@heroicons/vue/24/outline';
import AddToWishlistButton from '@/Components/AddToWishlistButton.vue';
import AlertNotification from '@/Components/AlertNotification.vue';
import useCart from '@/Composables/useCart';
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    product: Object,
    siteSettings: Object,
    reviews: Object
});

const { auth } = usePage().props;
const userId = auth?.user?.id || null;

const form = useForm({
    id: null,
    product_id: props.product.id,
    rating: null,
    comment: '',
});

const showReviewForm = ref(false);
const showSuccessNotification = ref(false);
const showErrorNotification = ref(false);
const successTitle = ref('');
const successMessage = ref('');
const errorTitle = ref('');
const errorMessage = ref('');
const { addToCart, showCartNotification } = useCart();

const handleAddToCart = async (event) => {
    event.preventDefault();

    if (!props.product || props.product.id === undefined) {
        console.error('Product is undefined or lacks an ID.');
        return;
    }

    await addToCart({
        id: props.product.id,
        quantity: 1,
        price: props.product.price,
    });
};

watch(showCartNotification, (newVal) => {
    if (newVal) {
        setTimeout(() => {
            showCartNotification.value = false;
        }, 3000);
    }
});

function toggleReviewForm() {
    showReviewForm.value = !showReviewForm.value;
    if (showReviewForm.value && userReview.value) {
        form.id = userReview.value.id;
        form.rating = userReview.value.rating;
        form.comment = userReview.value.comment;
    }
}

function submitReview() {
    console.log('Submit Review Called');
    console.log('Form Data:', form);

    if (form.id) {
        form.put(`/products/${props.product.id}/reviews/${form.id}`, {
            preserveScroll: true,
            onSuccess: () => {
                form.reset();
                showReviewForm.value = false;
                successTitle.value = 'Review Updated';
                successMessage.value = 'Your review has been updated successfully.';
                showSuccessNotification.value = true;
                setTimeout(() => {
                    showSuccessNotification.value = false;
                }, 3000);
            },
            onError: (errors) => {
                console.error(errors);
                errorTitle.value = 'Review Error';
                errorMessage.value = errors.message || 'An error occurred while updating your review.';
                showErrorNotification.value = true;
                setTimeout(() => {
                    showErrorNotification.value = false;
                }, 3000);
            },
        });
    } else {
        form.post(`/products/${props.product.id}/reviews`, {
            preserveScroll: true,
            onSuccess: () => {
                form.reset();
                showReviewForm.value = false;
                successTitle.value = 'Review Submitted';
                successMessage.value = 'Your review has been submitted successfully.';
                showSuccessNotification.value = true;
                setTimeout(() => {
                    showSuccessNotification.value = false;
                }, 3000);
            },
            onError: (errors) => {
                console.error(errors);
                errorTitle.value = 'Review Error';
                errorMessage.value = errors.message || 'An error occurred while submitting your review.';
                showErrorNotification.value = true;
                setTimeout(() => {
                    showErrorNotification.value = false;
                }, 3000);
            },
        });
    }
}

function editReview(review) {
    form.id = review.id;
    form.comment = review.comment;
    form.rating = review.rating;
    showReviewForm.value = true;
}

function deleteReview(id) {
    if (confirm('Are you sure you want to delete this review?')) {
        form.delete(`/products/${props.product.id}/reviews/${id}`, {
            onSuccess: () => {
                form.reset();
                successTitle.value = 'Review Deleted';
                successMessage.value = 'Your review has been deleted successfully.';
                showSuccessNotification.value = true;
                setTimeout(() => {
                    showSuccessNotification.value = false;
                }, 3000);
            },
            onError: (errors) => {
                console.error(errors);
                errorTitle.value = 'Delete Error';
                errorMessage.value = errors.message || 'An error occurred while deleting your review.';
                showErrorNotification.value = true;
                setTimeout(() => {
                    showErrorNotification.value = false;
                }, 3000);
            },
        });
    }
}

const userReview = ref(null);

onMounted(() => {
    userReview.value = props.reviews.userReview || null;
    if (userReview.value) {
        form.id = userReview.value.id;
        form.comment = userReview.value.comment;
        form.rating = userReview.value.rating;
    }
});
</script>
