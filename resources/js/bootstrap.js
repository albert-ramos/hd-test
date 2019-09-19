import Vue from 'vue'
import Layout from './layout/index.vue';
import router from './router'
import httpConfig from './config/http'

new Vue({
    name: 'Root',
    router,
    render: h => h(Layout)
  }).$mount('#app')

