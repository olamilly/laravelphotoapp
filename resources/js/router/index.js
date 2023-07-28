import { createRouter, createWebHistory } from 'vue-router'

import CompaniesIndex from '@/components/homeIndex.vue'

const routes = [
    {
        path: '/home',
        name: 'home.index',
        component: homeIndex
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
})