import { createRouter, createWebHistory } from 'vue-router'

import homeindex from '@/components/homeindex.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: homeindex
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;