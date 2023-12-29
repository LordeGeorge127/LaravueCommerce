<script setup>
import Sidebar from "./Sidebar.vue";

const {title} = defineProps({
    title: String
})
</script>

<template>
    <div class="flex min-h-full ">
        <!--Sidebar -->
        <sidebar></sidebar>
        <!--end of Sidebar -->
        <div class="flex1">
            <header class="h-8 shadow bg-white">
                Header
            </header>
            <!--Content -->
            <main class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                Dashboard
                <router-view></router-view>
            </main>
            <!--end ofSidebar -->
        </div>
    </div>
</template>

<style scoped>

</style>
