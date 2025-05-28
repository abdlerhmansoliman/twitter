<template>
  <header class="text-white py-4 h-auto">
    <div style="width: 275px;">
      <div class="overflow-y-auto fixed h-screen pr-3" style="width: 275px;">
        <!-- Logo -->
  <Link :href="route('tweet.index')" class="inline-block">
    <svg viewBox="0 0 24 24" class="h-8 w-8 text-white ml-3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path
        d="M23 3a10.9 10.9 0 0 1-3.14 1.53A4.48 4.48 0 0 0 22.4.36a9.14 9.14 0 0 1-2.88 1.1A4.52 4.52 0 0 0 16.11 0c-2.5 0-4.51 2.05-4.51 4.57 0 .36.04.71.12 1.04A12.94 12.94 0 0 1 3.14.84a4.64 4.64 0 0 0-.61 2.3c0 1.59.8 3 2.02 3.83a4.49 4.49 0 0 1-2.05-.57v.06c0 2.23 1.55 4.09 3.6 4.51a4.55 4.55 0 0 1-2.04.08 4.52 4.52 0 0 0 4.22 3.16A9.05 9.05 0 0 1 1 19.54a12.94 12.94 0 0 0 7.29 2.17c8.76 0 13.55-7.41 13.55-13.84 0-.21 0-.42-.02-.63A9.86 9.86 0 0 0 23 3z"
      />
    </svg>
  </Link>

        <!-- Navigation -->
        <nav class="mt-5 px-2">
          <nav class="mt-5 px-2">
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
          </nav>
        </nav>

        <!-- Language Switch -->
<div class=" relative  flex items-center justify-between mt-5" dir="rtl" style="width: 100%;">
  <!-- Language switcher -->
  <div class="inline-block text-right group relative">
    <button
      @click="toggleDropdown"
      class="flex justify-between items-center rounded-md shadow-sm px-4 py-2 bg-blue-400 hover:bg-blue-500 text-sm font-medium text-gray-700 cursor-pointer"
    >
      <span>{{ $t('lang') }}</span>
      <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
    </button>

    <div
      v-if="dropdownOpen"
      class="absolute right-0 w-48 bg-white rounded-md shadow-lg mt-1 z-50"
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
    :href="route('profile.index', { id: $page.props.user.id })"
    class="flex items-center hover:bg-gray-800 rounded-full px-4 py-3 cursor-pointer"
  >
    <img :src="$page.props.user.image_url" class="h-10 w-10 m-5  rounded-full" alt="User Image" />
    <div class="ml-3 text-left">
      <p class="text-base font-medium text-white m-3" >{{ $page.props.user.name }}</p>
    </div>
  </Link>
</div>

      </div>
      
    </div>
  </header>
  
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
