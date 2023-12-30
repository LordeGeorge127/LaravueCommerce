<template>
    <div class="flex justify-center items-center min-h-full w-full min-w-full">
        <div class="text-indigo-700 text-7xl font-bold border-r pb-8  px-8">404</div>
        <div class="px-8">
            <h1 class="text-5xl font-bold mb-2">Page Not Found</h1>
            <p class="text-gray-500 text-2xl mb-4">Please check URL and try Again</p>
            <router-link :to="{name:'app.dashboard'}" class=" rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            >Go back home
            </router-link>
        </div>
    </div>
</template>

<script setup>


</script>
