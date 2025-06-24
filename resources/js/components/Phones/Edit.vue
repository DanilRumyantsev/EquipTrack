<template>
    <q-dialog v-model="showModal">
        <q-card style="min-width: 400px">
            <q-card-section>
                <div class="text-h6">Редактировать IP-телефон</div>
            </q-card-section>

            <q-card-section>
                <q-input v-model="form.model" label="Модель" class="q-mb-md" />
                <q-input
                    v-model="form.phone_number"
                    label="Номер телефона"
                    class="q-mb-md"
                />
                <q-select
                    v-model="form.assigned_to"
                    :options="users"
                    option-label="name"
                    option-value="id"
                    label="Привязать к сотруднику"
                    class="q-mb-md"
                />
                <q-input
                    v-model="form.last_firmware_update"
                    type="date"
                    label="Дата прошивки"
                    class="q-mb-md"
                />
                <q-input
                    v-model="form.location"
                    label="Местоположение"
                    class="q-mb-md"
                />
                <q-select
                    v-model="form.status"
                    :options="['Работает', 'В ремонте', 'Списан']"
                    label="Статус"
                />
            </q-card-section>

            <q-card-actions align="right">
                <q-btn flat label="Отмена" @click="closeModal" color="grey" />
                <q-btn color="primary" label="Обновить" @click="submit" />
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>

<script setup>
import { ref, watch } from "vue";
import axios from "axios";

const props = defineProps({
    modelValue: {
        type: Boolean,
        required: true,
    },
    phoneId: {
        type: Number,
        required: true,
    },
});

const emit = defineEmits(["update:modelValue", "updated"]);

const showModal = ref(false);
const users = ref([]);
const form = ref({
    model: "",
    phone_number: "",
    assigned_to: null,
    last_firmware_update: null,
    location: "",
    status: "работает",
});

// Синхронизируем внутренний showModal с внешним modelValue
watch(
    () => props.modelValue,
    async (newVal) => {
        showModal.value = newVal;
        if (newVal && props.phoneId) {
            await loadUsers();
            await loadPhone();
        }
    }
);

// Закрытие через Quasar UI (например клик вне окна)
watch(
    () => showModal.value,
    (newVal) => {
        if (!newVal) {
            closeModal();
        }
    }
);

const loadUsers = async () => {
    const res = await axios.get("/user");
    users.value = res.data;
};

const loadPhone = async () => {
    const res = await axios.get(`/phones/${props.phoneId}`);
    form.value = res.data;
};

const submit = async () => {
    const res = await axios.put(`/phones/${props.phoneId}`, form.value);
    emit("updated", res.data);
    closeModal();
};

const closeModal = () => {
    form.value = {
        model: "",
        phone_number: "",
        assigned_to: null,
        last_firmware_update: null,
        location: "",
        status: "Работает",
    };
    emit("update:modelValue", false);
};
</script>
