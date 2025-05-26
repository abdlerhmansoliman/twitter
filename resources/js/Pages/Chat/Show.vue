<script setup>
import { usePage } from '@inertiajs/vue3'
import dayjs from 'dayjs'

defineProps({
  messages: Array,
  user: Object,
  receiver: Object
})

</script>

<template>
  <div class="flex-1 flex flex-col w-96 p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-semibold text-white mb-6">{{ $t('chat') }}</h2>

    <div class="flex-1 overflow-y-auto p-6 rounded-lg space-y-4 shadow-inner bg-[#253341]">
      <div
        v-for="(msg, index) in messages"
        :key="msg.id"
        :class="[
          'w-full flex',
          index % 2 === 0 ? 'justify-end' : 'justify-start' 
        ]"
      >
        <div class="flex items-end gap-2 max-w-md">

            <img
            v-if="msg.sender"
            :src="msg.sender.image_url"
            alt="Avatar"
            class="w-8 h-8 rounded-full"
            :class="index % 2 === 0 ? 'order-2 ml-2' : 'order-1 mr-2'"
          />

          <div
            :class="[
              'p-3 rounded-lg break-words',
              index % 2 === 0 ? 'bg-blue-600 text-white order-1' : 'bg-gray-200 text-black order-2'
            ]"
          >
            {{ msg.message }}
            <div class="text-xs text-gray-400 mt-1 text-right">
              {{ dayjs(msg.created_at).format('h:mm A') }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <form
      :action="route('chat.send')"
      method="POST"
      class="flex gap-3 mt-4"
    >
      <input type="hidden" name="_token" />
      <input type="hidden" name="receiver_id" :value="receiver.id" />
      <input
        type="text"
        name="message"
        class="flex-1 bg-[#2d3748] text-white border border-gray-600 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
        :placeholder="$t('write message')"
      />
      <button
        type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg flex items-center justify-center transition-colors duration-200"
      >
        <span>{{ $t('send') }}</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
          <path
            d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"
          />
        </svg>
      </button>
    </form>
  </div>
</template>

