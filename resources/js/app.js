/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import '../sass/app.scss'
import { createApp } from 'vue';
import Router from '@/router';
import store from '@/store';
// Vuetify
import "vuetify/styles";
import "@mdi/font/css/materialdesignicons.min.css";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import { aliases, fa } from 'vuetify/iconsets/fa'
import { mdi } from 'vuetify/iconsets/mdi'

import { VueMaskDirective } from 'v-mask';

const vMaskV2 = VueMaskDirective;
const vMaskV3 = {
    beforeMount: vMaskV2.bind,
    updated: vMaskV2.componentUpdated,
    unmounted: vMaskV2.unbind
};

import axios from 'axios'
import {UniversalSocialauth} from 'universal-social-auth'
const options = {
  providers: {
    google: {
      clientId: '508636168520-sedcjq1iqbiiprq60e0mdbs2t1i87rvd.apps.googleusercontent.com',
      redirectUri: 'https://the-syringe.com/auth/google/callback'
    },
    facebook: {
      clientId: '531929842356807',
      redirectUri: 'https://the-syringe.com/auth/facebook/callback'
    },
    linkedin: {
      clientId: '77031j3glcm689',
      redirectUri: 'https://the-syringe.com/auth/linkedin/callback'
    }
  }
}

const Oauth = new UniversalSocialauth(axios, options)

import 'maz-ui/css/main.css'

const vuetify = createVuetify({
  components,
  directives,
  icons: {
    defaultSet: 'fa',
    aliases,
    sets: {
      fa,
      mdi,
    }
  },
});

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});
app.use(Router);
app.use(store);
app.use(vuetify);
app.use(Oauth, Oauth);
app.directive('mask', vMaskV3)

app.config.globalProperties.$Oauth = Oauth;


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
