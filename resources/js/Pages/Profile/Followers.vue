<template>
    <MainLayout>
<div>
  <h2 class="text-xl font-bold mb-4">Followers</h2>
  <ul>
    <li v-for="follower in followers" :key="follower.id" class="mb-2">
      <Link :href="route('profile.show', { id: follower.id })" class="flex items-center space-x-2 hover:bg-gray-800 p-2 rounded">
        <img :src="follower.image_url" class="w-8 h-8 rounded-full" />
        <span class="text-white">{{ follower.name }}</span>
      </Link>
    </li>
  </ul>
</div>
</MainLayout>
</template>

<script setup>
import MainLayout from '@/Layout/main.vue';
defineProps(['followers', 'user'])
</script>
