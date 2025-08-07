import './bootstrap';

import { createApp } from 'vue';
import router from './route';

const app = createApp({})
app.use(router)
app.mount('#app');
