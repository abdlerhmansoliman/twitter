<script setup>
import { moment } from '@/i18n'import relativeTime from 'dayjs/plugin/relativeTime'
import MainLayout from '@/Layout/main.vue';
dayjs.extend(relativeTime)

defineProps({
    notifications: Array,
    unreadCount: Number
})
</script>

<template>
    <MainLayout>
<div class="max-w-2xl mx-auto p-5 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">{{ $t('notifications') }}</h2>
    <div v-if="notifications.length > 0">
        <ul>
            <li v-for="notification in notifications" :key="notification.id" class="border-b p-3">
                <p>{{ notification.data.message }}</p>
                <span class="text-gray-500 text-sm">{{ dayjs(notification.created_at).fromNow() }}</span>
            </li>
        </ul>
    </div>
    <div v-else>
        <p class="text-gray-500">{{ $t('no notifications') }}</p>
    </div>
</div>
    </MainLayout>
    </template>