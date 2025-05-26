import { createI18n } from 'vue-i18n';
import Cookies from 'js-cookie'
import en from '../lang/en.json';
import ar from '../lang/ar.json';

const messages = {
  en,
  ar,
};

const savedLocale = Cookies.get('locale') || 'en';

const i18n = createI18n({
  locale: savedLocale,
  fallbackLocale: 'en',
  messages,
});

export default i18n;  // لازم يكون export default
