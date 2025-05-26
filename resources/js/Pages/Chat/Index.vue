<script setup>
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
  chatUsers: Array,
  user: Object
})

</script>

<template>
    
  <main class="flex-1 min-h-screen border-r border-l border-gray-700 mx-auto max-w-4xl p-4">
    <h2 class="text-xl font-bold mb-4">{{ $t('chats') }}</h2>

    <div v-if="chatUsers.length">
      <div v-for="chatUser in chatUsers" :key="chatUser.id">
        <Link
          :href="route('chat.show', chatUser.id)"
          class="block p-3 hover:bg-gray-800 rounded mb-2 transition-all duration-200"
        >
          <div class="flex items-center">
            <img
              :src="chatUser.image_url ?? 'https://via.placeholder.com/40'"
              alt="avatar"
              class="w-10 h-10 rounded-full mr-3"
            />
            <div>
              <p class="font-semibold">{{ chatUser.name }}</p>
            </div>
          </div>
        </Link>
      </div>
    </div>

    <p v-else class="text-gray-400">
      {{ $t('there is no chats') }}
    </p>
  </main>
</template>
