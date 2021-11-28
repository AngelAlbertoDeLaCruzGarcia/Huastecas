<template>
    <div>
        <!-- ======= Footer ======= -->
        <v-footer class="indigo lighten-1" padless>
            <v-row justify="center" class="white--text" no-gutters>
                <div style="padding: 23px 0 0px 0;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3 col-md-2">
                                <v-card class="text-center" elevation="18">
                                    <h3>Indumentarias</h3>
                                    <p class="pb-3">
                                        <em
                                            >La mejor calidad en ropa de la
                                            Huasteca</em
                                        >
                                    </p>
                                    <p>
                                        Calle Nueva <br />
                                        Huejutla de Reyes<br /><br />
                                        <strong>Telefono:</strong
                                        >7716838276<br />
                                        <strong>Email:</strong>
                                        indumentariash@gmail.com<br />
                                    </p>
                                    <div>
                                        <v-btn color="#2196F3" fab x-small dark>
                                            <v-icon>mdi-twitter</v-icon>
                                        </v-btn>
                                        <v-btn color="primary" fab x-small dark>
                                            <v-icon>mdi-facebook</v-icon>
                                        </v-btn>
                                        <v-btn color="red" fab x-small dark>
                                            <v-icon>mdi-instagram</v-icon>
                                        </v-btn>
                                        <v-btn color="success" fab x-small dark>
                                            <v-icon>mdi-whatsapp</v-icon>
                                        </v-btn>
                                        <v-btn color="primary" fab x-small dark>
                                            <v-icon>mdi-linkedin</v-icon>
                                        </v-btn>
                                    </div>
                                </v-card>
                            </div>

                            <div class="col-lg-2 col-md-6 footer-links">
                                <h4>Navegacion</h4>
                                <a
                                    href="/"
                                    style="color:black; text-decoration:none"
                                    >>&nbsp;Inicio</a
                                >
                                <br />
                                <a
                                    href="/Acerca"
                                    style="color:black; text-decoration:none"
                                    >>&nbsp;Acerca de</a
                                >
                                <br />
                                <a
                                    href="/Carrito"
                                    style="color:black; text-decoration:none"
                                    >>&nbsp;Carrito</a
                                >
                                <br />
                                <a
                                    href="/chat"
                                    style="color:black; text-decoration:none"
                                    >>&nbsp;Chat</a
                                >
                                <br />
                                <li v-if="this.$store.state.auth == true">
                                    <v-form
                                        @submit.prevent="cerrarSesion"
                                        ref="form"
                                    >
                                        <button
                                            type="submit"
                                            style="backgroud-color:white; color:white;"
                                        >
                                            Cerrar sesion
                                        </button>
                                    </v-form>
                                </li>
                            </div>

                            <div class="col-lg-2 col-md-6 footer-links">
                                <h4>Categorias</h4>
                                <a
                                    :href="`/bprod?p=2`"
                                    style="color:black; text-decoration:none"
                                    >>&nbsp;Dama</a
                                >
                                <br />
                                <a
                                    :href="`/bprod?p=1`"
                                    style="color:black; text-decoration:none"
                                    >>&nbsp;Caballero</a
                                >
                                <br />
                                <a
                                    :href="`/bprod?p=3`"
                                    style="color:black; text-decoration:none"
                                    >>&nbsp;Niño</a
                                >
                                <br />
                                <a
                                    :href="`/bprod?p=Camisa`"
                                    style="color:black; text-decoration:none"
                                    >>&nbsp;Camisas</a
                                >
                                <v-list
                                    dark
                                    style="color:black; text-decoration:none"
                                >
                                    <v-list-group :value="false">
                                        <template v-slot:activator>
                                            <v-list-item-title
                                                >Mas...</v-list-item-title
                                            >
                                        </template>
                                        <v-list-item>
                                            <v-list-item-title>
                                                <a
                                                    :href="`/bprod?p=Conjunto`"
                                                    style="color:white; text-decoration:none"
                                                    >>&nbsp;Conjuntos</a
                                                >
                                            </v-list-item-title>
                                        </v-list-item>
                                        <v-list-item>
                                            <v-list-item-title>
                                                <a
                                                    :href="`/bprod?p=Blusa`"
                                                    style="color:white; text-decoration:none"
                                                    >>&nbsp;Blusas</a
                                                >
                                            </v-list-item-title>
                                        </v-list-item>
                                        <v-list-item>
                                            <v-list-item-title>
                                                <a
                                                    :href="`/bprod?p=Cubreboca`"
                                                    style="color:white; text-decoration:none"
                                                    >>&nbsp;Cubrebocas</a
                                                >
                                            </v-list-item-title>
                                        </v-list-item>
                                        <v-list-item>
                                            <v-list-item-title>
                                                <a
                                                    :href="`/bprod?p=Traje`"
                                                    style="color:white; text-decoration:none"
                                                    >>&nbsp;Trajes</a
                                                >
                                            </v-list-item-title>
                                        </v-list-item>

                                        <v-list-item>
                                            <v-list-item-title>
                                                <a
                                                    :href="`/bprod?p=Huarache`"
                                                    style="color:white; text-decoration:none"
                                                    >>&nbsp;Huaraches</a
                                                >
                                            </v-list-item-title>
                                        </v-list-item>
                                        <v-list-item>
                                            <v-list-item-title>
                                                <a
                                                    :href="`/bprod?p=Tenis`"
                                                    style="color:white; text-decoration:none"
                                                    >>&nbsp;Tenis</a
                                                >
                                            </v-list-item-title>
                                        </v-list-item>
                                    </v-list-group>
                                </v-list>
                            </div>

                            <div class="col-lg-4 col-md-6 footer-newsletter">
                                <h4>Suscribete</h4>
                                <p>
                                    Para que puedas recibir ofertas, descuentos,
                                    sorpresas y mucho mas
                                </p>
                                <form style="color:white" action="">
                                    <input
                                        style="color:white"
                                        type="email"
                                        placeholder="correo@ejemplo.com"
                                        name="email"
                                    />
                                    <v-btn color="success" type="submit">
                                        Suscribete
                                    </v-btn>
                                </form>
                            </div>
                        </div>
                    </div>
                    <v-divider />
                </div>
                <v-col class="text-center" cols="12">
                    <a href="/Aviso" style="color:black; text-decoration:none"
                        ><strong><span>Aviso de privacidad</span></strong></a
                    >
                    &copy; Copyright
                    <strong><span>Indumentarias</span></strong
                    >. All Rights Reserved
                </v-col>
            </v-row>
        </v-footer>
    </div>
</template>

<script>
export default {
    methods: {
        cerrarSesion() {
            this.$inertia.post(
                "/logout",
                {},
                {
                    onFinish: () => {
                        location.reload();
                    }
                }
            );
        }
    }
};
</script>
