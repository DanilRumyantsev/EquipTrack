<script setup>
import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const router = useRouter();
const form = ref({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});
const $form = ref();

// Правила валидации
const nameRules = [
    (val) => !!val || "Имя обязательно для заполнения",
    (val) => val.length >= 2 || "Имя должно быть не короче 2 символов",
];

const emailRules = [
    (val) => !!val || "E-mail обязателен для заполнения",
    (val) =>
        /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/.test(val) ||
        "Введите корректный email",
];

const passwordRules = [
    (val) => !!val || "Пароль обязателен для заполнения",
    (val) => val.length >= 8 || "Пароль должен быть не менее 8 символов",
];

const passwordConfirmationRules = [
    (val) => !!val || "Подтвердите пароль",
    (val) => val === form.value.password || "Пароли не совпадают",
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
        await axios.post("/register", form.value);
        await router.push({ name: "Login" });
        await props.fetchUser();
    } catch (err) {
        alert("Ошибка регистрации");
    }
};
</script>

<template>
    <q-page class="flex flex-center">
        <q-card style="width: 400px">
            <q-card-section>
                <h4 class="text-h6 text-center">Регистрация</h4>
                <q-form @submit.prevent="onSubmit" ref="$form">
                    <q-input
                        v-model="form.name"
                        label="Имя"
                        :rules="nameRules"
                        lazy-rules
                    />
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
                    <q-input
                        v-model="form.password_confirmation"
                        label="Подтверждение пароля"
                        type="password"
                        :rules="passwordConfirmationRules"
                        lazy-rules
                    />
                    <q-btn
                        type="submit"
                        label="Зарегистрироваться"
                        class="full-width q-mt-md button-form"
                    />
                </q-form>
            </q-card-section>
        </q-card>
    </q-page>
</template>

<style scoped>
.button-form {
    background-color: #d02424;
    color: white;
}
</style>
