import "./bootstrap";
import { createApp } from "vue";
import App from "./components/App.vue"; // <- здесь импорт
import { Quasar } from "quasar";
import quasarUserOptions from "./quasar-user-options";
import "@quasar/extras/material-icons/material-icons.css";
import axios from "axios";
import router from "../router";

axios.defaults.baseURL = "http://127.0.0.1:8000";
axios.defaults.withCredentials = true;
const app = createApp(App);
app.use(Quasar, quasarUserOptions);
app.use(router);
app.mount("#app");
