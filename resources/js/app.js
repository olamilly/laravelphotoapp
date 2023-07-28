require('./bootstrap');

require('alpinejs');

import { createApp } from 'vue';
import router from './router'

import homeIndex from '@/components/homeIndex.vue';

createApp({
    components: {
       homeIndex
    }
}).use(router).mount('#app')