<template>
    <q-layout view="lHh Lpr lFf">
        <q-header elevated>
            <q-toolbar class="text-white">
                <q-btn
                    flat
                    to="/app/dashboard"
                    style="padding: 0; min-width: auto"
                >
                    <img
                        src="/storage/LogoTTK_white.svg"
                        alt="Логотип TTK"
                        style="height: 40px; width: auto"
                    />
                </q-btn>

                <q-space />

                <!-- Информация о пользователе -->
                <div v-if="user" class="q-mr-md">
                    Вы авторизованы: <strong>{{ user.name }}</strong>
                </div>

                <!-- Кнопки -->
                <q-btn flat to="/app/login" label="Вход" v-if="!user" />
                <q-btn
                    flat
                    to="/app/register"
                    label="Регистрация"
                    v-if="!user"
                />
                <q-btn flat @click="logout" label="Выход" v-if="user" />
            </q-toolbar>
        </q-header>

        <q-page-container>
            <router-view :fetch-user="fetchUser" />
        </q-page-container>
    </q-layout>
</template>

<script setup>
import axios from "axios";
import { ref } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
const user = ref(null);

// Функция получения данных пользователя
const fetchUser = async () => {
    try {
        await axios.get("/sanctum/csrf-cookie");
        const res = await axios.get("/user", { withCredentials: true });
        user.value = res.data;
    } catch {
        user.value = null;
    }
};

fetchUser(); // Инициализация при старте

// Выход
const logout = async () => {
    await axios.post("/logout");
    user.value = null;
    await router.push({ name: "Login" });
};

defineProps({
    fetchUser: {
        type: Function,
        required: true,
    },
});
</script>

<style scoped>
.q-toolbar {
    background-color: #ca0e0e;
}
</style>
