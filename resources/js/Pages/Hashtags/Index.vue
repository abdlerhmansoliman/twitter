<script setup>
import Posts from '../../Components/Posts.vue';  // مفرد
import MainLayout from '@/Layout/main.vue';
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
  posts: Object,
  user: Object,
  hashtag: Object,
})
</script>

<template>
  <MainLayout>
    <div class="flex justify-center">
      <div class="w-3/5 border border-gray-600 border-t-0">
        <hr class="border-gray-800 border-2" />
        <div class="flex justify-center  p-3 border-b border-gray-700">
          <Link :href="route('tweet.trending', { filter: 'top_hashtags' })" class="text-gray-500 hover:text-white font-semibold text-sm px-4 py-2 rounded-lg transition">
            #Hashtags
          </Link>
        </div>

        <Posts
          v-for="post in posts.data"
          :key="post.id"
          :post="post"
          :user="user"
        />
      </div>
    </div>
  </MainLayout>
</template>
