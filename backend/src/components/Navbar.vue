<script setup>

import {Bars3Icon} from "@heroicons/vue/24/outline/index.js";
import {UserIcon, ChevronDoubleLeftIcon} from "@heroicons/vue/24/outline/index.js"
import {Menu, MenuButton, MenuItems, MenuItem} from '@headlessui/vue'
import {ChevronDownIcon} from '@heroicons/vue/20/solid'
import store from "../store/index.js";
import router from "../router/index.js";
import {computed} from "vue";

const emit = defineEmits(['toggle-sidebar']);
const currentUser = computed(()=>{
    return store.state.user.data
})
function logout() {
    store.dispatch('logout')
        .then(() => {
            router.push({name: 'login'})
        })
}
</script>

<template>
    <header class="flex justify-between items-center p-3 h-14 shadow bg-white">
        <button @click="emit('toggle-sidebar')"
                class="flex justify-center items-center transition-colors rounded h-8 w-8 text-gray-900 hover:bg-blue-200">
            <Bars3Icon class="w-6"/>
        </button>


        <Menu as="div" class="relative inline-block text-left">

            <MenuButton class="flex items-center mr-4">
                <img src="https://randomuser.me/api/portraits/men/62.jpg" class="rounded-full w-10" alt="">
                <small class="p-2">{{ currentUser.name }}</small>

            </MenuButton>


            <transition
                enter-active-class="transition duration-100 ease-out"
                enter-from-class="transform scale-95 opacity-0"
                enter-to-class="transform scale-100 opacity-100"
                leave-active-class="transition duration-75 ease-in"
                leave-from-class="transform scale-100 opacity-100"
                leave-to-class="transform scale-95 opacity-0"
            >
                <MenuItems
                    class="absolute right-0 mt-2 w-40 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
                >
                    <div class="px-1 py-1">
                        <MenuItem v-slot="{ active }">
                            <button
                                :class="[
                  active ? 'bg-violet-500 text-white' : 'text-gray-900',
                  'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                ]"
                            >
                                <UserIcon
                                    :active="active"
                                    class="mr-2 h-5 w-5 text-violet-400"
                                    aria-hidden="true"
                                />
                                Profile
                            </button>
                        </MenuItem>
                        <MenuItem v-slot="{ active }">
                            <button @click="logout"
                                    :class="[
                  active ? 'bg-violet-500 text-white' : 'text-gray-900',
                  'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                ]"
                            >
                                <chevron-double-left-icon
                                    :active="active"
                                    class="mr-2 h-5 w-5 text-violet-400"
                                    aria-hidden="true"
                                />
                                Logout
                            </button>
                        </MenuItem>
                    </div>
                </MenuItems>
            </transition>
        </Menu>


    </header>

</template>

<style scoped>

</style>
