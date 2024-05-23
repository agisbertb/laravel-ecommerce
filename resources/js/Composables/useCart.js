import { ref, computed, reactive, watch, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';
import axios from 'axios';

const cartItems = ref([]);
const showCartNotification = ref(false);

const loadCartFromServer = async () => {
    try {
        const response = await axios.get('/cart/get');
        cartItems.value = response.data.cartDetails.map(item => reactive(item));
        saveCart();
    } catch (error) {
        console.error("Error loading cart from server:", error);
    }
};

const loadCartFromLocalStorage = () => {
    const savedCart = localStorage.getItem('cartItems');
    if (savedCart) {
        cartItems.value = JSON.parse(savedCart).map(item => reactive(item));
    }
};

const saveCart = () => {
    localStorage.setItem('cartItems', JSON.stringify(cartItems.value));
};

const cartCount = computed(() => cartItems.value.reduce((total, item) => total + item.quantity, 0));

export default function useCart() {
    onMounted(async () => {
        loadCartFromLocalStorage();
        await loadCartFromServer();
    });

    async function addToCart(product) {
        try {
            await router.post('/cart/add', {
                product_id: product.id,
                quantity: 1,
                price: product.price
            }, {
                preserveScroll: true,
                preserveState: false,
            });

            const existingItem = cartItems.value.find(item => item.product_id === product.id);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                const newItem = reactive({ ...product, quantity: 1 });
                cartItems.value.push(newItem);
            }
            saveCart();

            showCartNotification.value = true;
            setTimeout(() => {
                showCartNotification.value = false;
            }, 3000);

            console.log("Product added successfully");
        } catch (error) {
            console.error("Error adding product to cart:", error);
        }
    }

    async function updateCartDetail(detailId, quantity) {
        try {
            await router.put(`/cart/details/${detailId}`, {
                quantity
            }, {
                preserveScroll: true,
                preserveState: false,
            });

            const item = cartItems.value.find(item => item.id === detailId);
            if (item) {
                item.quantity = quantity;
            }
            saveCart();

            console.log("Product updated successfully");
        } catch (error) {
            console.error("Error updating product in cart:", error);
        }
    }

    async function removeCartDetail(detailId) {
        try {
            await router.delete(`/cart/details/${detailId}`, {
                preserveScroll: true,
                preserveState: false,
            });

            cartItems.value = cartItems.value.filter(item => item.id !== detailId);
            saveCart();

            console.log("Product removed successfully");
        } catch (error) {
            console.error("Error removing product from cart:", error);
        }
    }

    async function clearCart() {
        try {
            await router.post('/cart/clear', {}, {
                preserveScroll: true,
                preserveState: false,
            });

            cartItems.value = [];
            saveCart();

            console.log("Cart cleared successfully");
        } catch (error) {
            console.error("Error clearing cart:", error);
        }
    }

    watch(cartItems, saveCart, { deep: true });

    return {
        cartItems,
        cartCount,
        addToCart,
        updateCartDetail,
        removeCartDetail,
        clearCart,
        showCartNotification
    };
}
