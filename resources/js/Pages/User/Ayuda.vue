<template>
    <v-app>
        <Head :errors="errors" />
        <!-- ======= Hero Section ======= -->
        <v-main v-bind:style="{ 'background-color': this.$store.state.fondo }">
            <v-container>
                <v-card color="gray" elevation="18">
                    <v-row justify="center">
                        <h2>Contacto</h2>
                    </v-row>
                    <v-row justify="center">
                        <p>
                            Si necesitas soporte tecnico o tienes alguna duda
                            envianos un e-mail o llama al 5525212365 desde el
                            interior de la republica
                        </p>
                    </v-row>
                    <v-row justify="center">
                        <p>¡Estamos para ayudarte!</p>
                    </v-row>
                    <div class="row">
                        <div class="col-lg-6">
                            <v-card color="blue lighten-4">
                                <v-icon color="success"
                                    >mdi-map-marker-radius-outline</v-icon
                                >
                                <h3>Nuestra direccion</h3>
                                <p>
                                    Calle Nueva, Huejutla de Reyes, 43000
                                </p>
                            </v-card>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <v-card color="blue lighten-4">
                                <v-icon color="success">mdi-email</v-icon>
                                <h3>Email</h3>
                                <p>contact@example.com</p>
                            </v-card>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <v-card color="blue lighten-4">
                                <v-icon color="success"
                                    >mdi-phone-in-talk</v-icon
                                >
                                <h3>Lamadas y Whatsapp</h3>
                                <p>5525212365</p>
                            </v-card>
                        </div>
                    </div>
                </v-card>
            </v-container>
        </v-main>
        <Fotter />
    </v-app>
</template>

<script>
import Fotter from "./Fotter";
import Head from "./Head";
//import Pagination from '@/Layouts/Pagination'

export default {
    metaInfo: { title: "Acerca" },
    ///props:['prods'],
    props: {
        errors: Object
    },
    data() {
        return {};
    },

    methods: {
        checar() {
            alert(this.prods);
        }
    },

    components: {
        Fotter,
        Head
        //Pagination,
    }
};
</script>
