<script setup>
import Sidebar from "./Sidebar.vue";
import Navbar from "./Navbar.vue";

const {title} = defineProps({
    title: String
})
</script>

<template>
    <div class="flex min-h-full bg-gray-200">
        <!--Sidebar -->
        <sidebar></sidebar>
        <!--end of Sidebar -->
        <div class="flex-1">
           <Navbar></Navbar>
            <!--Content -->
            <main class="p-6">
               <div class="p-4 rounded bg-white">
                   Dashboard
                   <router-view></router-view>
               </div>
            </main>
            <!--end ofSidebar -->
        </div>
    </div>
</template>

<style scoped>

</style>
