<template>
    <MainLayout>

<div>
  <h2 class="text-xl font-bold mb-4">Followings</h2>
  <ul>
    <li v-for="following in followings" :key="following.id" class="mb-2">
      <Link :href="route('profile.show', { id: following.id })" class="flex items-center space-x-2 hover:bg-gray-800 p-2 rounded">
        <img :src="following.image_url" class="w-8 h-8 rounded-full" />
        <span class="text-white">{{ following.name }}</span>
      </Link>
    </li>
  </ul>
</div>

</MainLayout>
</template>

<script setup>
import MainLayout from '@/Layout/main.vue';
defineProps(['followings', 'user'])
</script>
