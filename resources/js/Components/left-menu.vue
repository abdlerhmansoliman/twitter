<template>
       <aside class="text-white py-4 h-auto">

            <div style="width: 275px;">
              <div class="overflow-y-auto fixed h-screen pr-3 flex flex-col  w-64  text-white" style="width: 275px;">
                <!-- Logo -->
          <Link :href="route('tweet.index')" class="inline-block">
            <svg viewBox="0 0 24 24" class="h-8 w-8 text-white ml-3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M23 3a10.9 10.9 0 0 1-3.14 1.53A4.48 4.48 0 0 0 22.4.36a9.14 9.14 0 0 1-2.88 1.1A4.52 4.52 0 0 0 16.11 0c-2.5 0-4.51 2.05-4.51 4.57 0 .36.04.71.12 1.04A12.94 12.94 0 0 1 3.14.84a4.64 4.64 0 0 0-.61 2.3c0 1.59.8 3 2.02 3.83a4.49 4.49 0 0 1-2.05-.57v.06c0 2.23 1.55 4.09 3.6 4.51a4.55 4.55 0 0 1-2.04.08 4.52 4.52 0 0 0 4.22 3.16A9.05 9.05 0 0 1 1 19.54a12.94 12.94 0 0 0 7.29 2.17c8.76 0 13.55-7.41 13.55-13.84 0-.21 0-.42-.02-.63A9.86 9.86 0 0 0 23 3z"
              />
            </svg>
          </Link>

        <!-- Navigation - This div will grow to fill available space -->
        <div class="flex flex-col flex-grow">
          <div class="mt-5 px-2">
            <div class="flex flex-col space-y-4">

              <Link :href="route('tweet.index')"
                :class="[isActive('/tweet').value ? 'bg-gray-800 text-blue-300' : '', 'group flex items-center px-4 py-2 text-base leading-6 font-semibold rounded-full hover:bg-gray-800 hover:text-blue-300']">
              <svg class="mr-4 h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10M9 21h6">
                </path>
              </svg>
              {{ $t('home') }}
              </Link>

              <Link :href="route('tweet.trending')"
                class="group flex items-center px-4 py-2 text-base leading-6 font-semibold rounded-full hover:bg-gray-800 hover:text-blue-300">
              <svg class="mr-4 h-6 w-6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" viewBox="0 0 24 24">
                <path d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
              </svg>
              {{ $t('explore') }}
              </Link>

              <Link :href="route('notify.index')"
                class="relative group flex items-center px-4 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-800 hover:text-blue-300">
              <svg class="mr-4 h-6 w-6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" viewBox="0 0 24 24">
                <path
                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                </path>
              </svg>
              {{ $t('notifications') }}
              </Link>

              <Link :href="route('chat.index')"
                class="relative group flex items-center px-4 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-800 hover:text-blue-300 transition-all duration-300">
              <svg class="mr-4 h-6 w-6 text-white group-hover:text-gray-200 transition-colors duration-300" fill="none"
                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                viewBox="0 0 24 24">
                <path
                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                </path>
              </svg>
              <span class="text-lg font-semibold text-white">{{ $t('messages') }}</span>
              </Link>

              <Link :href="route('bookmarks.index')"
                :class="[isActive('/bookmarks').value ? 'bg-gray-800 text-blue-300' : '', 'group flex items-center px-4 py-2 text-base leading-6 font-semibold rounded-full hover:bg-gray-800 hover:text-blue-300']">
              <svg class="mr-4 h-6 w-6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" viewBox="0 0 24 24">
                <path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
              </svg>
              {{ $t('bookmarks') }}
              </Link>

              <Link :href="route('profile.index')"
                :class="[isActive('/profile').value ? 'bg-gray-800 text-blue-300' : '', 'group flex items-center px-4 py-2 text-base leading-6 font-semibold rounded-full hover:bg-gray-800 hover:text-blue-300']">
              <svg class="mr-4 h-6 w-6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" viewBox="0 0 24 24">
                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
              </svg>
              {{ $t('profile') }}
              </Link>
        <Link
          href="{{ route('logout') }}"
          method="post"
          as="button"
          class="bg-blue-400 hover:bg-blue-500 w-full mt-5 text-white font-bold py-2 px-4 rounded-full"
        >
          {{ $t('logout') }}
        </Link>

            </div>
          </div>
        </div>

        <!-- Language Switch - Now positioned at the bottom -->  
