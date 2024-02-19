import './bootstrap';
import '../css/app.css';

import { createApp } from 'vue';
import App from './App.vue'; // Assicurati di avere un componente App.vue
import router from './router'; // Importa l'istanza di Vue Router configurata
import vuetify from './plugins/vuetify'; // Continua a utilizzare Vuetify
import { store } from './store'; // Continua a utilizzare Vuex
import 'material-design-icons-iconfont/dist/material-design-icons.css';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const app = createApp(App);

app.use(router)
   .use(vuetify)
   .use(store);

app.mount('#app');
