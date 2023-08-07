//require('./bootstrap');


import { createApp } from 'vue/dist/vue.esm-bundler.js';
import homeindex from './components/homeindex.vue';
import newpost from './components/newpost.vue';
import router from './router/index.js'; 
import { extractIdentifiers } from 'vue/compiler-sfc';
const app = createApp({
  components:{
    homeindex,
    newpost
  }
})
app.use(router)
app.mount('#app')