<div class="relative flex items-center justify-between mt-auto mb-4" dir="rtl" style="width: 100%;">
  <!-- Language switcher -->
  <div class="inline-block text-right group relative">
    <button
      @click="toggleDropdown"
      class="flex justify-between items-center rounded-md shadow-sm px-4 py-2 bg-blue-400 hover:bg-blue-500 text-sm font-medium text-gray-700 cursor-pointer"
    >
  <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 50 50">
<path d="M 22.205078 2 A 1.0001 1.0001 0 0 0 21.21875 2.8378906 L 20.246094 8.7929688 C 19.076509 9.1331971 17.961243 9.5922728 16.910156 10.164062 L 11.996094 6.6542969 A 1.0001 1.0001 0 0 0 10.708984 6.7597656 L 6.8183594 10.646484 A 1.0001 1.0001 0 0 0 6.7070312 11.927734 L 10.164062 16.873047 C 9.583454 17.930271 9.1142098 19.051824 8.765625 20.232422 L 2.8359375 21.21875 A 1.0001 1.0001 0 0 0 2.0019531 22.205078 L 2.0019531 27.705078 A 1.0001 1.0001 0 0 0 2.8261719 28.691406 L 8.7597656 29.742188 C 9.1064607 30.920739 9.5727226 32.043065 10.154297 33.101562 L 6.6542969 37.998047 A 1.0001 1.0001 0 0 0 6.7597656 39.285156 L 10.648438 43.175781 A 1.0001 1.0001 0 0 0 11.927734 43.289062 L 16.882812 39.820312 C 17.936999 40.39548 19.054994 40.857928 20.228516 41.201172 L 21.21875 47.164062 A 1.0001 1.0001 0 0 0 22.205078 48 L 27.705078 48 A 1.0001 1.0001 0 0 0 28.691406 47.173828 L 29.751953 41.1875 C 30.920633 40.838997 32.033372 40.369697 33.082031 39.791016 L 38.070312 43.291016 A 1.0001 1.0001 0 0 0 39.351562 43.179688 L 43.240234 39.287109 A 1.0001 1.0001 0 0 0 43.34375 37.996094 L 39.787109 33.058594 C 40.355783 32.014958 40.813915 30.908875 41.154297 29.748047 L 47.171875 28.693359 A 1.0001 1.0001 0 0 0 47.998047 27.707031 L 47.998047 22.207031 A 1.0001 1.0001 0 0 0 47.160156 21.220703 L 41.152344 20.238281 C 40.80968 19.078827 40.350281 17.974723 39.78125 16.931641 L 43.289062 11.933594 A 1.0001 1.0001 0 0 0 43.177734 10.652344 L 39.287109 6.7636719 A 1.0001 1.0001 0 0 0 37.996094 6.6601562 L 33.072266 10.201172 C 32.023186 9.6248101 30.909713 9.1579916 29.738281 8.8125 L 28.691406 2.828125 A 1.0001 1.0001 0 0 0 27.705078 2 L 22.205078 2 z M 23.056641 4 L 26.865234 4 L 27.861328 9.6855469 A 1.0001 1.0001 0 0 0 28.603516 10.484375 C 30.066026 10.848832 31.439607 11.426549 32.693359 12.185547 A 1.0001 1.0001 0 0 0 33.794922 12.142578 L 38.474609 8.7792969 L 41.167969 11.472656 L 37.835938 16.220703 A 1.0001 1.0001 0 0 0 37.796875 17.310547 C 38.548366 18.561471 39.118333 19.926379 39.482422 21.380859 A 1.0001 1.0001 0 0 0 40.291016 22.125 L 45.998047 23.058594 L 45.998047 26.867188 L 40.279297 27.871094 A 1.0001 1.0001 0 0 0 39.482422 28.617188 C 39.122545 30.069817 38.552234 31.434687 37.800781 32.685547 A 1.0001 1.0001 0 0 0 37.845703 33.785156 L 41.224609 38.474609 L 38.53125 41.169922 L 33.791016 37.84375 A 1.0001 1.0001 0 0 0 32.697266 37.808594 C 31.44975 38.567585 30.074755 39.148028 28.617188 39.517578 A 1.0001 1.0001 0 0 0 27.876953 40.3125 L 26.867188 46 L 23.052734 46 L 22.111328 40.337891 A 1.0001 1.0001 0 0 0 21.365234 39.53125 C 19.90185 39.170557 18.522094 38.59371 17.259766 37.835938 A 1.0001 1.0001 0 0 0 16.171875 37.875 L 11.46875 41.169922 L 8.7734375 38.470703 L 12.097656 33.824219 A 1.0001 1.0001 0 0 0 12.138672 32.724609 C 11.372652 31.458855 10.793319 30.079213 10.427734 28.609375 A 1.0001 1.0001 0 0 0 9.6328125 27.867188 L 4.0019531 26.867188 L 4.0019531 23.052734 L 9.6289062 22.117188 A 1.0001 1.0001 0 0 0 10.435547 21.373047 C 10.804273 19.898143 11.383325 18.518729 12.146484 17.255859 A 1.0001 1.0001 0 0 0 12.111328 16.164062 L 8.8261719 11.46875 L 11.523438 8.7734375 L 16.185547 12.105469 A 1.0001 1.0001 0 0 0 17.28125 12.148438 C 18.536908 11.394293 19.919867 10.822081 21.384766 10.462891 A 1.0001 1.0001 0 0 0 22.132812 9.6523438 L 23.056641 4 z M 25 17 C 20.593567 17 17 20.593567 17 25 C 17 29.406433 20.593567 33 25 33 C 29.406433 33 33 29.406433 33 25 C 33 20.593567 29.406433 17 25 17 z M 25 19 C 28.325553 19 31 21.674447 31 25 C 31 28.325553 28.325553 31 25 31 C 21.674447 31 19 28.325553 19 25 C 19 21.674447 21.674447 19 25 19 z"></path>
</svg>
    </button>

    <div
      v-if="dropdownOpen"
      class="absolute right-0 bottom-full mb-1 w-48 bg-white rounded-md shadow-lg z-50"
       style="bottom: 100%;"
    >
      <button
        @click="changeLanguage('ar')"
        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
      >
        {{ $t('arabic') }}
      </button>
      <button
        @click="changeLanguage('en')"
        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
      >
        {{ $t('english') }}
      </button>
    </div>
  </div>

  <!-- User Info -->
