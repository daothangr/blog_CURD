import {createRouter, createWebHistory} from 'vue-router';
import admin from './admin';

const routers = [...admin];
const router = createRouter({
    history: createWebHistory(),
    routes: routers
});

export default router;