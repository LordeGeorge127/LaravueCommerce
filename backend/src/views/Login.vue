<!--
  This example requires some changes to your config:

  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<template>

    <guest-layout title="Sign in to your account">
        <form class="space-y-6" method="POST" @submit.prevent="login">
            <div v-if="errorMsg" class="flex justify-between items-center rounded py-3 px-5 text-white bg-red-500">
                {{ errorMsg }}
            <span @click="errorMsg = ''" class="w-8 h-8 flex items-center justify-center transition-colors cursor-pointer">Close</span>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                <div class="mt-2">
                    <input id="email" name="email" type="email" autocomplete="email" required=""
                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                           v-model="user.email"/>
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                </div>
                <div class="mt-2">
                    <input id="password" name="password" type="password" autocomplete="current-password" required=""
                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                           v-model="user.password"/>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" name="remember-me" id="remember-me" class="h-4 w-4 text-indigo-600"
                           v-model="user.remember">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                </div>
                <div class="text-sm">
                    <router-link :to="{name:'requestPassword'}"
                                 class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?
                    </router-link>
                </div>
            </div>

            <div>
                <button type="submit"
                        :disabled="loading"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        :class="{'cursor-not-allowed': loading,
                        'hover:bg-indigo-200':loading
                        }"
                >
                    <svg class="animate-spin ml-1 mr-3 h-5 w-5 text-white" fill="none"></svg>
                    Sign in
                </button>
            </div>
        </form>
    </guest-layout>

</template>


<style scoped>

</style>
<script setup>
import GuestLayout from "../components/GuestLayout.vue";
import {ref} from 'vue';
import store from "../store/index.js";
import router from "../router/index.js";

const loading = ref(false);
const errorMsg = ref('');
const user = {
    email: '',
    password: '',
    remember: false,
}

function login() {
    loading.value = !loading.value;
    store.dispatch('login', user)
        .then(() => {
            loading.value = false;
            router.push({name: 'app.dashboard'})
        })
        .catch(({response}) => {
            // debugger;
            loading.value = false;
            errorMsg.value = response.data.message;
        })

}
</script>
