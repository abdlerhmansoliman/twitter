
<template>
  <MainLayout>
    <div class="max-w-2xl text-white mx-auto p-5 rounded-lg shadow">
      <!-- العنوان -->
      <h2 class="text-2xl font-semibold text-white mb-6 border-b border-gray-600 pb-3">
        {{ $t('chat') }}
      </h2>

      <!-- قائمة الرسائل -->
      <div
        class="flex-1 overflow-y-auto p-4 rounded-lg space-y-4 shadow-inner bg-[#253341]"
        style="scrollbar-width: thin; scrollbar-color: #3b82f6 #1e293b"
      >
        <div
          v-for="(msg, index) in allMessages"
          :key="msg.id"
          class="w-full flex"
          :class="msg.sender.id === user.id ? 'justify-end' : 'justify-start'"
          :ref="index === allMessages.length - 1 ? 'last' : null"  
        >
          <!-- باقي عرض الرسالة كما عندك -->
          <div class="flex items-end gap-2 max-w-md">
            <template v-if="msg.sender.id === user.id">
              <div
                class="p-3 rounded-lg break-words bg-blue-600 text-white shadow-md max-w-full whitespace-pre-wrap"
                style="word-break: break-word;"
              >
                {{ msg.message }}
                <div class="text-xs text-blue-200 mt-1 text-right select-none">
                  {{ moment(msg.created_at).format('h:mm A') }}
                </div>
              </div>
              <img
                v-if="msg.sender"
                :src="msg.sender.image_url"
                alt="Avatar"
                class="w-8 h-8 rounded-full select-none"
                draggable="false"
              />
            </template>

            <template v-else>
              <img
                v-if="msg.sender"
                :src="msg.sender.image_url"
                alt="Avatar"
                class="w-8 h-8 rounded-full select-none"
                draggable="false"
              />
              <div
                class="p-3 rounded-lg break-words bg-gray-200 text-gray-900 shadow max-w-full whitespace-pre-wrap"
                style="word-break: break-word;"
              >
                {{ msg.message }}
                <div class="text-xs text-gray-500 mt-1 text-right select-none">
                  {{ moment(msg.created_at).format('h:mm A') }}
                </div>
              </div>
            </template>
          </div>
        </div>
      </div>

      <!-- الفورم والإرسال كما عندك -->
      <form @submit.prevent="submit" class="mt-4 flex gap-2 items-center" autocomplete="off">
        <input
          v-model="form.message"
          type="text"
          class="flex-1 bg-gray-800 text-white border border-gray-600 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400"
          placeholder="اكتب رسالتك هنا..."
          required
          style="caret-color: white;"
          autocomplete="off"
        />

        <button
          type="submit"
          class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg flex items-center justify-center transition-colors duration-200 select-none"
          aria-label="Send message"
        >
          <span>{{ $t('send') }}</span>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5 ml-2"
            viewBox="0 0 20 20"
            fill="currentColor"
          >
            <path
              d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"
            />
          </svg>
        </button>
      </form>
    </div>
  </MainLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { useIntersectionObserver } from '@vueuse/core'
import { ref, watch } from 'vue'
import { Inertia } from '@inertiajs/inertia'

import MainLayout from '@/Layout/main.vue';
import moment from '../../moment'
import { useI18n } from 'vue-i18n'

const { locale } = useI18n();

const props = defineProps({
  messages: Object,
  user: Object,
  receiver: Object
})
const allMessages = ref([...props.messages.data])
const page = ref(props.messages.current_page)
const last = ref(null)    
const loading = ref(false)

function loadMore() {
  if (loading.value) return
  if (page.value >= props.messages.last_page) return 
   loading.value = true
  page.value++

Inertia.get(route('chat.show', props.receiver.id), { page: page.value }, {
  preserveState: true,
  preserveScroll: true,
  onSuccess: (pageProps) => {
    allMessages.value.push(...pageProps.props.messages.data)
    loading.value = false
  },
  onError: () => {
    loading.value = false
    page.value--
  }
})
}
useIntersectionObserver(last, ([{ isIntersecting }]) => {
  if (isIntersecting) {
    loadMore()
  }
})
const form = useForm({
  message: '',
  receiver_id: props.receiver.id,  
});
const submit = () => {
  form.post(route('chat.send'), {
    onSuccess: () => {
      form.reset()
    }
  })
}
</script>

