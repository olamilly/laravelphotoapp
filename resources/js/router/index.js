import { createRouter, createWebHistory } from 'vue-router'

import homeindex from '@/components/homeindex.vue'

const routes = [
    {
        path: '/',
        name: 'home1',
        component: homeindex
    },
    {
        path: '/home',
        name: 'home2',
        component: homeindex
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;