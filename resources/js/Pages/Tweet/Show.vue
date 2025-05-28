

<template>
  <div>
    <title> {{ $t('tweet') }}</title>
  </div>
    <Posts :post="post" :user="user" />
    <div class="ml-4 w-full max-w-2xl">
      <div class="comments-section mt-5">
        <form @submit.prevent="submit" enctype="multipart/form-data" class="mb-4">
          <input
            v-model="form.body"
            type="text"
            name="post"
            class="bg-gray-900 text-gray-300 font-medium text-sm w-full p-2 rounded-lg border border-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-400"
            placeholder="Write a comment..."
          />
          <input type="hidden" v-model="form.parent_id" />
          <input type="file" class="mt-3" name="images" multiple ref="fileInput" @change="handleFileUpload" />
          <input v-if="post" type="hidden" name="parent_id" :value="post.id" />
          <div class="flex-1">
            <button
              type="submit"
              class="bg-blue-400 mt-3 hover:bg-blue-600  text-white font-bold py-2 px-8 rounded-full mr-8 float-right"
            >
              {{ $t('replay') }}
            </button>
          </div>
        </form>

        <h3 class="text-gray-300 text-sm font-semibold mb-3">{{ $t('replies') }}</h3>

        <div class="flex flex-col space-y-2">
          <div
            v-for="reply in post.replies"
            :key="reply.id"
            class="comment border-b border-gray-700 p-3 text-sm"
          >
            <div class="flex items-center space-x-2 mb-1">
              <strong class="text-white text-xs">{{ reply.user.name }}</strong>
            </div>
            <p class="text-gray-400 text-xs mb-2">{{ reply.post }}</p>
            <img
              v-if="reply.image"
              :src="`/storage/${reply.image.url}`"
              class="w-40 h-40 object-cover rounded-lg mb-2"
            />
            <small class="text-gray-500 text-[10px] block">
              {{ moment(reply.created_at).format('D MMMM YYYY h:mm A')}}
            </small>
          </div>
        </div>
      </div>
    </div>
</template>

<script setup>
import { Link , useForm } from '@inertiajs/inertia-vue3';
import Posts from '../../Components/Posts.vue';
import { ref } from 'vue'
import moment from '../../moment'
import { useI18n } from 'vue-i18n'

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