<template>
    <TransitionRoot appear :show="show" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-10">
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black/55"/>
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div
                    class="flex min-h-full items-center justify-center p-4 text-center"
                >
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel
                            class="w-full max-w-lg transform overflow-hidden rounded-2xl bg-white  text-left align-middle shadow-xl transition-all"
                        >
                            <Spinner v-if="loading"
                                     class="absolute left-0 top-0 bg-white right-0 bottom-0 flex justify-center items-center"/>

                            <header class="py-3 px-4 flex justify-between items-center">
                                <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900">
                                    {{
                                        product.id ? `Update Product' : "${props.product.title}"` : 'Create new Product'
                                    }}
                                </DialogTitle>
                                <button
                                    @click="closeModal()"
                                    class="w-8 h-8 flex items-center justify-center rounded-full transition-colors cursor-pointer hover:bg-[rgba(0,0,0,2)]">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                                    </svg>

                                </button>
                            </header>
                            <form @submit.prevent="onSubmit">
                                <div class="bg-white px-4 pt-5 pb-4">

                                    <CustomInput class="mb-2" v-model.trim="product.title" label="Product Title"/>
                                    <CustomInput class="mb-2" type="file" @change="file => product.image = file"
                                                 label="Product Image"/>
                                    <CustomInput class="mb-2" type="textarea" v-model.trim="product.description"
                                                 label="Product Description"/>
                                    <CustomInput class="mb-2" type="number" v-model.number="product.price"
                                                 label="Product Price" prepend="$"/>

                                </div>
                                <footer class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="submit"
                                            class="py-2 w-full px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500
                                             border-gray-300 shadow-sm     ">

                                        Submit
                                    </button>
                                    <button type="button"
                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2"
                                            @click="closeModal" ref="cancelButtonRef">
                                        Cancel
                                    </button>
                                </footer>
                            </form>

                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import {computed, onUpdated, ref} from 'vue'
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'
import Spinner from "../../components/core/Spinner.vue";
import store from "../../store/index.js";
import CustomInput from "../../components/core/CustomInput.vue";

// const isOpen = ref(true);
const loading = ref(false);
const props = defineProps({
    modelValue: Boolean,
    product: {
        required: true,
        type: Object,
        default: {}
    }
});
const emit = defineEmits(['update:modelValue', 'close']);

const product = ref({
    id: props.product.id,
    title: props.product.title,
    image: props.product.image,
    description: props.product.description,
    price: props.product.price,
})
onUpdated(() => {
    product.value = {
        id: props.product.id,
        title: props.product.title,
        image: props.product.image,
        description: props.product.description,
        price: props.product.price,
    }
})

const show = computed(
    {
        get: () => props.modelValue,
        set: (value) => emit('update:modelValue', value)

    }
)

function closeModal() {
    show.value = false;
    emit('close');
}

function onSubmit() {
    loading.value = true;
    if (product.value.id) {
        store.dispatch('updateProduct', product.value)
            .then(response => {
                loading.value = false;
                if (response.status === 200) {
                    store.dispatch('getProducts');
                    closeModal();
                }
            })
    } else {
        store.dispatch('createProduct', product.value)
            .then(response => {
                // debugger
                loading.value = false;
                if (response.status === 201) {
                    store.dispatch('getProducts');
                    closeModal();
                }
            })
            .catch(err => {
                loading.value = false;
                debugger;
            })


    }
}

// function onSubmit() {
//     loading.value = true;
//
//     if (!product.value.title || !product.value.price) {
//         console.error('Title and price are required.');
//         loading.value = false;
//         return;
//     }
//
//     if (product.value.id) {
//         store.dispatch('updateProduct', product.value)
//             .then(response => {
//                 loading.value = false;
//                 if (response.status === 200) {
//                     store.dispatch('getProducts');
//                     closeModal();
//                 }
//             })
//             .catch(error => {
//                 console.error('Error updating product:', error.response.data);
//                 loading.value = false;
//             });
//     } else {
//         store.dispatch('createProduct', product.value)
//             .then(response => {
//                 loading.value = false;
//                 if (response.status === 201) {
//                     store.dispatch('getProducts');
//                     closeModal();
//                 }
//             })
//             .catch(error => {
//                 console.error('Error creating product:', error.response.data);
//                 // Log or display the specific validation errors
//                 const validationErrors = error.response.data.errors;
//                 console.log('Validation errors:', validationErrors);
//                 loading.value = false;
//             });
//     }
// }

</script>


<style scoped>

</style>
