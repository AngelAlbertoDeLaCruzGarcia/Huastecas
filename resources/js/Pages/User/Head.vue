<template>
    <div>
        <v-navigation-drawer
            app
            v-model="drawer"
            class="pt-4"
            color="grey lighten-3"
            mini-variant
            expand
        >
            <v-btn class="d-block text-center mx-auto mb-9" icon>
                <v-icon>mdi-dots-vertical</v-icon>
            </v-btn>
        </v-navigation-drawer>
        <v-form @submit.prevent="buscarProd" class="mx-16 ">
            <v-app-bar app light src="https://picsum.photos/1920/1080?random">
                <template v-slot:img="{ props }">
                    <v-img
                        v-bind="props"
                        gradient="to top right, rgba(100,115,201,.7), rgba(25,32,72,.7)"
                    ></v-img>
                </template>

                <v-app-bar-nav-icon dark @click="drawer = !drawer" />
                <v-toolbar-title>
                    <a href="/Inicio">
                        <v-img
                            src="/assets/img/Logos/Logo2.png"
                            max-height="50"
                            max-width="60"
                        />
                    </a>
                </v-toolbar-title>
                <!-- Input Search -->
                <v-text-field
                    class="ml-5"
                    solo
                    transparent
                    hide-details
                    placeholder="Buscar"
                    prepend-inner-icon="mdi-magnify"
                    v-model="frmbuscar.buscar"
                ></v-text-field>

                <!-- Busqueda Avanzada -->
                <v-dialog v-model="dgBp" max-width="400px">
                    <template v-slot:activator="{ on: dgBp, attrs }">
                        <v-tooltip bottom>
                            <template v-slot:activator="{ on: tooltip }">
                                <v-btn
                                    icon
                                    dark
                                    v-bind="attrs"
                                    v-on="{ ...tooltip, ...dgBp }"
                                >
                                    <v-icon>mdi-feature-search</v-icon>
                                </v-btn>
                            </template>
                            <span>Busqueda Avanzada</span>
                        </v-tooltip>
                    </template>
                    <v-card elevation="18">
                        <v-form
                            @submit.prevent="buscarProdA"
                            ref="form"
                            v-model="frmbuscarAvan.valid"
                            lazy-validation
                        >
                            <v-toolbar color="success" dark
                                >Busqueda Avanzada</v-toolbar
                            >
                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12">
                                            <v-text-field
                                                label="Camisa/Conjunto/Zapatos/Blusa"
                                                v-model="frmbuscarAvan.prod"
                                                :counter="30"
                                                :rules="frmbuscarAvan.prodRules"
                                                required
                                                clearable
                                                maxlength="30"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-select
                                                v-model="frmbuscarAvan.talla"
                                                :items="frmbuscarAvan.tallas"
                                                menu-props="auto"
                                                label="Talla"
                                                hide-details
                                                single-line
                                            ></v-select>
                                        </v-col>
                                        <v-row>
                                            <v-col cols="12" sm="6">
                                                <v-text-field
                                                    type="number"
                                                    max="100000"
                                                    min="1"
                                                    label="min. $"
                                                    v-model="
                                                        frmbuscarAvan.preciomin
                                                    "
                                                    :counter="6"
                                                    :rules="
                                                        frmbuscarAvan.preciominRules
                                                    "
                                                    required
                                                    clearable
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field
                                                    type="number"
                                                    max="100000"
                                                    min="1"
                                                    label="max. $"
                                                    v-model="
                                                        frmbuscarAvan.preciomax
                                                    "
                                                    :counter="6"
                                                    :rules="
                                                        frmbuscarAvan.preciomaxRules
                                                    "
                                                    required
                                                    clearable
                                                ></v-text-field>
                                            </v-col>
                                        </v-row>
                                    </v-row>
                                </v-container>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn
                                    color="blue darken-1"
                                    text
                                    @click="dgBp = false"
                                >
                                    Cerrar
                                </v-btn>
                                <v-btn
                                    type="submit"
                                    class="ma-2"
                                    color="success"
                                    :disabled="!frmbuscarAvan.valid"
                                    :loading="loading"
                                >
                                    Buscar
                                    <v-icon dark right>
                                        mdi-checkbox-marked-circle
                                    </v-icon>
                                </v-btn>
                            </v-card-actions>
                        </v-form>
                    </v-card>
                </v-dialog>

                <!--  Menu Sesion/Registro -->
                <v-menu open-on-hover bottom left transition="fab-transition">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn icon color="success" v-bind="attrs" v-on="on">
                            <v-icon>mdi-account-circle</v-icon>
                        </v-btn>
                    </template>
                    <v-list>
                        <v-list-item v-show="!this.$store.state.auth">
                            <v-list-item-title @click="dgLogin = true">
                                <a href="#" style="color:green;"
                                    >Iniciar sesion</a
                                >
                            </v-list-item-title>
                        </v-list-item>
                        <v-list-item v-show="!this.$store.state.auth">
                            <v-list-item-title @click="dgReg = true">
                                <a href="#" style="color:green;">Registrar</a>
                            </v-list-item-title>
                        </v-list-item>
                        <v-list-item v-show="this.$store.state.auth">
                            <v-list-item-title
                                ><a href="#" style="color:green;">{{
                                    this.$store.state.datosUsuario.name
                                }}</a></v-list-item-title
                            >
                        </v-list-item>
                        <v-list-item v-show="this.$store.state.auth">
                            <v-list-item-title>
                                <v-form
                                    @submit.prevent="cerrarSesion"
                                    ref="form"
                                >
                                    <v-tooltip bottom>
                                        <template
                                            v-slot:activator="{
                                                on,
                                                attrs
                                            }"
                                        >
                                            <v-btn
                                                type="submit"
                                                icon
                                                v-bind="attrs"
                                                v-on="on"
                                            >
                                                <v-icon color="success"
                                                    >mdi-account-arrow-right-outline
                                                </v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Cerrar Sesion</span>
                                    </v-tooltip>
                                </v-form>
                            </v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-menu>

                <!-- Login-->
                <v-dialog v-model="dgLogin" max-width="410px">
                    <v-card elevation="18">
                        <div v-show="login">
                            <v-toolbar color="success" dark
                                >Iniciar Sesion</v-toolbar
                            >
                            <v-alert
                                v-if="errors.email"
                                border="right"
                                type="warning"
                                elevation="5"
                                width="400px"
                            >
                                <div>
                                    Correo o contraseña incorrecto
                                    <v-btn
                                        small
                                        fab
                                        color="#5C6BC0"
                                        dark
                                        @click="errors.email = null"
                                        >x</v-btn
                                    >
                                </div>
                            </v-alert>
                            <v-form
                                @submit.prevent="loguear"
                                ref="form"
                                v-model="frmloguear.valid"
                                lazy-validation
                            >
                                <v-card-text>
                                    <v-container>
                                        <v-row>
                                            <v-col cols="12">
                                                <v-text-field
                                                    label="Email"
                                                    v-model="frmloguear.correo"
                                                    :counter="150"
                                                    :rules="
                                                        frmloguear.correoRules
                                                    "
                                                    required
                                                    clearable
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12">
                                                <v-text-field
                                                    label="Contraseña"
                                                    v-model="frmloguear.contra"
                                                    :rules="
                                                        frmloguear.contraRules
                                                    "
                                                    :counter="30"
                                                    required
                                                    clearable
                                                    :type="
                                                        showContra
                                                            ? 'text'
                                                            : 'password'
                                                    "
                                                    :append-icon="
                                                        showContra
                                                            ? 'mdi-eye'
                                                            : 'mdi-eye-off'
                                                    "
                                                    @click:append="
                                                        showContra = !showContra
                                                    "
                                                    maxlength="30"
                                                ></v-text-field>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-card-text>
                                <v-card-actions>
                                    <v-btn
                                        color="blue darken-1"
                                        @click="chambiarlogin"
                                        text
                                        x-small
                                    >
                                        ¿Olvido su contraseña?
                                    </v-btn>
                                    <v-btn
                                        color="blue darken-1"
                                        text
                                        @click="dgLogin = false"
                                    >
                                        Cerrar
                                    </v-btn>
                                    <v-btn
                                        type="submit"
                                        class="ma-2"
                                        color="success"
                                        :disabled="!frmvalidlogin"
                                        :loading="loading"
                                    >
                                        Acceder
                                        <v-icon dark right>
                                            mdi-checkbox-marked-circle
                                        </v-icon>
                                    </v-btn>
                                </v-card-actions>
                            </v-form>
                        </div>

                        <!--- Correo a recuperar--->
                        <div v-show="recup">
                            <v-toolbar color="success" dark
                                >Recuperar Contraseña</v-toolbar
                            >
                            <v-alert
                                v-if="errors.email"
                                border="right"
                                type="warning"
                                elevation="5"
                                width="400px"
                            >
                                <div>
                                    Correo o contraseña incorrecto
                                    <v-btn
                                        small
                                        fab
                                        color="#5C6BC0"
                                        dark
                                        @click="errors.email = null"
                                        >x</v-btn
                                    >
                                </div>
                            </v-alert>
                            <v-form
                                @submit.prevent="seguirrecup"
                                ref="form"
                                v-model="frmrecup.valid"
                                lazy-validation
                            >
                                <v-card-text>
                                    <v-container>
                                        <v-row>
                                            <v-col cols="12">
                                                <p style="text-align:center">
                                                    Si olvido su contraseña,
                                                    introduzca su corrreo para
                                                    poder acceder de nuevo a la
                                                    cuenta
                                                </p>
                                                <v-text-field
                                                    label="Email"
                                                    v-model="frmloguear.correo"
                                                    :counter="150"
                                                    :rules="
                                                        frmloguear.correoRules
                                                    "
                                                    required
                                                    clearable
                                                ></v-text-field>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-card-text>
                                <v-card-actions>
                                    <v-btn
                                        color="blue darken-1"
                                        @click="backrecup"
                                        text
                                        x-small
                                    >
                                        Iniciar sesion
                                    </v-btn>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        data-dismiss="modal"
                                        color="blue darken-1"
                                        text
                                    >
                                        Cerrar
                                    </v-btn>
                                    <v-btn
                                        type="submit"
                                        class="ma-2"
                                        color="success"
                                        :disabled="!frmvalidrecup"
                                        :loading="loading"
                                    >
                                        Aceptar
                                        <v-icon dark right>
                                            mdi-checkbox-marked-circle
                                        </v-icon>
                                    </v-btn>
                                </v-card-actions>
                            </v-form>
                        </div>

                        <!--- Metodo a recuperar--->
                        <div v-show="recupM">
                            <v-toolbar color="success" dark
                                >Hola {{ datosUs.name }}</v-toolbar
                            >
                            <v-form
                                @submit.prevent="seguirrecupM"
                                ref="form"
                                v-model="frmmetod.valid"
                                lazy-validation
                            >
                                <v-card-text>
                                    <v-container>
                                        <v-row>
                                            <v-col cols="12">
                                                <p style="text-align:center;">
                                                    ¿De que manera deseas
                                                    recuperar tu contraseña?
                                                </p>
                                                <v-list rounded>
                                                    <v-list-item-group
                                                        v-model="
                                                            frmmetod.selectedItem
                                                        "
                                                        color="success"
                                                    >
                                                        <v-list-item>
                                                            <v-list-item-icon>
                                                                <v-icon
                                                                    >mdi-message-text</v-icon
                                                                >
                                                            </v-list-item-icon>
                                                            <v-list-item-content>
                                                                <v-list-item-title
                                                                    >Enviar
                                                                    <strong
                                                                        class="success--text"
                                                                        >SMS</strong
                                                                    >al cel
                                                                    ******{{
                                                                        celular
                                                                    }}
                                                                </v-list-item-title>
                                                                <v-list-item-subtitle>
                                                                    con codigo
                                                                    para
                                                                    ingresar a
                                                                    la cuenta
                                                                </v-list-item-subtitle>
                                                            </v-list-item-content>
                                                        </v-list-item>
                                                        <v-list-item>
                                                            <v-list-item-icon>
                                                                <v-icon
                                                                    >mdi-email</v-icon
                                                                >
                                                            </v-list-item-icon>
                                                            <v-list-item-content>
                                                                <v-list-item-title
                                                                    >Enviar
                                                                    E-mail a
                                                                    {{
                                                                        frmloguear.correo
                                                                    }}
                                                                </v-list-item-title>
                                                            </v-list-item-content>
                                                        </v-list-item>
                                                        <v-list-item>
                                                            <v-list-item-icon>
                                                                <v-icon
                                                                    >mdi-phone</v-icon
                                                                >
                                                            </v-list-item-icon>
                                                            <v-list-item-content>
                                                                <v-list-item-title
                                                                    ><strong
                                                                        class="primary--text"
                                                                        >Llamada
                                                                    </strong>
                                                                    al ******{{
                                                                        celular
                                                                    }}
                                                                </v-list-item-title>
                                                                <v-list-item-subtitle>
                                                                    que dictara
                                                                    un codigo
                                                                    para
                                                                    ingresar
                                                                </v-list-item-subtitle>
                                                            </v-list-item-content>
                                                        </v-list-item>
                                                    </v-list-item-group>
                                                </v-list>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-card-text>
                                <v-card-actions>
                                    <v-btn
                                        color="blue darken-1"
                                        @click="noUs"
                                        text
                                        x-small
                                    >
                                        ¿No eres tu?
                                    </v-btn>
                                    <v-spacer />
                                    <v-btn
                                        data-dismiss="modal"
                                        color="blue darken-1"
                                        text
                                    >
                                        Cerrar
                                    </v-btn>
                                    <v-btn
                                        type="submit"
                                        class="ma-2"
                                        color="success"
                                        :disabled="!frmvalidMetod"
                                        :loading="loading"
                                    >
                                        Enviar
                                        <v-icon dark right>
                                            mdi-checkbox-marked-circle
                                        </v-icon>
                                    </v-btn>
                                </v-card-actions>
                            </v-form>
                        </div>

                        <!--- SMS--->
                        <div v-show="recupSMS">
                            <v-toolbar color="success" dark
                                >Verificar SMS</v-toolbar
                            >
                            <div class="d-flex justify-content-center">
                                <v-alert
                                    v-if="errores"
                                    border="right"
                                    type="error"
                                    elevation="5"
                                    width="400px"
                                >
                                    Codigo incorrecto
                                </v-alert>
                            </div>
                            <v-form
                                @submit.prevent="verificarSMS"
                                ref="form"
                                v-model="frmverificarSMS.valid"
                                lazy-validation
                            >
                                <v-card-text>
                                    <v-container>
                                        <v-row>
                                            <v-col cols="12">
                                                <p style="text-align:center">
                                                    Ingrese codigo de
                                                    verificacion enviado a
                                                    ******{{ celular }} valido
                                                    solo por 5 minutos
                                                </p>
                                                <v-text-field
                                                    label="*****"
                                                    v-model="
                                                        frmverificarSMS.codigo
                                                    "
                                                    :counter="5"
                                                    maxlength="5"
                                                    :rules="
                                                        frmverificarSMS.codigoRules
                                                    "
                                                    required
                                                    clearable
                                                />
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-card-text>
                                <v-card-actions>
                                    <v-btn
                                        type="submit"
                                        class="ma-2"
                                        color="success"
                                        :disabled="!frmvalidSMS"
                                        :loading="loading"
                                    >
                                        Aceptar
                                        <v-icon dark right>
                                            mdi-checkbox-marked-circle
                                        </v-icon>
                                    </v-btn>
                                </v-card-actions>
                            </v-form>
                        </div>
                    </v-card>
                </v-dialog>

                <!-- Registro-->
                <v-dialog v-model="dgReg" max-width="410px">
                    <v-card elevation="18">
                        <div v-show="Reg">
                            <v-toolbar color="success" dark
                                >Registrarse</v-toolbar
                            >
                            <v-alert
                                v-if="errors.correo"
                                border="right"
                                type="warning"
                                elevation="5"
                                width="400px"
                            >
                                <div>
                                    Correo ya existe
                                    <v-btn
                                        small
                                        fab
                                        color="#5C6BC0"
                                        dark
                                        @click="errors.email = null"
                                        >x</v-btn
                                    >
                                </div>
                            </v-alert>
                            <v-form
                                @submit.prevent="buscarCorreo"
                                ref="form"
                                v-model="frmregistrar.valid"
                                lazy-validation
                            >
                                <v-card-text>
                                    <v-container>
                                        <v-row>
                                            <v-col cols="12">
                                                <v-text-field
                                                    label="Nombre"
                                                    v-model="
                                                        frmregistrar.nombre
                                                    "
                                                    :counter="150"
                                                    :rules="
                                                        frmregistrar.nombreRules
                                                    "
                                                    required
                                                    clearable
                                                />
                                            </v-col>
                                            <v-col cols="12">
                                                <v-text-field
                                                    label="Email"
                                                    v-model="frmloguear.correo"
                                                    :counter="50"
                                                    :rules="
                                                        frmloguear.correoRules
                                                    "
                                                    required
                                                    clearable
                                                />
                                            </v-col>
                                            <v-col cols="12">
                                                <v-text-field
                                                    label="Contraseña"
                                                    v-model="
                                                        frmregistrar.contra
                                                    "
                                                    :rules="
                                                        frmregistrar.contraRules
                                                    "
                                                    :counter="30"
                                                    required
                                                    clearable
                                                    :type="
                                                        showContra
                                                            ? 'text'
                                                            : 'password'
                                                    "
                                                    :append-icon="
                                                        showContra
                                                            ? 'mdi-eye'
                                                            : 'mdi-eye-off'
                                                    "
                                                    @click:append="
                                                        showContra = !showContra
                                                    "
                                                />
                                            </v-col>
                                            <v-col cols="12">
                                                <v-text-field
                                                    label="Repetir Contraseña"
                                                    v-model="
                                                        frmregistrar.contra2
                                                    "
                                                    :rules="
                                                        frmregistrar.contraRules2
                                                    "
                                                    :counter="30"
                                                    type="password"
                                                    required
                                                    clearable
                                                />
                                            </v-col>
                                            <v-col cols="12">
                                                <v-checkbox
                                                    v-model="
                                                        frmregistrar.aceptarTerms
                                                    "
                                                    :rules="[
                                                        v =>
                                                            !!v ||
                                                            'Debes aceptar para poder continuar'
                                                    ]"
                                                    color="success"
                                                    required
                                                >
                                                    <template v-slot:label>
                                                        <div
                                                            style="color:black;font-size:12px;"
                                                        >
                                                            Acepto el
                                                            <v-tooltip bottom>
                                                                <template
                                                                    v-slot:activator="{
                                                                        on
                                                                    }"
                                                                >
                                                                    <a
                                                                        target="_blank"
                                                                        href="/Aviso"
                                                                        @click.stop
                                                                        v-on="
                                                                            on
                                                                        "
                                                                        >aviso
                                                                        de
                                                                        privacidad</a
                                                                    >
                                                                </template>
                                                                Abrir en nueva
                                                                pestaña
                                                            </v-tooltip>
                                                            de Indumentarias de
                                                            la Huasteca&reg;
                                                        </div>
                                                    </template>
                                                </v-checkbox>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer />
                                    <v-btn
                                        @click="dgReg = false"
                                        color="blue darken-1"
                                        text
                                    >
                                        Cerrar
                                    </v-btn>
                                    <v-btn
                                        type="submit"
                                        class="ma-2"
                                        color="success"
                                        :disabled="!frmvalidregistrar"
                                        :loading="loading"
                                    >
                                        Registrar
                                        <v-icon dark right>
                                            mdi-checkbox-marked-circle
                                        </v-icon>
                                    </v-btn>
                                </v-card-actions>
                            </v-form>
                        </div>
                        <div v-show="!Reg">
                            <v-toolbar color="success" dark
                                >Verificar e-mail</v-toolbar
                            >
                            <div
                                v-if="frmverificar.code"
                                class="d-flex justify-content-center"
                            >
                                <v-alert
                                    border="right"
                                    type="warning"
                                    elevation="5"
                                    width="400px"
                                >
                                    Codigo Incorrecto
                                </v-alert>
                            </div>
                            <div
                                v-if="cadena == null"
                                class="d-flex justify-content-center"
                            >
                                <v-alert
                                    border="right"
                                    type="warning"
                                    elevation="5"
                                    width="400px"
                                >
                                    Codigo expirado
                                    <a href="#" @click="chambiarReg"
                                        >Volver a registrar</a
                                    >
                                </v-alert>
                            </div>
                            <v-form
                                @submit.prevent="verifyCorreo"
                                ref="form"
                                v-model="frmverificar.valid"
                                lazy-validation
                            >
                                <v-card-text>
                                    <v-container>
                                        <v-row>
                                            <v-col cols="12">
                                                <p style="text-align:center">
                                                    Ingrese el codigo de
                                                    verificacion que fue enviado
                                                    a su correo
                                                    {{ frmloguear.correo }}
                                                </p>
                                                <v-text-field
                                                    label="Codigo"
                                                    v-model="
                                                        frmverificar.codigo
                                                    "
                                                    :counter="5"
                                                    maxlength="5"
                                                    :rules="
                                                        frmverificar.codigoRules
                                                    "
                                                    required
                                                    clearable
                                                />
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-card-text>
                                <v-card-actions>
                                    <v-btn
                                        data-dismiss="modal"
                                        color="blue darken-1"
                                        text
                                    >
                                        Cerrar
                                    </v-btn>
                                    <v-btn
                                        type="submit"
                                        class="ma-2"
                                        color="success"
                                        :disabled="!frmvalidverify"
                                        :loading="loading"
                                    >
                                        Verificar
                                        <v-icon dark right>
                                            mdi-checkbox-marked-circle
                                        </v-icon>
                                    </v-btn>
                                </v-card-actions>
                            </v-form>
                        </div>
                    </v-card>
                </v-dialog>

                <v-btn color="red" dark icon>
                    <v-icon>mdi-heart</v-icon>
                </v-btn>

                <!--  Dots -->
                <v-menu bottom left transition="fab-transition">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn icon color="yellow" v-bind="attrs" v-on="on">
                            <v-icon>mdi-dots-vertical</v-icon>
                        </v-btn>
                    </template>

                    <v-list>
                        <v-list-item>
                            <v-list-item-title>
                                <v-btn @click="cambiarB">Color Blanco</v-btn>
                            </v-list-item-title>
                        </v-list-item>
                        <v-list-item>
                            <v-list-item-title>
                                <v-btn @click="cambiarA">Color Azul</v-btn>
                            </v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-menu>

                <!--  Sub -->
                <template v-slot:extension>
                    <v-tabs
                        align-with-title
                        next-icon="mdi-arrow-right-bold-box-outline"
                    >
                        <v-tab href="/Inicio" style="color:white;">
                            <v-icon>mdi-home-heart</v-icon>
                        </v-tab>
                        <v-tab>
                            <v-menu
                                open-on-hover
                                offset-y
                                transition="fab-transition"
                            >
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn
                                        text
                                        color="white"
                                        v-bind="attrs"
                                        v-on="on"
                                    >
                                        Categorias
                                    </v-btn>
                                </template>

                                <v-list>
                                    <v-list-item>
                                        <v-list-item-title>
                                            <a :href="`/bprod?p=2`">Dama</a>
                                        </v-list-item-title>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item-title>
                                            <a :href="`/bprod?p=1`"
                                                >Caballero</a
                                            >
                                        </v-list-item-title>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item-title>
                                            <a :href="`/bprod?p=3`">Niño</a>
                                        </v-list-item-title>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item-title>
                                            <a :href="`/bprod?p=Camisa`"
                                                >Camisas</a
                                            >
                                        </v-list-item-title>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item-title>
                                            <a :href="`/bprod?p=Conjunto`"
                                                >Conjuntos</a
                                            >
                                        </v-list-item-title>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item-title>
                                            <a :href="`/bprod?p=Blusa`"
                                                >Blusas</a
                                            >
                                        </v-list-item-title>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item-title>
                                            <a :href="`/bprod?p=Cubreboca`"
                                                >Cubrebocas</a
                                            >
                                        </v-list-item-title>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item-title>
                                            <a :href="`/bprod?p=Vestido`"
                                                >Vestidos</a
                                            >
                                        </v-list-item-title>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item-title>
                                            <a :href="`/bprod?p=Huarache`"
                                                >Huaraches</a
                                            >
                                        </v-list-item-title>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item-title>
                                            <a :href="`/bprod?p=Tenis`"
                                                >Tenis</a
                                            >
                                        </v-list-item-title>
                                    </v-list-item>
                                </v-list>
                            </v-menu>
                        </v-tab>

                        <v-tab href="/Carrito">
                            <v-icon color="white">mdi-cart</v-icon>
                        </v-tab>

                        <v-tab href="/chat" style="color:white;">
                            Chat
                        </v-tab>
                        <v-tab href="/contacto" style="color:white;">
                            Contacto
                        </v-tab>
                        <v-tab href="/Ayuda" style="color:white;">
                            Ayuda
                        </v-tab>
                        <v-tab href="/Acerca" style="color:white;">
                            Acerca de
                        </v-tab>
                    </v-tabs>
                </template>
            </v-app-bar>
        </v-form>
        <v-snackbar v-model="snackbar" elevation="24">
            Bienvenido {{ this.$store.state.datosUsuario.name }}

            <template v-slot:action="{ attrs }">
                <v-btn
                    color="success"
                    text
                    v-bind="attrs"
                    @click="snackbar = false"
                >
                    Close
                </v-btn>
            </template>
        </v-snackbar>
    </div>
