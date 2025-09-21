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
                label="Добавить принтер"
                class="q-mb-md"
            />
        </div>

        <q-table
            title="Список принтеров"
            class="text-body1"
            :rows="printers"
            :columns="columns"
            row-key="id"
        >
            <template v-slot:body-cell-actions="props">
                <q-td :props="props">
                    <q-btn
                        class="edit-button text-body1"
                        color="primary"
                        @click="openEditModal(props.row.id)"
                        label="Редактировать"
                    />
                    <q-btn
                        class="delete-button text-body1"
                        color="red"
                        @click="deletePrinter(props.row.id)"
                        label="Удалить"
                    />
                </q-td>
            </template>
        </q-table>

        <!-- Модальные окна -->
        <PrinterCreate v-model="showCreateModal" @created="loadPrinters" />
        <PrinterEdit
            v-model="showEditModal"
            :printer-id="selectedPrinterId"
            @updated="loadPrinters"
        />
    </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";
import PrinterCreate from "./Create.vue";
import PrinterEdit from "./Edit.vue";

const showCreateModal = ref(false);
const showEditModal = ref(false);
const selectedPrinterId = ref(null);

const printers = ref([]);

const columns = [
    { name: "model", label: "Модель", field: "model" },
    { name: "ip_address", label: "IP-адрес", field: "ip_address" },
    { name: "mac_address", label: "MAC-адрес", field: "mac_address" },
    { name: "location", label: "Местоположение", field: "location" },
    { name: "status", label: "Статус", field: "status" },
    { name: "actions", label: "Действия", field: "actions" },
];

const loadPrinters = async () => {
    const res = await axios.get("/printers");
    printers.value = res.data.data;
};

const openEditModal = (id) => {
    selectedPrinterId.value = id;
    showEditModal.value = true;
};

const deletePrinter = async (id) => {
    if (confirm("Удалить принтер?")) {
        await axios.delete(`/printers/${id}`);
        loadPrinters();
    }
};

loadPrinters();
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
