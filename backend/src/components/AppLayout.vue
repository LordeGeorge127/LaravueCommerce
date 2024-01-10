<script setup>
import Sidebar from "./Sidebar.vue";
import Navbar from "./Navbar.vue";
import {computed, onMounted, onUnmounted, ref} from "vue";
import store from "../store/index.js";
import Spinner from "./core/Spinner.vue";

const {title} = defineProps({
    title: String
})
const currentUser = computed(()=>{
    return store.state.user.data;
})
const sidebarOpened = ref(true);
const toggleSidebar = function () {
    // console.log('toggle');
    sidebarOpened.value = !sidebarOpened.value;
}
onMounted(()=>{
    store.dispatch('getUser')
handleSidebarOpen();
window.addEventListener("resize", handleSidebarOpen);
});


onUnmounted(()=>{
    window.removeEventListener("resize", handleSidebarOpen);
})


function handleSidebarOpen(){
    sidebarOpened.value = window.outerWidth > 768
}
</script>

<template>
    <div v-if="currentUser.id" class="flex min-h-full bg-gray-200">
        <!--Sidebar -->
        <sidebar class="transition-all" :class="{'-ml-[250px]' : !sidebarOpened}"></sidebar>
        <!--end of Sidebar -->
        <div class="flex-1">
           <Navbar @toggle-sidebar="toggleSidebar"></Navbar>
            <!--Content -->
            <main class="p-6">
                <router-view></router-view>

            </main>
            <!--end ofSidebar -->
        </div>
    </div>
    <div v-else class="min-h-full flex justify-center items-center text-indigo-500 text-3xl py-14">
        <Spinner/>
    </div>
</template>

<style scoped>

</style>
