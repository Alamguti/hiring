// Importa los estilos de Bootstrap
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap.bundle';
// Importa Bootstrap JavaScript
import * as bootstrap from 'bootstrap';

// Importa el componente Vue
import PruebaComponent from './components/PruebaComponent.vue';
import ModalComponent from './components/ModalComponent.vue';

// Importa la función createApp
import { createApp } from 'vue';

// Importa la aplicación Vue principal
import App from './App.vue';
// Crea la aplicación Vue
const app = createApp(App);

// Registra el componente globalmente
app.component('prueba-component', PruebaComponent);
app.component('modal-component', ModalComponent);

const user = window.user || null;
app.config.globalProperties.$user = user;
// Monta la aplicación en el elemento con el ID "app"
app.mount('#laravel-app');

