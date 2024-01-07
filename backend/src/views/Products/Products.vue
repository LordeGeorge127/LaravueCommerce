<script setup>
import {ref} from "vue";
import ProductsTable from "./ProductsTable.vue";
import ProductModal from "./ProductModal.vue";
import store from "../../store/index.js";
import {getProduct} from "../../store/actions.js";
const showModal = ref(false);
const DEFAULT_EMPTY_OBJECT = {
    id: '',
    title: '',
    image: '',
    description: '',
    price: '',
}
const product = ref({...DEFAULT_EMPTY_OBJECT})
function showProductModal() {
    showModal.value = true
}
function editProduct(prod) {
    store.dispatch('getProduct',prod.id)
        .then(({data})=>{
            product.value = data;
            showProductModal();
            // debugger
        })
}
function onModalClose() {
    product.value = {...DEFAULT_EMPTY_OBJECT};
}


</script>

<template>
    <!--    <pre>{{products}}</pre>-->
    <div class="flex items-center justify-between mb-3">
        <h1 class="text-3xl font-semibold">Products</h1>
        <button type="submit"
                @click="showProductModal"
                class="flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-700">
            Add new Product
        </button>
    </div>
<!--        <pre>{{productModel}}</pre>-->
    <ProductModal v-model="showModal" :product="product" @close="onModalClose"></ProductModal>
    <ProductsTable @clickEdit="editProduct"/>
</template>

<style scoped>

</style>
