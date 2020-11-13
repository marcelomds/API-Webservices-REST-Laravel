require('./bootstrap');
window.Vue = require('vue');
import Snotify from 'vue-snotify';

import router from "./routes/routers";
import store from './vuex/store';

Vue.use(Snotify, {toast: {showProgressBar: false}});

/**
 * Components globais
 */
Vue.component('admin-component', require('./components/admin/AdminComponent').default);
Vue.component('preloader-component', require('./components/layouts/PreloaderComponent').default);

const app = new Vue({
    router,
    store,
    el: '#app',
});

store.dispatch('loadCategories');
