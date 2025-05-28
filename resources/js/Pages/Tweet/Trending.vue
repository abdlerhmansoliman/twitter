


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
            v-for="post in posts"
            :key="post.id"
            :post="post"
          />
        </div>
             <div ref="loadMoreTrigger" class="py-6 text-center text-gray-400" v-if="page < lastPage">
            تحميل المزيد...
            </div>
      </div>
    </div>
  </div>
  </MainLayout>
  
</template>
<script setup>
import { useIntersectionObserver } from '@vueuse/core';
import { Link } from '@inertiajs/inertia-vue3';
import Posts from '../../Components/Posts.vue';
import MainLayout from '@/Layout/main.vue';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
const props= defineProps({
    user: Object,
    hashtags: {
      type: Array,
      default: () => []
    },
    trending: {
      type: Object,
      default: () => []
    },
    filter: {
      type: String,
      default: ''
    }
});
const posts = ref([...props.trending.data]);
const page = ref(props.trending.current_page);
const lastPage = ref(props.trending.last_page);
const loading = ref(false);
const loadMoreTrigger = ref(null);

function loadMore() {
  if (loading.value || page.value >= lastPage.value) return;

  loading.value = true;
  const nextPage = page.value + 1;
console.log('Loading page:', page.value + 1);
  Inertia.get(route('tweet.trending'), { page: nextPage }, {
    preserveScroll: true,
    preserveState: true,
    onSuccess: (pageProps) => {
      posts.value.push(...pageProps.props.trending.data);
      page.value = pageProps.props.trending.current_page;
      lastPage.value = pageProps.props.trending.last_page;

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


</script>