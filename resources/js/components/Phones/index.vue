<!-- components/Phones/index.vue -->
<template>
    <div class="q-pa-md">
        <div class="controls">
            <q-btn
                to="/app/dashboard"
                color="grey"
                label="← Назад"
                class="q-mb-md"
            />

            <q-btn
                @click="showCreateModal = true"
                color="primary"
                label="Добавить телефон"
                class="q-mb-md"
            />
        </div>

        <q-table
            title="Список IP-телефонов"
            :rows="phones"
            :columns="columns"
            row-key="id"
        >
            <template v-slot:body-cell-assigned_to="props">
                <q-td :props="props">{{ props.row.user?.name || "-" }}</q-td>
            </template>
            <template v-slot:body-cell-actions="props">
                <q-td :props="props">
                    <q-btn
                        class="edit-button text-body1"
                        color="primary"
                        @click="() => openEditModal(props.row.id)"
                        label="Редактировать"
                    />
                    <q-btn
                        class="text-body1"
                        color="red"
                        @click="deletePhone(props.row.id)"
                        label="Удалить"
                    />
                </q-td>
            </template>
        </q-table>

        <PhoneCreate v-model="showCreateModal" @created="loadPhones" />
        <PhoneEdit
            v-model="showEditModal"
            :phone-id="selectedPhoneId"
            @updated="loadPhones"
        />
    </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";
import PhoneCreate from "./Create.vue";
import PhoneEdit from "./Edit.vue";

const showCreateModal = ref(false);
const showEditModal = ref(false);
const selectedPhoneId = ref(null);

const phones = ref([]);

const columns = [
    { name: "model", label: "Модель", field: "model" },
    { name: "phone_number", label: "Номер телефона", field: "phone_number" },
    { name: "assigned_to", label: "Назначен", field: "assigned_to" },
    {
        name: "last_firmware_update",
        label: "Дата прошивки",
        field: "last_firmware_update",
    },
    { name: "location", label: "Местоположение", field: "location" },
    { name: "status", label: "Статус", field: "status" },
    { name: "actions", label: "Действия", field: "actions" },
];

const loadPhones = async () => {
    const res = await axios.get("/phones");
    phones.value = res.data;
};

const openEditModal = (id) => {
    selectedPhoneId.value = id;
    showEditModal.value = true;
};

const deletePhone = async (id) => {
    if (confirm("Удалить телефон?")) {
        await axios.delete(`/phones/${id}`);
        loadPhones();
    }
};

loadPhones();
</script>

<style scoped>
.controls {
    display: flex;
    max-width: 300px;
    gap: 10px;
    margin-bottom: 5px;
}

.edit-button {
    margin-right: 5px;
}
</style>
