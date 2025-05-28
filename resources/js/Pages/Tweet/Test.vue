<template>
    <div class=" max-w-2xl mx-auto my-12 space-y-12"> 
    <div v-for="post in posts.data" :key="post.id" class=" text-white">
            <h1 class="text-3xl font-bold mb-12">{{ post.id }}</h1>
            <p class="text-3xl font-bold">{{ post.post }}</p>
            
    </div>
    
    </div>
    <div ref="last"></div>

</template>
<script setup>
import { useIntersectionObserver } from '@vueuse/core'
import { Inertia } from '@inertiajs/inertia' // ✅ بدل router
import { ref } from 'vue'

defineProps({
  posts: Object
})

const last = ref(null)

useIntersectionObserver(last, ([{ isIntersecting }]) => {
  if (!isIntersecting) return

  // ✅ استخدم Inertia.reload بدل router.reload
  Inertia.reload({
    data: {
      page: 2
    }
  })
})
</script>
