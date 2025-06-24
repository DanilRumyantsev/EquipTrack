<template>
    <q-dialog v-model="showModal">
        <q-card style="min-width: 400px">
            <q-card-section>
                <div class="text-h6">Редактировать принтер</div>
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
    printerId: {
        type: Number,
        required: true,
    },
});

const emit = defineEmits(["update:modelValue", "updated"]);

const showModal = ref(false);
const form = ref({
    model: "",
    ip_address: "",
    mac_address: "",
    location: "",
    status: "работает",
});

// Синхронизируем внутренний showModal с внешним modelValue
watch(
    () => props.modelValue,
    async (newVal) => {
        showModal.value = newVal;
        if (newVal && props.printerId) {
            await loadPrinter();
        }
    }
);

// При закрытии диалога через Quasar UI (например клик вне окна)
watch(
    () => showModal.value,
    (newVal) => {
        if (!newVal) {
            closeModal();
        }
    }
);

const loadPrinter = async () => {
    const res = await axios.get(`/printers/${props.printerId}`);
    form.value = res.data;
};

const submit = async () => {
    await axios.put(`/printers/${props.printerId}`, form.value);
    emit("updated");
    closeModal();
};

const closeModal = () => {
    // Сбрасываем форму
    form.value = {
        model: "",
        ip_address: "",
        mac_address: "",
        location: "",
        status: "работает",
    };

    // Уведомляем родителя, что модалку нужно закрыть
    emit("update:modelValue", false);
};
</script>
