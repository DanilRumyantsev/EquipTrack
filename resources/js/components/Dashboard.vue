<template>
    <div class="q-pa-md">
        <div class="row q-col-gutter-md cards-container">
            <!-- Карточка Принтеры -->
            <div class="col-xs-12 col-sm-6 col-md-4">
                <router-link :to="'/app/printers'" class="card-link">
                    <q-card class="dashboard-card bg-blue-8 text-white">
                        <div class="card-image-container">
                            <img
                                src="/storage/printer.svg"
                                alt="Принтеры"
                                class="card-image"
                            />
                            <div class="image-overlay"></div>

                            <q-card-section class="card-content">
                                <div class="text-h6 printers-text">
                                    Принтеры
                                </div>
                            </q-card-section>
                        </div>
                    </q-card>
                </router-link>
            </div>

            <!-- Карточка IP-телефоны -->
            <div class="col-xs-12 col-sm-6 col-md-4">
                <router-link :to="'/app/phones'" class="card-link">
                    <q-card class="dashboard-card bg-green-8 text-white">
                        <div class="card-image-container">
                            <img
                                src="/storage/phone.svg"
                                alt="IP-телефоны"
                                class="card-image"
                            />
                            <div class="image-overlay"></div>

                            <q-card-section class="card-content">
                                <div class="text-h6 telephony-text">
                                    IP-телефоны
                                </div>
                            </q-card-section>
                        </div>
                    </q-card>
                </router-link>
            </div>

            <!-- Карточка История перемещений -->
            <div class="col-xs-12 col-sm-6 col-md-4">
                <router-link :to="'/app/histories'" class="card-link">
                    <q-card class="dashboard-card bg-grey-8 text-white">
                        <div class="card-image-container">
                            <img
                                src="/storage/history.svg"
                                alt="История"
                                class="card-image"
                            />
                            <div class="image-overlay"></div>

                            <q-card-section class="card-content">
                                <div class="text-h6 history-text">
                                    История перемещений
                                </div>
                            </q-card-section>
                        </div>
                    </q-card>
                </router-link>
            </div>
        </div>
    </div>
</template>

<style scoped>
.cards-container {
    position: relative;
}

.card-link {
    text-decoration: none;
    color: inherit;
    display: block;
    height: 100%;
}

.dashboard-card {
    height: 600px;
    border-radius: 16px;
    overflow: hidden;
    position: relative;
    display: flex;
    align-items: flex-end;
    background-size: cover;
    background-position: center;
}

.card-image-container {
    width: 100%;
    height: 100%;
    position: relative;
    display: flex;
    align-items: flex-end;
    justify-content: flex-start;
    flex-direction: column;
    padding: 16px;
    box-sizing: border-box;
}

.card-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 0;
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
    z-index: 1;
    transition: background-color 0.3s ease;
}

.image-overlay:hover {
    background-color: rgba(0, 0, 0, 0.562);
}

.card-content {
    position: relative;
    z-index: 2;
    margin-bottom: 16px;
}

.printers-text {
    background-color: #dbdada;
    box-shadow: 0px 5px 10px #636363;
    color: #000000;
    padding: 5px;
    border-radius: 5px;
}

.telephony-text {
    background-color: #dbdada;
    box-shadow: 0px 5px 10px #636363;
    color: #000000;
    padding: 5px;
    border-radius: 5px;
}

.history-text {
    background-color: #dbdada;
    box-shadow: 0px 5px 10px #636363;
    color: #000000;
    padding: 5px;
    border-radius: 5px;
}
</style>
