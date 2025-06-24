<script setup>
import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const router = useRouter();
const form = ref({ email: "", password: "" });
const $form = ref();

// Правила валидации
const emailRules = [
    (val) => (val && val.length > 0) || "Обязательно для заполнения",
    (val) =>
        /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/.test(val) ||
        "Введите корректный email",
];
const passwordRules = [
    (val) =>
        (val && val.length >= 8) || "Пароль должен быть не менее 8 символов",
];

const props = defineProps({
    fetchUser: {
        type: Function,
        required: true,
    },
});

const onSubmit = async () => {
    const isValid = await $form.value.validate();

    if (!isValid) return;

    try {
        await axios.get("/sanctum/csrf-cookie");
        await axios.post("/login", form.value);
        await router.push({ name: "Dashboard" });
        await props.fetchUser(); // Обновляем заголовок
    } catch (err) {
        alert("Ошибка входа");
    }
};
</script>

<template>
    <q-page class="flex flex-center">
        <q-card style="width: 400px">
            <q-card-section>
                <h4 class="text-h6 text-center">Авторизация</h4>
                <q-form @submit.prevent="onSubmit" ref="$form">
                    <q-input
                        v-model="form.email"
                        label="E-mail"
                        :rules="emailRules"
                        lazy-rules
                    />
                    <q-input
                        v-model="form.password"
                        label="Пароль"
                        type="password"
                        :rules="passwordRules"
                        lazy-rules
                    />
                    <q-btn
                        type="submit"
                        label="Вход"
                        class="full-width q-mt-md button-form"
                    />
                </q-form>
            </q-card-section>
            <p class="q-mt-md registration-text">
                Нет аккаунта?
                <router-link to="/app/register">
                    <div class="registration-text-element">
                        Зарегистрируйтесь
                    </div>
                </router-link>
            </p>
        </q-card>
    </q-page>
</template>

<style scoped>
.button-form {
    background-color: #d02424;
    color: white;
}

.registration-text {
    display: flex;
    gap: 5px;
    margin: 10px 25px;
}

.registration-text-element {
    background-color: #d02424;
    border-radius: 5px;
    padding: 0px 5px;
    transition: 0.5s;
    color: #ffffff;
}

.registration-text-element:hover {
    background-color: #db2929;
    transition: 0.5s;
}
</style>
