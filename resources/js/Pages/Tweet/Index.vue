


<template>
  <MainLayout>

<div class="p-relative h-screen min-h-screen" >
    <div class=" flex w-full min-h-screen gap-4">
        <!-- الجدار الأوسط -->
        <div class="flex-[3] border w-full border-gray-600 h-auto border-$t-0 px-4">
            <!-- العنوان العلوي -->
         <div class="flex-1 m-2">
            <h2 class="px-4 py-2 text-xl font-semibold text-white">
             {{$t('home')}}
         </h2>
         </div>
            <div class="flex">
                <div class="flex-1 m-2">
                    <h2 class="px-4 py-2 text-xl font-semibold text-white">
                    </h2>
                </div>

            </div>
            <section>
            <!-- إنشاء تغريدة -->
        <form @submit.prevent="submit" enctype="multipart/form-data" class="mb-6">
                    <div class="flex">
                    <div class="m-2 w-10 py-1">
                        <img class="inline-block h-10 w-10 rounded-full" :src=" user.image_url" alt="" />
                    </div>
                    <div class="flex-1 px-2 pt-2 mt-2">
                        <textarea v-model="form.body" name="post"   class="bg-transparent text-gray-400 font-medium text-lg w-full" :placeholder="$t('what is happend')"rows="2" ></textarea>
                    </div>
                </div>

                <!-- أدوات التغريدة -->
                <div class="flex">
                    <div class="w-10"></div>
                    <div class="w-64 px-2">
                        <div class="flex items-center">
                            <div class="flex-1 text-center px-1 py-1 m-2">
                                <label for="file-upload" class="mt-1 group flex items-center text-blue-400 px-2 py-2 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300 cursor-pointer">
                                    <svg class="h-7 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </label>
                            <input name="images" type="file" id="file-upload" class="hidden"  @change="handleFileUpload" />
                            </div>

                            <div class="flex-1 text-center py-2 m-2">
                                <a href="#" class="group flex items-center text-blue-400 px-2 py-2 rounded-full hover:bg-blue-800 hover:text-blue-300">
                                    <svg class="h-7 w-6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                        <path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </a>
                            </div>

                            <div class="flex-1 text-center py-2 m-2">
                                <a href="#" class="group flex items-center text-blue-400 px-2 py-2 rounded-full hover:bg-blue-800 hover:text-blue-300">
                                    <svg class="h-7 w-6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </a>
                            </div>

                            <div class="flex-1 text-center py-2 m-2">
                                <a href="#" class="group flex items-center text-blue-400 px-2 py-2 rounded-full hover:bg-blue-800 hover:text-blue-300">
                                    <svg class="h-7 w-6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 flex justify-end pr-8">
                        <button type="submit" class="bg-blue-400 mt-5 hover:bg-blue-600 text-white font-bold py-2 px-8 rounded-full">
                        {{ $t('tweet') }}
                        </button>
                    </div>
                </div>
            </form>
    </section>
            <hr class="border-gray-800 border-2">

            <!-- عرض التغريدات -->
            <div class="w-full ">
                <Posts v-for="tweet in posts"
                    :key="tweet.id"
                    :user="tweet.user"
                    :post="tweet"
                />
            </div>
            <div ref="loadMoreTrigger" class="py-6 text-center text-gray-400" v-if="page < lastPage">
            تحميل المزيد...
            </div>
        </div>

        <!-- القائمة الجانبية اليمنى -->
         <div class="flex-[1] overflow-auto border border-gray-600">
        <Right-list :hashtags="hashtags" :suggestedUsers="suggestedUsers" />
        </div>
    </div>
    </div>
</MainLayout>

</template>


<script setup>
import { useIntersectionObserver } from '@vueuse/core';
import { useForm } from '@inertiajs/inertia-vue3';
import Posts from '@/Components/Posts.vue';
import MainLayout from '@/Layout/main.vue';
import RightList from '../../Components/Right-list.vue';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
const props = defineProps({
  allposts: Object,
  user: Object,
  suggestedUsers: Array,
  hashtags: Array,
  tweet: Object,
  initialPage: Object
});

const posts = ref([...props.allposts.data]);
const page = ref(props.allposts.current_page);
const lastPage = ref(props.allposts.last_page);
const loading = ref(false);

const loadMoreTrigger = ref(null);

function loadMore() {
  if (loading.value || page.value >= lastPage.value) return;

  loading.value = true;
  const nextPage = page.value + 1;

  Inertia.get(route('tweet.index') + '?page=' + nextPage, {}, {
    preserveScroll: true,
    preserveState: true,
    only: ['allposts'],
    onSuccess: (pageProps) => {
      posts.value.push(...pageProps.props.allposts.data);
      page.value = pageProps.props.allposts.current_page;
      lastPage.value = pageProps.props.allposts.last_page;
      
      // هنا نرجع الرابط لحالته الأصلية بدون رقم الصفحة
      window.history.replaceState({}, '', route('tweet.index'));
    },
    onFinish: () => {
      loading.value = false;
    }
  });
}


useIntersectionObserver(
  loadMoreTrigger,
  ([{ isIntersecting }]) => {
    if (isIntersecting) {
      loadMore();
    }
  },
  {
    threshold:  0.1,
  }
);

const form = useForm({
  body: '',
  images: null
});

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


