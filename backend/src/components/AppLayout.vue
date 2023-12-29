<script setup>
import Sidebar from "./Sidebar.vue";
import Navbar from "./Navbar.vue";
import {onMounted, onUnmounted, ref} from "vue";

const {title} = defineProps({
    title: String
})
const sidebarOpened = ref(true);
const toggleSidebar = function () {
    // console.log('toggle');
    sidebarOpened.value = !sidebarOpened.value;
}
onMounted(()=>{
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
    <div class="flex min-h-full bg-gray-200">
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
</template>

<style scoped>

</style>
