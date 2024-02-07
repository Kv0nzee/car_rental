import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import modal from './functions/modal';

const app = createApp(App)

app.use(router)
app.use(modal)
app.mount('#app')
