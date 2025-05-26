<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import Posts from '../../Components/Posts.vue';
import MainLayout from '@/Layout/main.vue';
defineProps({
    user: Object,
    hashtags: {
      type: Array,
      default: () => []
    },
    trending: {
      type: Array,
      default: () => []
    },
    filter: {
      type: String,
      default: ''
    }
});



</script>


<template>
  <MainLayout>
  <div class="min-h-screen text-white" style="background-color: #15202b;">
    <div class="flex">
      <div class="w-3/5 border border-gray-600 h-auto border-t-0">
        <hr class="border-gray-800 border-2" />

        <div class="flex justify-center space-x-4 p-3 border-b border-gray-700">
          <Link
            :href="route('tweet.trending')"
            class="text-gray-500 hover:text-white font-semibold text-sm px-4 py-2 rounded-lg transition"
          >
            {{ $t('explore') }}
          </Link>

<Link
  :href="route('tweet.trending', { filter: 'top_hashtags' })"
  class="text-gray-500 hover:text-white font-semibold text-sm px-4 py-2 rounded-lg transition"
>
  #{{ $t('hashtags') }}
</Link>
        </div>

        <div v-if="hashtags.length > 0">
          <div v-for="hashtag in hashtags" :key="hashtag.id" class="p-3 border-b border-gray-700">
            <Link
              :href="`/hashtag/${hashtag.name}`"
              class="text-blue-500 hover:underline"
            >
              #{{ hashtag.name }}
            </Link>
            <span class="text-gray-500 text-sm">({{ hashtag.posts_count }} posts)</span>
          </div>
        </div>

        <div v-else>
          <Posts
            v-for="post in trending"
            :key="post.id"
            :post="post"
          />
        </div>
      </div>
    </div>
  </div>
  </MainLayout>
  
</template>
