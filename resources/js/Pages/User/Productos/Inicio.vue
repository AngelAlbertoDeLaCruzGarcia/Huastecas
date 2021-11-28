<template>
    <v-app id="inspire">
        <Head :errors="errors" />
        <v-overlay :value="overlay">
            <v-row justify="center">
                <v-img
                    src="/assets/img/Logos/512.png"
                    max-height="130"
                    max-width="130"
                />
            </v-row>
            <v-row justify="center">
                <v-progress-circular indeterminate size="80" />
            </v-row>
        </v-overlay>
        <v-main v-bind:style="{ 'background-color': this.$store.state.fondo }">
            <v-container>
                <v-row>
                    <v-card elevation="24" max-width="100%" class="mx-auto">
                        <v-carousel
                            cycle
                            height="370"
                            hide-delimiter-background
                            show-arrows-on-hover
                        >
                            <v-carousel-item
                                v-for="(item, i) in items"
                                :key="i"
                                :src="`${item.src}`"
                            ></v-carousel-item>
                        </v-carousel>
                    </v-card>
                </v-row>
                <v-row class="justify-center">
                    <v-card
                        class="rounded-lg my-15"
                        width="420"
                        height="30"
                        elevation="18"
                    >
                        <v-btn @click="cambiarT" color="success" small rounded
                            >Todo</v-btn
                        >
                        <v-btn @click="cambiarD" color="success" small rounded
                            >Dama</v-btn
                        >
                        <v-btn @click="cambiarC" color="success" small rounded
                            >Caballero</v-btn
                        >

                        <v-btn @click="cambiarI" color="success" small rounded
                            >Infantil</v-btn
                        >

                        <v-btn @click="cambiarU" color="success" small rounded
                            >Unisex</v-btn
                        >
                    </v-card>
                </v-row>
                <v-row>
                    <v-col v-for="prod in prods" :key="prod.intIDProd" cols="4">
                        <div v-if="prod.intIdCat == 1" v-show="caba">
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

                        <div v-if="prod.intIdCat == 2" v-show="dama">
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

                        <div v-if="prod.intIdCat == 3" v-show="infa">
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

                        <div v-if="prod.intIdCat == 4" v-show="unisex">
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
import { mapGetters } from "vuex";

export default {
    metaInfo: { title: "Inicio" },
    ///props:['prods'],
    props: {
        prods: Array,
        errors: Object
    },
    data() {
        return {
            overlay: true,
            i: "Nuevo",
            caba: true,
            dama: true,
            infa: true,
            unisex: true,
            cont: this.$store.state.count,
            items: [
                { src: "assets/img/imgSlider1.jpg" },
                { src: "assets/img/imgSlider2.jpg" },
                { src: "assets/img/imgSlider3.jpg" },
                { src: "assets/img/imgSlider4.png" }
            ]
        };
    },
    methods: {
        checar() {
            alert(this.cont);
        },
        cambiarD: function() {
            this.dama = true;
            this.caba = false;
            this.infa = false;
            this.unisex = false;
        },
        cambiarC: function() {
            this.dama = false;
            this.caba = true;
            this.infa = false;
            this.unisex = false;
        },
        cambiarI: function() {
            this.dama = false;
            this.caba = false;
            this.infa = true;
            this.unisex = false;
        },
        cambiarT: function() {
            this.dama = true;
            this.caba = true;
            this.infa = true;
            this.unisex = false;
        },
        cambiarU: function() {
            this.dama = false;
            this.caba = false;
            this.infa = false;
            this.unisex = true;
        },
        setLaunch() {
            setTimeout(() => {
                this.overlay = false;
            }, 3000);
        }
    },
    created() {
        this.setLaunch();
    },
    components: {
        Fotter,
        Head
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
.single-line {
    width: 100%;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
}
</style>
