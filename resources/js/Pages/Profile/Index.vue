

<template>
  <MainLayout>
  <main role="main w-full">
    <div class="flex " >
      <section class="border border-y-0 border-gray-800 w-full"  >
        <!-- Nav back -->
        <div v-if="$page.props.flash.message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
          <strong class="font-bold bg-green-100 text-green-800 p-3 rounded mb-4">{{ $page.props.flash.message }}</strong>
          <span class="block sm:inline">{{ successMessage }}</span>
        </div>
        <div class="flex justify-start">
          <div class="px-4 py-2 mx-2">
            <Link :href="route('tweet.index')" class=" text-2xl font-medium rounded-full text-blue-400 hover:bg-gray-800 hover:text-blue-300 float-right">
              <svg class="m-2 h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <g>
                  <path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z"></path>
                </g>
              </svg>
            </Link>
          </div>
          <div class="mx-2">
            <h2 class="mb-0 text-xl font-bold text-white">{{user.name}}</h2>

            <!-- <p class="mb-0 w-48 text-xs text-gray-400">{{user.posts().count()}} {{$t('tweets')}}</p> -->

          </div>
        </div>

        <hr class="border-gray-800">

        <!-- User card -->
        <div>
          <div class="w-full bg-cover bg-no-repeat bg-center"     :style="{ height: '200px', backgroundImage: `url('${user.cover_url}')` }">
            <img class="opacity-0 w-full h-full" src="https://pbs.twimg.com/profile_banners/2161323234/1585151401/600x200" alt="">
          </div>
          <div class="p-4">
            <div class="relative flex w-full">
              <!-- Avatar -->
              <div class="flex flex-1">
                <div style="margin-top: -6rem;">
                  <div style="height:9rem; width:9rem;" class="md rounded-full relative avatar">
                    <img style="height:9rem; width:9rem;" class="md rounded-full relative border-4 border-gray-900" :src=" user.image_url " alt="Profile Image">
                    <div class="absolute"></div>
                  </div>
                </div>
              </div>
              <!-- Follow Button -->
  <div class="flex flex-col text-right">
    <!-- إذا كان المستخدم صاحب الحساب -->
    <Link
      v-if="isOwner"
      :href="route('profile.edit')"
      class="flex justify-center whitespace-nowrap focus:outline-none focus:ring max-w-max border bg-transparent border-blue-500 text-blue-500 hover:border-blue-800  items-center hover:shadow-lg font-bold py-2 px-4 rounded-full ml-auto"
    >
      Edit Profile
    </Link>

    <!-- إذا لم يكن هو -->
     
    <button
      v-else
      @click="toggleFollow"
      :disabled="loading"
      class="flex justify-center whitespace-nowrap focus:outline-none focus:ring max-w-max border bg-transparent border-blue-500 text-blue-500 hover:border-blue-800 flex items-center hover:shadow-lg font-bold py-2 px-4 rounded-full ml-auto"
    >
      {{ following ? $t('unfollow') : $t('follow') }}
    </button>
  </div>
            </div>

            <!-- Profile info -->
            <div class="space-y-1 justify-center w-full mt-3 ml-3">
              <!-- User basic -->
              <div>
                <h2 class="text-xl leading-6 font-bold text-white">{{user.name}}</h2>
                <p class="text-sm leading-5 font-medium text-gray-600">@ {{user.name}}</p>
              </div>
              <!-- Description and others -->
              <div class="mt-3 text-white">
                <p class="leading-tight mb-2">{{user.bio}}</p>
                <div class="text-gray-600 flex">
                  <span class="flex mr-2">
                    <svg viewBox="0 0 24 24" class="h-5 w-5 paint-icon">
                      <g>
                      </g>
                    </svg>
                    <a :href="user.link" target="#" class="leading-5 ml-1 text-blue-400">{{user.link}}</a>
                  </span>
                </div>
                <span class="flex mr-2">
                  <svg viewBox="0 0 24 24" class="h-5 w-5 paint-icon">
                    <g>
                      <circle cx="7.032" cy="8.75" r="1.285"></circle>
                      <circle cx="7.032" cy="13.156" r="1.285"></circle>
                      <circle cx="16.968" cy="8.75" r="1.285"></circle>
                      <circle cx="16.968" cy="13.156" r="1.285"></circle>
                      <circle cx="12" cy="8.75" r="1.285"></circle>
                      <circle cx="12" cy="13.156" r="1.285"></circle>
                      <circle cx="7.032" cy="17.486" r="1.285"></circle>
                      <circle cx="12" cy="17.486" r="1.285"></circle>
                    </g>
                  </svg>
                  <span class="leading-5 mt-3 ml-1">{{moment(user.created_at).format('DD/MM/YYYY')}}</span>
                </span>
              </div>
              <div v-if="isOwner" class="pt-3 flex justify-start items-start w-full divide-x divide-gray-800 divide-solid">
                <div class="text-center px-3">
                  <Link :href="route('profile.show', {id : user.id})" class="text-gray-600">

                    <span class="font-bold text-white">{{posts.length}}</span>
                    {{$t('tweets')}}
                  </Link>
                </div>
              <div class="text-center px-3">
                <Link :href="route('profile.following', { id: user.id })" class="text-gray-600">
                  <span class="font-bold text-white">{{ user.following_count }}</span>
                  {{ $t('following') }}
                </Link>
              </div>
              <div class="text-center px-3">
                <Link :href="route('profile.followers', { id: user.id })" class="text-gray-600">
                  <span class="font-bold text-white">{{ user.follower_count }}</span>
                  {{ $t('follower') }}
                </Link>
              </div>
                <div class="text-center px-3">
                  <Link :href="route('profile.show', { id: user.id, filter: 'likes' })" class="text-gray-600">
                    <span class="font-bold text-white">{{user.liked_posts_count }}</span>
                  {{$t('likes')}}
                  </Link>
                </div>
              </div>


              <div v-else class="pt-3 flex justify-start items-start w-full divide-x divide-gray-800 divide-solid">
                <div class="text-center px-3">

                    <span class="font-bold text-white">{{posts.length}}</span>
                    {{$t('tweets')}}
                </div>
                <div class="text-center px-3">
                    {{ following.length ??0 }}
                  <span class="text-gray-600">{{$t('following')}}</span>
                </div>
                <div class="text-center  px-3">
                    {{ user.followerCount ?? 0 }}
                  <span class="text-gray-600 ">
                    {{$t('follower')}}
                </span>
                </div>

              </div>
            </div>
          </div>
          <hr class="border-gray-800">
        </div>

        <ul v-for="post in posts" class="list-none">
            <Posts :post="post" :user="user" :key="post.id" />
        </ul>
            <div ref="loadMoreTrigger" class="py-6 text-center text-gray-400" v-if="page < lastPage">
            </div>
        <hr class="border-gray-800">
      </section>

      <aside class="w-2/5 h-12 position-relative">
        <!-- Aside menu (right side) -->
        <div style="max-width:350px;">
          <div class="overflow-y-auto fixed h-screen">
            <div class="relative text-gray-300 w-80 p-5">
              <button type="submit" class="absolute ml-4 mt-3 mr-4">
                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 56.966 56.966" xml:space="preserve" width="512px" height="512px">
                </svg>
              </button>
            </div>
          </div>
        </div>
      </aside>
    </div>
  </main>
  </MainLayout>
