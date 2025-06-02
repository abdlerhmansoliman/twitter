<template>
  <MainLayout>
    <div class="max-w-2xl text-white mx-auto p-5 rounded-lg shadow">
      <!-- العنوان -->
      <h2 class="text-2xl font-semibold text-white mb-6 border-b border-gray-600 pb-3">
        {{ $t('chat') }}
      </h2>

      <!-- قائمة الرسائل -->
      <div
        ref="messagesContainer"
        class="p-4 rounded-lg space-y-4 shadow-inner bg-[#253341] overflow-y-auto"
        style="max-height: 500px; scrollbar-width: thin; scrollbar-color: #3b82f6 #1e293b;"
        @scroll="handleScroll"
      >
        <!-- Loading indicator for older messages -->
        <div v-if="loading" class="text-center py-2">
          <div class="inline-block animate-spin rounded-full h-6 w-6 border-b-2 border-blue-500"></div>
          <p class="text-sm text-gray-400 mt-2">Loading older messages...</p>
        </div>

        <!-- Observer element for infinite scroll -->
        <div ref="topObserver" class="h-1"></div>

        <div
          v-for="(msg, index) in displayMessages"
          :key="msg.id"
          class="w-full flex"
          :class="msg.sender.id === user.id ? 'justify-end' : 'justify-start'"
        >
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

      <!-- الفورم والإرسال -->
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
          :disabled="form.processing"
          class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg flex items-center justify-center transition-colors duration-200 select-none disabled:opacity-50"
          aria-label="Send message"
        >
          <span>{{ form.processing ? 'Sending...' : $t('send') }}</span>
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
import { ref, onMounted, nextTick, watch, computed } from 'vue'
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

// Reactive data
const allMessages = ref([])
const loading = ref(false)
const messagesContainer = ref(null)
const topObserver = ref(null)
const isFirstLoad = ref(true)

// Computed property لضمان ترتيب صحيح للرسائل
const displayMessages = computed(() => {
  return [...allMessages.value].sort((a, b) => new Date(a.created_at) - new Date(b.created_at))
})

// Form setup
const form = useForm({
  message: '',
  receiver_id: props.receiver.id,  
});

// Initialize messages
function initializeMessages() {
  if (props.messages && props.messages.data) {
    allMessages.value = [...props.messages.data]
  }
}

// Load more messages function
function loadMore() {
  if (loading.value) return
  if (!hasMoreMessages()) return
  
  loading.value = true
  const nextPage = props.messages.current_page + 1

  Inertia.visit(route('chat.show', props.receiver.id), {
    method: 'get',
    data: { page: nextPage },
    preserveState: true,
    preserveScroll: true,
    preserveUrl: false,
    only: ['messages'],
    replace: true,
    onSuccess: (page) => {
      const container = messagesContainer.value
      const oldScrollHeight = container.scrollHeight
      
      if (page.props.messages.data.length > 0) {
        allMessages.value.unshift(...page.props.messages.data)
      }
      
      window.history.replaceState({}, '', route('chat.show', props.receiver.id))
      
      nextTick(() => {
        const newScrollHeight = container.scrollHeight
        container.scrollTop = newScrollHeight - oldScrollHeight
        loading.value = false
      })
    },
    onError: () => {
      loading.value = false
    }
  })
}
// Check if there are more messages to load
function hasMoreMessages() {
  return props.messages.current_page < props.messages.last_page
}

// Intersection observer for infinite scroll
useIntersectionObserver(topObserver, ([{ isIntersecting }]) => {
  if (isIntersecting && !isFirstLoad.value && hasMoreMessages()) {
    loadMore()
  }
})

// Handle manual scroll for infinite scroll
function handleScroll() {
  const container = messagesContainer.value
  if (container.scrollTop <= 50 && !loading.value && hasMoreMessages()) {
    loadMore()
  }
}

// Submit new message
const submit = () => {
  form.post(route('chat.send'), {
    preserveState: true,
    replace: true,
    onSuccess: () => {
      form.reset()
      
      // Reload to get the new message
      Inertia.visit(route('chat.show', props.receiver.id), {
        method: 'get',
        preserveState: true,
        only: ['messages'],
        replace: true,
        onSuccess: (page) => {
          // Check for new messages
          const newMessages = page.props.messages.data
          const lastCurrentMessage = allMessages.value[allMessages.value.length - 1]
          
          // Add only truly new messages
          const messagesToAdd = newMessages.filter(newMsg => 
            !allMessages.value.some(existingMsg => existingMsg.id === newMsg.id)
          )
          
          if (messagesToAdd.length > 0) {
            allMessages.value.push(...messagesToAdd)
            nextTick(() => scrollToBottom())
          }
        }
      })
    }
  })
}

// Scroll to bottom function
function scrollToBottom() {
  const container = messagesContainer.value
  if (container) {
    container.scrollTop = container.scrollHeight
  }
}

// Watch for props changes
watch(() => props.messages, (newMessages) => {
  if (newMessages && newMessages.data) {
    // Only update if it's the first page (new messages)
    if (newMessages.current_page === 1) {
      allMessages.value = [...newMessages.data]
      nextTick(() => scrollToBottom())
    }
  }
}, { deep: true })

// Mounted lifecycle
onMounted(() => {
  initializeMessages()
  
  // Scroll to bottom on first load
  nextTick(() => {
    scrollToBottom()
    isFirstLoad.value = false
  })
})
</script>