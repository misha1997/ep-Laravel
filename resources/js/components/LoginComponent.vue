<template>
    <v-content>
      <v-container fluid>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
              <v-toolbar dark color="primary">
                <v-toolbar-title>Авторизація</v-toolbar-title>
              </v-toolbar>
              <v-card-text>
                <v-form ref="form" v-model="valid" lazy-validation>
                  <v-text-field prepend-icon="person" name="email" v-model="email" :rules="loginEmailRules" label="E-mail" type="text" required></v-text-field>
                  <v-text-field prepend-icon="lock" name="password" v-model="password" :rules="passwordRules" label="Пароль" type="password" required></v-text-field>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click.native="showRememberPassword = false">Tancar</v-btn>
                <v-btn
                        :loading="loading"
                        flat
                        :color="done ? 'green' : 'blue'"
                        @click.native="rememberPassword"
                >
                    <v-icon v-if="!done">mail_outline</v-icon>
                    <v-icon v-else>done</v-icon>
                    &nbsp;
                    <template v-if="!done">Send</template>
                    <template v-else>Done</template>
                </v-btn>
            </v-card-actions>
                </v-form>
              </v-card-text>
              <v-card-text class="pt-0">
                <v-alert v-if="error" :value="true" color="error" icon="warning" outline>
                  {{ error }}
                </v-alert>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn class="ma-2" :disabled="!valid" color="primary" :loading="loginLoading" @click="login">Увійти</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
</template>

<script>
  import * as actions from '../store/action-types'
  import validation from './mixins/validation';
  export default {
    mixins: [validation],
    data () {
      return {
        loginLoading: false,
        error: '',
        email: '',
        password: '',
        valid: false,
      }
    },
    methods: {
      login () {
        this.loginLoading = true;
        const credentials = {
          'email': this.email,
          'password': this.password
        }
        this.$store.dispatch(actions.LOGIN, credentials).then(response => {
          window.location = '/';
        }).catch(error => {
          this.error = "Помилка!";
          this.loginLoading = false;
        })
      },
    }
  }
</script>
