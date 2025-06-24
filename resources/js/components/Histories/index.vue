<template>
    <div class="q-pa-md">
        <q-btn
            to="/app/dashboard"
            color="grey"
            label="← Назад"
            class="q-mb-md"
        />

        <div class="text-h6 q-mb-md">История перемещений</div>
        <q-table
            title="История изменений местоположения"
            :rows="histories"
            :columns="columns"
            row-key="id"
        >
            <template v-slot:body-cell-device_type="props">
                <q-td :props="props">{{
                    formatDeviceType(props.row.device_type)
                }}</q-td>
            </template>
        </q-table>
    </div>
</template>

<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";

const histories = ref([]);

const columns = [
    { name: "device_type", label: "Тип устройства", field: "device_type" },
    { name: "device_id", label: "ID устройства", field: "device_id" },
    { name: "old_location", label: "Старое место", field: "old_location" },
    { name: "new_location", label: "Новое место", field: "new_location" },
    { name: "reason", label: "Причина", field: "reason" },
    { name: "created_at", label: "Дата", field: "created_at" },
];

const loadHistory = async () => {
    const res = await axios.get("/histories");
    histories.value = res.data;
};

onMounted(loadHistory);

const formatDeviceType = (type) => {
    return type.includes("Printer") ? "Принтер" : "IP-телефон";
};
</script>
