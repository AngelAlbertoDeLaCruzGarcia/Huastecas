<template>
    <v-app id="inspire">
        <Head :errors="errors" />
        <v-main v-bind:style="{ 'background-color': this.$store.state.fondo }">
            <v-container style="margin-top:0%;">
                <v-row>
                    <p v-if="nombre === '1'">
                        Resultados de: <strong>Caballero</strong>
                    </p>
                    <p v-else-if="nombre === '2'">
                        Resultados de: <strong>Dama</strong>
                    </p>
                    <p v-else-if="nombre === '3'">
                        Resultados de: <strong>Infantil</strong>
                    </p>
                    <p v-else-if="nombre === '4'">
                        Resultados de: <strong>Unisex</strong>
                    </p>
                    <p v-else>
                        Resultados de: <strong>{{ nombre }}</strong>
                    </p>
                </v-row>
                <v-row>
                    <v-col v-for="prod in prods" :key="prod.intIDProd" cols="4">
                        <div v-if="prod.intIdCat == 1">
                            <inertia-link
                                :href="`/Inicio/${prod.intIDProd}`"
                                :name="`${prod.intIDProd}`"
                                style="text-decoration:none"
                            >
                                <v-hover v-slot="{ hover }">
                                    <v-card
                                        class="mx-auto"
                                        max-width="400"
                                        max-height="400"
                                        elevation="18"
                                        hover="true"
                                    >
                                        <v-img
                                            class="indigo--text align-end"
                                            height="200px"
                                            :src="`${prod.vchImg}`"
                                        />
                                        <v-card-text>
                                            <div>
                                                <h2>${{ prod.fltPrecio }}</h2>
                                            </div>
                                            <div class="single-line">
                                                <h3>
                                                    {{ prod.vchProd }}
                                                </h3>
                                            </div>
                                        </v-card-text>
                                        <v-card-subtitle>
                                            Caballero
                                        </v-card-subtitle>
                                        <v-expand-transition>
                                            <v-card
                                                v-if="hover"
                                                class="transition-fast-in-fast-out success v-card--reveal"
                                                style="height: 100%;"
                                            >
                                                <v-card-text
                                                    class="white--text"
                                                >
                                                    <h1>Descripción</h1>
                                                    <br />
                                                    <p>{{ prod.vchDesc }}</p>
                                                </v-card-text>
                                            </v-card>
                                        </v-expand-transition>
                                    </v-card>
                                </v-hover>
                            </inertia-link>
                        </div>

                        <div v-if="prod.intIdCat == 2">
                            <inertia-link
                                :href="`/Inicio/${prod.intIDProd}`"
                                :name="`${prod.intIDProd}`"
                                style="text-decoration:none"
                            >
                                <v-hover v-slot="{ hover }">
                                    <v-card
                                        class="mx-auto"
                                        max-width="400"
                                        elevation="18"
                                        hover="true"
                                    >
                                        <v-img
                                            class="indigo--text align-end"
                                            height="200px"
                                            :src="`${prod.vchImg}`"
                                        />
                                        <v-card-text>
                                            <div>
                                                <h2>${{ prod.fltPrecio }}</h2>
                                            </div>
                                            <div class="single-line">
                                                <h3>
                                                    {{ prod.vchProd }}
                                                </h3>
                                            </div>
                                        </v-card-text>
                                        <v-card-subtitle>
                                            Dama
                                        </v-card-subtitle>
                                        <v-expand-transition>
                                            <v-card
                                                v-if="hover"
                                                class="transition-fast-in-fast-out success v-card--reveal"
                                                style="height: 100%;"
                                            >
                                                <v-card-text
                                                    class="white--text"
                                                >
                                                    <h1>Descripción</h1>
                                                    <br />
                                                    <p>{{ prod.vchDesc }}</p>
                                                </v-card-text>
                                            </v-card>
                                        </v-expand-transition>
                                    </v-card>
                                </v-hover>
                            </inertia-link>
                        </div>

                        <div v-if="prod.intIdCat == 3">
                            <inertia-link
                                :href="`/Inicio/${prod.intIDProd}`"
                                :name="`${prod.intIDProd}`"
                                style="text-decoration:none"
                            >
                                <v-hover v-slot="{ hover }">
                                    <v-card
                                        class="mx-auto"
                                        max-width="400"
                                        elevation="18"
                                        hover="true"
                                    >
                                        <v-img
                                            class="indigo--text align-end"
                                            height="200px"
                                            :src="`${prod.vchImg}`"
                                        />
                                        <v-card-text>
                                            <div>
                                                <h2>${{ prod.fltPrecio }}</h2>
                                            </div>
                                            <div class="single-line">
                                                <h3>
                                                    {{ prod.vchProd }}
                                                </h3>
                                            </div>
                                        </v-card-text>
                                        <v-card-subtitle>
                                            Infantil
                                        </v-card-subtitle>
                                        <v-expand-transition>
                                            <v-card
                                                v-if="hover"
                                                class="transition-fast-in-fast-out success v-card--reveal"
                                                style="height: 100%;"
                                            >
                                                <v-card-text
                                                    class="white--text"
                                                >
                                                    <h1>Descripción</h1>
                                                    <br />
                                                    <p>{{ prod.vchDesc }}</p>
                                                </v-card-text>
                                            </v-card>
                                        </v-expand-transition>
                                    </v-card>
                                </v-hover>
                            </inertia-link>
                        </div>

                        <div v-if="prod.intIdCat == 4">
                            <inertia-link
                                :href="`/Inicio/${prod.intIDProd}`"
                                :name="`${prod.intIDProd}`"
                                style="text-decoration:none"
                            >
                                <v-hover v-slot="{ hover }">
                                    <v-card
                                        class="mx-auto"
                                        max-width="400"
                                        elevation="18"
                                        hover="true"
                                    >
                                        <v-img
                                            class="indigo--text align-end"
                                            height="200px"
                                            :src="`${prod.vchImg}`"
                                        />
                                        <v-card-text>
                                            <div>
                                                <h2>${{ prod.fltPrecio }}</h2>
                                            </div>
                                            <div class="single-line">
                                                <h3>
                                                    {{ prod.vchProd }}
                                                </h3>
                                            </div>
                                        </v-card-text>
                                        <v-card-subtitle>
                                            Unisex
                                        </v-card-subtitle>
                                        <v-expand-transition>
                                            <v-card
                                                v-if="hover"
                                                class="transition-fast-in-fast-out success v-card--reveal"
                                                style="height: 100%;"
                                            >
                                                <v-card-text
                                                    class="white--text"
                                                >
                                                    <h1>Descripción</h1>
                                                    <br />
                                                    <p>{{ prod.vchDesc }}</p>
                                                </v-card-text>
                                            </v-card>
                                        </v-expand-transition>
                                    </v-card>
                                </v-hover>
                            </inertia-link>
                        </div>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
        <Fotter />
    </v-app>
</template>

<script>
import Fotter from "../Fotter";
import Head from "../Head";
//import Pagination from '@/Layouts/Pagination'

export default {
    metaInfo: { title: "Inicio" },
    ///props:['prods'],
    props: {
        prods: Object,
        errors: Object,
        nombre: Object,
        checar: Boolean
    },
    data() {
        return {};
    },

    methods: {},

    components: {
        Fotter,
        Head
        //Pagination,
    }
};
</script>

<style>
.v-card--reveal {
    bottom: 0;
    opacity: 1 !important;
    position: absolute;
    width: 100%;
}
</style>
