<script setup>
import { moment } from '@/i18n'import MainLayout from '@/Layout/main.vue';
import { Link } from '@inertiajs/inertia-vue3';
import Posts from '../../Components/Posts.vue';

const props = defineProps({
    users: Array,
    posts: Array,
    user:Object
})

</script>


<template>
  <MainLayout>
     <main class="w-full max-w-3xl  mx-auto p-6 space-y-8">
  <h2 class="text-2xl font-bold text-white">Search Results</h2>

  <div v-if="users || posts">
    <!-- Users -->
    <div v-if="users?.length">
      <h3 class="text-xl font-semibold text-white mb-4">Users</h3>
      <div class="space-y-4">
        <div v-for="user in users" :key="user.id" class="flex items-center space-x-4 p-4 bg-blue-900 rounded-lg shadow">
          <img class="h-10 w-10 rounded-full" :src="user.image_url" alt="User Image" />
          <div>
            <p class="text-white font-medium">{{ user.name }}</p>
            <p class="text-gray-400 text-sm">
              @{{ user.name }} — {{ dayjs(user.created_at).format('D MMMM') }}
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Tweets -->
    <div v-if="posts?.length" class="mt-8">
      <h3 class="text-xl font-semibold text-white mb-4">Tweets</h3>
      <div class="space-y-4 w-1/2">
        <Posts
          v-for="post in posts"
          :key="post.id"
          :post="post"
          :user="user"
        />
      </div>
    </div>
  </div>

  <div v-else>
    <h3 class="text-lg text-gray-300 text-center">There are no results</h3>
  </div>
</main>
</MainLayout>
</template>