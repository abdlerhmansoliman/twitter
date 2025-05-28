

<template>
<MainLayout>
  <div class="container mx-auto px-4 py-6 max-w-4xl">
    <div>
      <title>{{ $t('tweet') }}</title>
    </div>

    <Posts :post="post" :user="user" />

    <div class="ml-4 w-full max-w-2xl mt-6">
      <div class="comments-section mt-5 bg-gray-800 rounded-lg p-4 shadow-md">
        <form @submit.prevent="submit" enctype="multipart/form-data" class="mb-6">
          <input
            v-model="form.body"
            type="text"
            name="post"
            class="bg-gray-900 text-gray-300 font-medium text-sm w-full p-3 rounded-lg border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
            placeholder="Write a comment..."
          />
          <input type="hidden" v-model="form.parent_id" />
          <input type="file" class="mt-3" name="images" multiple ref="fileInput" @change="handleFileUpload" />
          <input v-if="post" type="hidden" name="parent_id" :value="post.id" />
          <div class="flex justify-end mt-4">
            <button
              type="submit"
              class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-full transition"
            >
              {{ $t('replay') }}
            </button>
          </div>
        </form>

        <h3 class="text-gray-300 text-sm font-semibold mb-4">{{ $t('replies') }}</h3>

        <div class="flex flex-col space-y-4">
          <div
            v-for="reply in post.replies"
            :key="reply.id"
            class="comment border-b border-gray-700 pb-4"
          >
            <div class="flex items-center space-x-3 mb-2">
              <strong class="text-white text-xs">{{ reply.user.name }}</strong>
            </div>
            <p class="text-gray-400 text-sm mb-3 whitespace-pre-line">{{ reply.post }}</p>
            <img
              v-if="reply.image"
              :src="`/storage/${reply.image.url}`"
              alt="reply image"
              class="w-48 h-48 object-cover rounded-lg mb-3 shadow-md"
            />
            <small class="text-gray-500 text-[10px] block">
              {{ moment(reply.created_at).format('D MMMM YYYY h:mm A') }}
            </small>
          </div>
        </div>
      </div>
    </div>
  </div>
</MainLayout>

</template>

<script setup>
import { Link , useForm } from '@inertiajs/inertia-vue3';
import Posts from '../../Components/Posts.vue';
import { ref } from 'vue'
import moment from '../../moment'
import { useI18n } from 'vue-i18n'
import MainLayout from '../../Layout/main.vue'
const { locale } = useI18n();
const fileInput = ref(null)
const props=defineProps({
    post:Object,
    user:Object,

})

const form = useForm({
    body: '',
    images: null,
    parent_id: props.post.id ,

})

const handleFileUpload = (event) => {
  form.images = event.target.files[0]; 
};
const submit = () => {
  form.post(route('tweet.store'), {
    forceFormData: true,
    onSuccess: () => {
      form.reset();
    },
    onError: (errors) => {
      console.log(errors);
    },
  });
};
</script>