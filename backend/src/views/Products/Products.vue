<script setup>
import {ref} from "vue";
import ProductsTable from "./ProductsTable.vue";
import ProductModal from "./ProductModal.vue";
const showModal = ref(false);
const product = ref({
    id: '',
    title: '',
    image: '',
    description: '',
    price: '',
})
function showProductModal() {
    showModal.value = true
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
    <ProductModal v-model="showModal" :product="product"></ProductModal>
    <ProductsTable/>
</template>

<style scoped>

</style>
