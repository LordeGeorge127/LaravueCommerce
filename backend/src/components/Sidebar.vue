<script setup>
import {HomeIcon, UsersIcon, ChartBarIcon, ClipboardDocumentListIcon} from "@heroicons/vue/24/outline/index.js";
</script>

<template>
    <!--Sidebar -->
    <div class="w-[250px] bg-indigo-700 text-gray-300 py-5 px-2">
        <router-link :to="{name: 'app.dashboard'}"
                     class="flex items-center py-2 px-4 rounded transition-colors hover:bg-blue-800 mb-3">
            <span class="mr-2"><HomeIcon class="w-5"></HomeIcon></span>
            <span class="text-sm">Dashboard</span>
        </router-link>
        <router-link :to="{name: 'app.products'}"
                     class="flex items-center py-2 px-4 rounded transition-colors hover:bg-blue-800 mb-2">
            <span class="mr-2"><clipboard-document-list-icon class="w-5"></clipboard-document-list-icon></span>
            <span class="text-sm">Products</span>
        </router-link>
        <router-link :to="{name: 'app.dashboard'}"
                     class="flex items-center py-2 px-4 rounded transition-colors hover:bg-blue-800 mb-2">
            <span class="mr-2"><UsersIcon class="w-5"></UsersIcon></span>
            <span class="text-sm">Users</span>
        </router-link>
        <router-link :to="{name: 'app.dashboard'}"
                     class="flex items-center py-2 px-4 rounded transition-colors hover:bg-blue-800 mb-2">
            <span class="mr-2"><ChartBarIcon class="w-5"></ChartBarIcon></span>
            <span class="text-sm">Reports</span>
        </router-link>
    </div>
    <!--end of Sidebar -->

</template>

<style scoped>

</style>
