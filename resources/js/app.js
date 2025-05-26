import '../css/app.css';
import './bootstrap';
import Alpine from 'alpinejs';
import { createApp, h } from 'vue';
import { createInertiaApp, Link } from '@inertiajs/inertia-vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { createI18n } from 'vue-i18n'
import i18n from './i18n';

window.Alpine = Alpine;
Alpine.start();


createInertiaApp({
    resolve: name => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {

        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(i18n)
            .component('Link', Link)
            .use(ZiggyVue)
            .mixin({
                methods: {
                    route: window.route
                }
            })
            .mount(el);
    },
});

