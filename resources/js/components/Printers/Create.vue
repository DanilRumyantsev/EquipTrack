<template>
    <q-dialog v-model="showModal">
        <q-card style="min-width: 400px">
            <q-card-section>
                <div class="text-h6">Добавить принтер</div>
            </q-card-section>

            <q-card-section>
                <q-input v-model="form.model" label="Модель" class="q-mb-md" />
                <q-input
                    v-model="form.ip_address"
                    label="IP-адрес"
                    class="q-mb-md"
                />
                <q-input
                    v-model="form.mac_address"
                    label="MAC-адрес"
                    class="q-mb-md"
                />
                <q-input
                    v-model="form.location"
                    label="Местоположение"
                    class="q-mb-md"
                />
                <q-select
                    v-model="form.status"
                    :options="['работает', 'в ремонте', 'списан']"
                    label="Статус"
                />
            </q-card-section>

            <q-card-actions align="right">
                <q-btn flat label="Отмена" @click="closeModal" color="grey" />
                <q-btn color="primary" label="Сохранить" @click="submit" />
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>

<script setup>
import axios from "axios";
import { defineProps, defineEmits, ref, watch } from "vue";

const props = defineProps(["modelValue"]);
const emit = defineEmits(["close", "created", "update:modelValue"]);

const showModal = ref(false);
const form = ref({
    model: "",
    ip_address: "",
    mac_address: "",
    location: "",
    status: "работает",
});

const submit = async () => {
    const res = await axios.post("/printers", form.value);
    emit("created", res.data);
    closeModal();
};

const closeModal = () => {
    form.value = {
        model: "",
        ip_address: "",
        mac_address: "",
        location: "",
        status: "работает",
    };
    showModal.value = false;
    emit("close");
    emit("update:modelValue", false); // <-- Основное исправление
};

watch(
    () => props.modelValue,
    (newVal) => {
        showModal.value = newVal;
    }
);

watch(
    () => showModal.value,
    (newVal) => {
        if (!newVal) emit("update:modelValue", false); // <-- Дополнительно
    }
);
</script>
