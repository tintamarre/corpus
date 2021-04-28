require('./bootstrap');

window.Vue = require('vue');
window.vue2vis = require('vue2vis');

// window.moment = require('moment');

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(fas)
Vue.component('fa', FontAwesomeIcon);
// Vue.component('timeline', vue2vis.Timeline);
Vue.component('network', vue2vis.Network);

Vue.component('pagination', require('laravel-vue-pagination'));

Vue.directive('tooltip', function(el, binding){
    $(el).tooltip({
             title: binding.value,
             placement: binding.arg,
             trigger: 'hover'
         })
});

// import VueInternationalization from 'vue-i18n';
// import Locale from './vue-i18n-locales.generated';
//
// Vue.use(VueInternationalization);
//
// const lang = document.documentElement.lang.substr(0, 2);
// // or however you determine your current app locale
//
// const i18n = new VueInternationalization({
//   locale: lang,
//   messages: Locale
// });


// Source https://dev.to/4unkur/how-to-use-laravel-translations-in-js-vue-files-ia
// docker-compose exec php php artisan cache:clear to refresh translation
Vue.mixin(require('./trans'))

const app = new Vue({
  el: '#app',
  // i18n,

});
