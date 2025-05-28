
<template>
<div class="flex flex-shrink-0 p-4 pb-0">
    <Link :href=" route('profile.show', {'id': post.user.id})" class="flex-shrink-0 group block">
        <div class="flex items-center">
            <div>
                <img class="inline-block h-10 w-10 rounded-full" :src=" post.user.image_url " alt="User Image" />
            </div>
            <div class="ml-3">
                <p class="text-base leading-6 font-medium text-white">
                     {{post.user.name }}
                    <span class="block text-sm leading-5 font-medium text-gray-400 group-hover:text-gray-300 transition duration-150">
              {{ moment(post.created_at).format('D MMMM YYYY h:mm A')}}
                    </span>
                </p>
            </div>
        </div>
    </Link>
</div>

<div class="text-white pl-16">
    <div class="text-lg font-medium mt-4 text-gray-400 mb-2" v-html="linkedPost"></div>
    <img
      v-if="post.image_url"
      :src="post.image_url"
      alt="Post Image"
      class="w-full h-64 object-cover rounded-lg mx-auto"
    />       

    <div class="flex">
        <div class="w-full">
            <div class="flex items-center flex-wrap">

                <!-- {{-- Replies --}} -->
                <div class="flex-1 text-center">
                    <Link :href="route('tweet.show', post.id) " class="flex items-center space-x-2 px-3 py-2 text-gray-500 hover:bg-blue-800 hover:text-blue-300 rounded-full">
                        <svg class="h-7 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                       {{ post.replies.length ?? 0 }} 
                        <!-- <span class="text-lg text-gray-400">{{ $post->replies()->count() }}</span> -->
                    </Link>
                </div>

                <!-- {{-- Retweet --}} -->
                <div class="flex-1 text-center py-2 m-2">
                    <form @click.prevent="submitRetweet ">
                        <button type="submit" class="flex items-center space-x-2 px-3 py-2 hover:bg-blue-800 hover:text-blue-300 text-gray-500 rounded-full">
                            <svg class="h-7 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                            </svg>
                                {{ post.retweetedby.length ?? 0 }}                            
                            <!-- <span class="text-lg text-gray-400">{{ $post->retweetedby()->count() }}</span> -->
                        </button>
                    </form>
                </div>

                <!-- {{-- Like --}} -->
                <div class="flex-1 text-center py-2 m-2">
                    <form @submit.prevent="submitLike">
                        <button type="submit" class="flex items-center space-x-2 px-3 py-2 hover:bg-blue-800 hover:text-blue-300 text-gray-500 rounded-full">
                            <svg  :class="[
                                            'h-7 w-6',
                                            post.is_liked ? 'fill-red-500 stroke-red-500' : 'fill-none stroke-gray-500'
                                                ]" 
                                        fill="none" 
                                        stroke="currentColor" 
                                        stroke-width="2" 
                                        viewBox="0 0 24 24">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            {{ post.likes.length ?? 0 }}
                            <!-- <span class="text-lg text-gray-400">{{ $post->likes()->count() }}</span> -->
                        </button>
                    </form>
                </div>



                <!-- {{-- Bookmark --}} -->
                <div class="flex-1 text-center py-2 m-2">
                    <form @click.prevent="submitBookmark ">
                        <button class="flex items-center space-x-2 px-3 py-2 hover:bg-blue-800 hover:text-blue-300 text-gray-500 rounded-full">
                            <svg class="h-7 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20" />
                            </svg>
                            {{ post.bookmark.length ?? 0 }}
                            <!-- <span class="text-lg text-gray-400">{{ $post->bookmarks()->count() }}</span> -->
                        </button>
                    </form>
                </div>



            </div>
        </div>
    </div>
</div>

<hr class="border-gray-600">

</template>


<script setup>
import { defineProps, computed} from 'vue'
import axios from 'axios';
import { ref } from 'vue';

import { Link,useForm  } from '@inertiajs/inertia-vue3';
import moment from '../moment'
import { useI18n } from 'vue-i18n'

const { locale } = useI18n();
const props = defineProps({
  post: Object,
  user: Object,

})

const linkedPost = computed(() => {
  if (!props.post.post) return ''

  return props.post.post.replace(/#(\w+)/g, (match, tag) => {
    const url = route('hashtag.show', { hashtag: tag })
    return `<a href="${url}" class="text-blue-400 hover:underline">#${tag}</a>`
  })
})
const form=useForm({})
const submitLike = () => {
  form.post(route('posts.like', props.post.id), {
     preserveScroll: true,
    
    })
}

const submitRetweet = () => {
  form.post(route('post.retweet', props.post.id), { preserveScroll: true })
}

const submitBookmark = () => {
    form.post(route('bookmark.mark', props.post.id), { preserveScroll: true })
}

const is_liked = computed(() => {
  return props.post.is_liked === true;
});

</script>