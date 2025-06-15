import { createApp } from 'vue';
import './style.css';
import App from './App.vue';
import router from './router/index.js';
import '../node_modules/bootstrap/dist/css/bootstrap-grid.min.css';
import '../node_modules/bootstrap/dist/css/bootstrap-utilities.min.css';
import { createPinia } from 'pinia'

const app = createApp(App);
app.use(router);
app.use(createPinia());
app.mount('#app');