</template>

<script setup>

import { useIntersectionObserver } from '@vueuse/core';
import { defineProps, ref  } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import { Link } from '@inertiajs/inertia-vue3'
import dayjs from 'dayjs'
import moment from '../../moment'
import { useI18n } from 'vue-i18n'

import MainLayout from '@/Layout/main.vue'
import Posts from '../../Components/Posts.vue';
const props = defineProps({
    user: Object,
    isOwner: Boolean,
    posts: Object,
    filter: String,
    isFollowing: Boolean,
    likedCount: Number
   })

const posts = ref([...props.posts.data]);
const page = ref(props.posts.current_page);
const lastPage = ref(props.posts.last_page);
const loading = ref(false);
const loadMoreTrigger = ref(null);
function loadMore() {
  if (loading.value || page.value >= lastPage.value) return;

  loading.value = true;
  const nextPage = page.value + 1;
  Inertia.get(route('profile.index'), { page: nextPage }, {
    preserveScroll: true,
    preserveState: true,
    onSuccess: (pageProps) => {
      posts.value.push(...pageProps.props.posts.data);
      page.value = pageProps.props.posts.current_page;
      lastPage.value = pageProps.props.posts.last_page;

    },
    onFinish: () => {
      loading.value = false;
    }
  });
}

useIntersectionObserver(
  loadMoreTrigger,
  ([{ isIntersecting }]) => {
    if (isIntersecting) {
      loadMore();
    }
  },
  {
    threshold:  0.1,
  }
);

const { locale } = useI18n();

const following = ref(props.isFollowing)

function toggleFollow() {
  loading.value = true

  const routeName = following.value ? 'user.unfollow' : 'user.follow'

  Inertia.post(route(routeName, { user: props.user.id }), {}, {
    onSuccess: () => {
      following.value = !following.value
      loading.value = false
    },
    onError: () => {
      loading.value = false
    }
  })
}

</script>
<style>
.overflow-y-auto::-webkit-scrollbar, .overflow-y-scroll::-webkit-scrollbar, .overflow-x-auto::-webkit-scrollbar, .overflow-x::-webkit-scrollbar, .overflow-x-scroll::-webkit-scrollbar, .overflow-y::-webkit-scrollbar, body::-webkit-scrollbar {
display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.overflow-y-auto, .overflow-y-scroll, .overflow-x-auto, .overflow-x, .overflow-x-scroll, .overflow-y, body {
-ms-overflow-style: none;
/* IE and Edge */
scrollbar-width: none;
/* Firefox */
}

.bg-dim-700 {
--bg-opacity: 1;
background-color: #192734;
}

html, body {
margin: 0;
background-color: #15202b;
}

svg.paint-icon {
fill: currentcolor;
}

    </style>