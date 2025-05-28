import '../css/app.css';
import './bootstrap';
import Alpine from 'alpinejs';
import { createApp, h, watch } from 'vue';
import { createInertiaApp, Link } from '@inertiajs/inertia-vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import i18n from './i18n';
import moment from './moment';

window.Alpine = Alpine;
Alpine.start();

const resolveMomentLocale = (locale) => {
  return locale === 'ar' ? 'ar-sa' : 'en';
};

createInertiaApp({
  resolve: name =>
    resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    const app = createApp({ render: () => h(App, props) });

    app
      .use(plugin)
      .use(i18n)
      .component('Link', Link)
      .use(ZiggyVue)
      .mixin({
        methods: {
          route: window.route
        }
      });

    // ضَعه بعد use(i18n) لتأكد من أن i18n جاهز
    moment.locale(resolveMomentLocale(i18n.global.locale.value));

    watch(
      () => i18n.global.locale.value,
      (newLocale) => {
        const momentLocale = resolveMomentLocale(newLocale);
        moment.locale(momentLocale);
      },
      { immediate: true }
    );

    app.mount(el);
    return app;
  },
});