</template>

<script>
export default {
    props: {
        datops: Object,
        errors: Object,
        mensaje: Object
    },
    data() {
        return {
            loading: false,
            snackbar: false,
            cadena: null,
            dgReg: false,
            Reg: true,
            login: true,
            recup: false,
            recupM: false,
            showContra: false,
            cambiarMsg: false,
            errores: false,
            mensaje2: "",
            datosUs: { cel: "Desconocido" },
            men: "Nuevo",
            frmloguear: {
                alert: true,
                dialog: false,
                valid: false,
                correo: null,
                correoRules: [
                    v => !!v || "E-mail es requerido",
                    v =>
                        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
                            v
                        ) || "E-mail no valido"
                ],
                contra: null,
                contraRules: [
                    v => !!v || "Contraseña es requerida",
                    v =>
                        (v && v.length > 7) ||
                        "Se requieren minimo 8 caracteres"
                ]
            },
            frmregistrar: {
                aceptarTerms: false,
                valid: true,
                nombre: null,
                nombreRules: [
                    v => !!v || "Nombre es requerido",
                    v =>
                        (v && v.length >= 10) ||
                        "Se requieren minimo 10 caracteres",
                    v =>
                        (v && v.length <= 50) ||
                        "No se permiten mas de 50 caracteres",
                    v => /^[a-zA-ZÀ-ÿ\s]+$/.test(v) || "Solo se aceptan letras"
                ],
                contra: null,
                contraRules: [
                    v => !!v || "Contraseña es requerida",
                    v =>
                        (v && v.length > 7) ||
                        "Se requieren minimo 8 caracteres",
                    v =>
                        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/.test(
                            v
                        ) ||
                        "Contraseña debe contener una letra mayúscula, un carácter numérico y un carácter especial"
                ],
                contra2: null,
                contraRules2: [
                    v => !!v || "Contraseña es requerida",
                    v =>
                        (v && v.length > 7) ||
                        "Se requieren minimo 8 caracteres",
                    v =>
                        (!!v && v) === this.frmregistrar.contra ||
                        "Contraseñas deben ser iguales"
                ]
            },
            frmverificar: {
                valid: true,
                code: false,
                codigo: "",
                codigoRules: [v => !!v || "Codigo es requerido"]
            },
            frmverificarSMS: {
                valid: true,
                codigo: "",
                codigoRules: [v => !!v || "Codigo es requerido"]
            },
            frmbuscarAvan: {
                valid: false,
                prod: null,
                prodRules: [v => !!v || "Campo requerido"],
                talla: "Chica",
                preciomin: null,
                preciominRules: [
                    v => !!v || "$ min. es requerido",
                    v => v >= 1 || "Cantidad min: 1",
                    v => v <= 100000 || "Cantidad max: 100000"
                ],
                preciomax: null,
                preciomaxRules: [
                    v => !!v || "$ max. es requerido",
                    v => v >= 1 || "Cantidad min: 1",
                    v => v <= 100000 || "Cantidad max: 100000"
                ],
                estado: null,
                tallas: ["Chica", "Mediana", "Grande", "Extra Grande"]
            },
            frmbuscar: {
                buscar: ""
            },
            frmrecup: {
                valid: false
            },
            frmmetod: {
                valid: true,
                selectedItem: 3,
                sms: false,
                call: false,
                email: false
            },
            styleObject: {
                color: "red",
                fontSize: "13px"
            },
            items: ["Inicio", "Contactanos", "Registrar", "Sesion"],
            dgBp: false,
            dgLogin: false,
            drawer: false,

            reveal: false,
            showContra: false,

            frmbuscar: {
                buscar: ""
            },
            frmbuscarA: {
                rango: [18, 70],
                estado: null
            },
            states: [
                "Aguascalientes",
                "Baja California",
                "Baja California Sur",
                "Campeche",
                "Chiapas",
                "Chihuahua",
                "Coahuila",
                "Colima",
                "Ciudad de Mexico",
                "Durango",
                "Estado de Mexico",
                "Guanajuato",
                "Guerrero",
                "Hidalgo",
                "Jalisco",
                "Michoacan",
                "Morelos",
                "Nayarit",
                "Nuevo Leon",
                "Oaxaca",
                "Puebla",
                "Queretaro",
                "Quintana Roo",
                "San Luis Potosi",
                "Sinaloa",
                "Sonora",
                "Tabasco",
                "Tamaulipas",
                "Tlaxcala",
                "Veracruz",
                "Yucatan",
                "Zacatecas"
            ]
        };
    },
    methods: {
        checar() {
            // alert(this.$store.state.auth)
            ///alert(window.location.href);
        },
        ///registrar
        buscarCorreo() {
            this.$refs.form.validate();
            if (
                this.frmregistrar.valid &&
                this.frmloguear.correo != null &&
                this.frmregistrar.nombre != null
            ) {
                this.loading = true;
                this.generarCadena(5);
                this.$inertia.post(
                    "bcorreo",
                    {
                        nombre: this.frmregistrar.nombre,
                        correo: this.frmloguear.correo,
                        cadena: this.cadena,
                        _token: this.$page.props.csrf_token
                    },
                    {
                        onFinish: () => {
                            this.loading = false;
                            if (
                                this.errors.correo == null &&
                                this.errors.nombre == null &&
                                this.errors.cadena == null
                            ) {
                                //$('#registrarModal').modal('hide')
                                this.chambiarReg();
                                setInterval(() => {
                                    this.cadena = null;
                                }, 1500000);
                            } else {
                            }
                        }
                    }
                );
            }
        },
        verifyCorreo() {
            this.loading = true;
            let cod1 = this.frmverificar.codigo;
            let cod2 = this.cadena;
            if (cod1 == cod2) {
                this.registrar();
            } else {
                this.frmverificar.code = true;
                this.loading = false;
            }
        },
        chambiarReg() {
            if (this.Reg == true) {
                this.Reg = false;
            } else if (this.Reg == false) this.Reg = true;
        },
        ///recuperacion de contra interfaces
        chambiarlogin() {
            if (this.login == true) {
                this.login = false;
                this.recup = true;
            }
        },
        ingrec() {
            this.login = true;
            this.recupM = false;
        },
        seguirrecup() {
            this.errores = false;
            this.$refs.form.validate();
            if (this.frmrecup.valid && this.frmloguear.correo != null) {
                this.loading = true;
                axios
                    .post("bcuenta", {
                        correo: this.frmloguear.correo
                    })
                    .then(response => {
                        this.loading = false;
                        if (response.status == 200) {
                            if (this.recup == true) {
                                this.recup = false;
                                this.recupM = true;
                                this.datosUs = response.data;
                            }
                        }
                    })
                    .catch(error => {
                        this.loading = false;
                        this.errores = true;
                        console.log(error);
                    });
            }
        },
        backrecup() {
            if (this.recup == true) {
                this.recup = false;
                this.login = true;
            }
        },
        noUs() {
            if (this.recupM == true) {
                this.recupM = false;
                this.login = true;
            }
        },
        seguirrecupM() {
            this.loading = true;
            switch (this.frmmetod.selectedItem) {
                case 0:
                    this.enviarSMS();
                    break;
                case 1:
                    this.enviarContra();
                    break;
                case 2:
                    this.makeCall();
                    break;
                default:
                    console.log("Opcion no valida");
            }
        },

        loguear() {
            this.$refs.form.validate();
            if (this.frmloguear.valid & (this.frmloguear.correo != null)) {
                this.loading = true;
                this.$inertia.post(
                    "login",
                    {
                        email: this.frmloguear.correo,
                        password: this.frmloguear.contra,
                        _token: this.$page.props.csrf_token
                    },
                    {
                        onFinish: () => {
                            this.loading = false;
                            if (this.errors.email == null) {
                                this.$store.dispatch("obtenerUsuario");
                                this.limpiarlogin();
                                this.dgLogin = false;
                                this.snackbar = true;
                                ///location.reload();
                            } else {
                            }
                        }
                    }
                );
            }
        },
        registrar() {
            if (this.frmloguear.correo != null) {
                this.$inertia.post(
                    "register",
                    {
                        name: this.frmregistrar.nombre,
                        email: this.frmloguear.correo,
                        password: this.frmregistrar.contra,
                        password_confirmation: this.frmregistrar.contra2,
                        _token: this.$page.props.csrf_token
                    },
                    {
                        onFinish: () => {
                            this.loading = false;
                            if (
                                (this.errors.email == null) &
                                (this.errors.password == null)
                            ) {
                                //$('#registrarModal').modal('hide')
                                this.limpiarlogin();
                                location.reload();
                            } else {
                            }
                        }
                    }
                );
            }
        },

        ///recuperacion de contra solicitudes
        enviarContra() {
            if (this.frmloguear.correo != null) {
                this.$inertia.post(
                    "/forgot-password",
                    {
                        email: this.frmloguear.correo,
                        _token: this.$page.props.csrf_token
                    },
                    {
                        onFinish: () => {
                            this.loading = false;
                            if (this.errors.correo == null) {
                                this.ingrec();
                                this.flash(
                                    "Contraseña de recuperacion enviada",
                                    "success",
                                    {
                                        timeout: 50000
                                    }
                                );
                            } else {
                            }
                        }
                    }
                );
            }
        },
        enviarSMS() {
            this.errores = false;
            axios
                .post("bcelular", {
                    cel: this.datosUs.cel
                })
                .then(response => {
                    this.loading = false;
                    if (response.status == 200) {
                        if (this.recupM == true) {
                            this.recupM = false;
                            this.recupSMS = true;
                            this.mensaje2 = response.data;
                        }
                    }
                })
                .catch(error => {
                    this.loading = false;
                    this.errores = true;
                    console.log(error);
                });
        },
        verificarSMS() {
            this.loading = true;
            this.errores = false;
            axios
                .post("verifycelular", {
                    codigo: this.frmverificarSMS.codigo,
                    id: this.datosUs.id
                })
                .then(response => {
                    this.loading = false;
                    if (response.status == 200) {
                        if (this.recupSMS == true) {
                            this.$store.dispatch("obtenerUsuario");
                            $("#loginModal").modal("hide");
                            this.limpiarlogin();
                        }
                    }
                })
                .catch(error => {
                    this.loading = false;
                    this.errores = true;
                    console.log(error);
                });
        },
        makeCall() {
            this.errores = false;
            axios
                .post("verifyCall", {
                    cel: this.datosUs.cel
                })
                .then(response => {
                    this.loading = false;
                    if (response.status == 200) {
                        alert("Llamada exitosa");
                    }
                })
                .catch(error => {
                    this.loading = false;
                    this.errores = true;
                    console.log(error);
                });
        },
        buscarProd() {
            this.$inertia.get("bprod", {
                p: this.frmbuscar.buscar
            });
        },
        buscarProdA() {
            this.$refs.form.validate();
            if (
                this.frmbuscarAvan.valid &
                (this.frmbuscarAvan.prod != null) &
                (this.frmbuscarAvan.talla != null) &
                (this.frmbuscarAvan.preciomin != null) &
                (this.frmbuscarAvan.preciomax != null)
            ) {
                this.loading = true;
                this.$inertia.post(
                    "bproda",
                    {
                        product: this.frmbuscarAvan.prod,
                        talla: this.frmbuscarAvan.talla,
                        preciomin: this.frmbuscarAvan.preciomin,
                        preciomax: this.frmbuscarAvan.preciomax,
                        _token: this.$page.props.csrf_token
                    },
                    {
                        onFinish: () => {
                            this.loading = false;
                        }
                    }
                );
            }
        },
        limpiarlogin() {
            this.frmloguear.correo = null;
            this.frmloguear.contra = null;
        },
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
        },
        generarCadena(num) {
            const characters =
                "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            let result1 = "";
            const charactersLength = characters.length;
            for (let i = 0; i < num; i++) {
                result1 += characters.charAt(
                    Math.floor(Math.random() * charactersLength)
                );
            }
            this.cadena = result1;
        }
    },
    computed: {
        frmvalidlogin() {
            return (
                this.frmloguear.correo &&
                this.frmloguear.contra &&
                this.frmloguear.valid
            );
        },
        frmvalidrecup() {
            return this.frmloguear.correo && this.frmrecup.valid;
        },
        frmvalidregistrar() {
            return (
                this.frmloguear.correo &&
                this.frmregistrar.nombre &&
                this.frmregistrar.contra &&
                this.frmregistrar.contra2 &&
                this.frmregistrar.valid &&
                this.frmregistrar.aceptarTerms
            );
        },
        frmvalidverify() {
            return this.frmverificar.codigo && this.frmverificar.valid;
        },
        frmvalidMetod() {
            return this.frmmetod.selectedItem < 3 && this.frmmetod.valid;
        },
        frmvalidSMS() {
            return this.frmverificarSMS.codigo && this.frmverificarSMS.valid;
        },
        celular: function() {
            let cad = "";
            cad = this.datosUs.cel;
            return cad.substr(-4);
        }
    }
};
</script>
