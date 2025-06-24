import { createRouter, createWebHistory } from "vue-router";

// Pages
import Dashboard from "../js/components/Dashboard.vue";
import Login from "../js/components/Login.vue";
import Register from "../js/components/Register.vue";

// Printers
import PrinterIndex from "../js/components/Printers/index.vue";
import PrinterCreate from "../js/components/Printers/Create.vue";
import PrinterEdit from "../js/components/Printers/Edit.vue";

// Phones
import PhoneIndex from "../js/components/Phones/index.vue";
import PhoneCreate from "../js/components/Phones/Create.vue";
import PhoneEdit from "../js/components/Phones/Edit.vue";

// Histories
import HistoryIndex from "../js/components/Histories/index.vue";

const routes = [
    {
        path: "/app/dashboard",
        name: "Dashboard",
        component: Dashboard,
    },
    {
        path: "/app/login",
        name: "Login",
        component: Login,
    },
    {
        path: "/app/register",
        name: "Register",
        component: Register,
    },

    // Принтеры
    {
        path: "/app/printers",
        name: "PrinterIndex",
        component: PrinterIndex,
    },
    {
        path: "/app/printers/create",
        name: "PrinterCreate",
        component: PrinterCreate,
    },
    {
        path: "/app/printers/:id/edit",
        name: "PrinterEdit",
        component: PrinterEdit,
    },

    // Телефоны
    {
        path: "/app/phones",
        name: "PhoneIndex",
        component: PhoneIndex,
    },
    {
        path: "/app/phones/create",
        name: "PhoneCreate",
        component: PhoneCreate,
    },
    {
        path: "/app/phones/:id/edit",
        name: "PhoneEdit",
        component: PhoneEdit,
    },

    // История
    {
        path: "/app/histories",
        name: "HistoryIndex",
        component: HistoryIndex,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
