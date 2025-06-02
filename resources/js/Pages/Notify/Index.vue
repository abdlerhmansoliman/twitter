<template>
  <MainLayout>
    <div class="max-w-2xl text-white mx-auto p-5 rounded-lg shadow">
      <h2 class="text-xl font-bold mb-4">{{ $t('notifications') }}</h2>

 
      <div v-if="items.length > 0">
        <ul>
          <li
            v-for="(notification, index) in items"
            :key="index + '-' + notification.id"
            class="border-b pb-3 text-xl"
          >
            <Link
              :href="getNotificationLink(notification)"
              class="block p-3 hover:bg-gray-100 rounded transition text-black"
            >
              <p>{{ notification.data.message }}</p>
              <span class="text-gray-500 text-sm">
                {{ moment(notification.created_at).fromNow() }}
              </span>
            </Link>
          </li>
        </ul>

        <div ref="last" class="h-16 mt-6"></div>
      </div>

      <div v-else>
        <p class="text-gray-500">{{ $t('no notifications') }}</p>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import { useIntersectionObserver } from '@vueuse/core';
import { Inertia } from '@inertiajs/inertia';
import { ref } from 'vue';
import MainLayout from '@/Layout/main.vue';
import moment from '../../moment';
import { Link } from '@inertiajs/inertia-vue3';
import { useI18n } from 'vue-i18n';
import { watch } from 'vue';

const { locale } = useI18n();

const props = defineProps({
  notifications: Object,
  unreadCount: Number,
});

// دالة تولد الرابط بناءً على نوع الإشعار
function getNotificationLink(notification) {
  switch (notification.type) {
    case 'App\\Notifications\\NewTweetNotification':
      return route('tweet.show', { id: notification.data.tweet_id });

    case 'App\\Notifications\\FollowNotification':
      return route('profile.show', { username: notification.data.username });

    case 'App\\Notifications\\ReplyNotification':
      return route('tweet.show', { id: notification.data.tweet_id });
    case 'App\\Notifications\\PostLiked':
      return route('tweet.show', { id: notification.data.tweet_id });
    default:
      return '#';
  }
}

const items = ref([...props.notifications.data]);
const currentPage = ref(props.notifications.current_page);
const lastPage = ref(props.notifications.last_page);
const loading = ref(false);

const loadMore = () => {

  if (loading.value || currentPage.value >= lastPage.value) return;

  loading.value = true;

  Inertia.visit(route('notify.index'), {
    method: 'get',
    data:{page:currentPage.value+1},
    preserveScroll: true,
    preserveState: true,
    replace: true,
    preserveUrl: false,
    // only: ['notifications'],
onSuccess: (pageProps) => {
  const newItems = pageProps.props.notifications.data;
  items.value = [...items.value, ...newItems];
  currentPage.value = pageProps.props.notifications.current_page;
  lastPage.value = pageProps.props.notifications.last_page;
  window.history.replaceState({}, '', route('notify.index'));
},
    onFinish: () => {
      loading.value = false;
    }
  });
};

// عنصر المراقبة
const last = ref(null);

useIntersectionObserver(last, ([{ isIntersecting }]) => {

  if (isIntersecting) loadMore();
}, {
  threshold:0.5,
});
watch(items, (newVal) => {
});
</script>
