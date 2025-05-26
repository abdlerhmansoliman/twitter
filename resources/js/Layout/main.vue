<template>
  <div class="flex">
    <LeftMenu />
    <div class="flex-1">
      <slot />
    </div>
  </div>
</template>

<script setup>
import LeftMenu from '../Components/left-menu.vue'
import { useI18n } from 'vue-i18n'
import { onMounted, watch } from 'vue'

const { locale } = useI18n()

function updateHtmlAttributes(lang) {
  if (lang === 'ar') {
    document.documentElement.setAttribute('dir', 'rtl')
    document.documentElement.setAttribute('lang', 'ar')
  } else {
    document.documentElement.setAttribute('dir', 'ltr')
    document.documentElement.setAttribute('lang', 'en')
  }
}

onMounted(() => {
  updateHtmlAttributes(locale.value)
})

watch(locale, (newLocale) => {
  updateHtmlAttributes(newLocale)
})
</script>