<Link
  :href="route('profile.index', { id: $page.props.authUser.id })"
  class="flex items-center hover:bg-gray-800 rounded-full px-4 py-3 cursor-pointer"
>
  <img :src="$page.props.authUser.image_url" class="h-10 w-10 m-5 rounded-full" alt="User Image" />
  <div class="ml-3 text-left">
    <p class="text-base font-medium text-white m-3">{{ $page.props.authUser.name }}</p>
  </div>
</Link>
</div>

      </div>
      
    </div>
  </aside>
  
</template>
<script setup>
import moment from 'moment'
import 'moment/locale/ar'
import { computed } from 'vue'
import {  usePage } from '@inertiajs/vue3'
import { Link } from '@inertiajs/inertia-vue3'
import { ref } from 'vue'
import { useI18n } from 'vue-i18n'
import Cookies from 'js-cookie'

const page = usePage()

// دالة لفحص إذا كان الرابط نشط حسب المسار الحالي
function isActive(path) {
  return computed(() => page.url ? page.url.startsWith(path) : false)
}


const { locale } = useI18n()
const dropdownOpen = ref(false)

function toggleDropdown() {
  dropdownOpen.value = !dropdownOpen.value
}

function changeLanguage(lang) {
  locale.value = lang
  Cookies.set('locale', lang, { expires: 365 }) 
  dropdownOpen.value = false
    moment.locale(lang)  // حدث لغة moment كمان
}
</script>
