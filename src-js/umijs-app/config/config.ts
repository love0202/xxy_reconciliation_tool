// config/config.ts

import { defineConfig } from 'umi';
import routes from './routes';

export default defineConfig({
    title: 'umijs-app',
    favicon: '/assets/favicon.ico',
    routes: [
        { path: '/', component: '@/pages/index' },
        { path: '/users', component: '@/pages/users' },
        { path: '/login', component: '@/pages/login' },
    ],
    base: '/',
    publicPath: '/static/',
    hash: true,
    history: {
        type: 'hash',
    },
   fastRefresh: {},
});