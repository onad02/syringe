<template>
    <v-app>
        <Navbar v-bind:website_infos="website_infos"/>
        <v-main fill-height>
            <router-view v-slot="{ Component }">
                <transition name="fade" mode="out-in">
                  <component :is="Component" />
                </transition>
            </router-view>
        </v-main>
        <Footer v-show="currentRouteName != 'signup'" v-bind:website_infos="website_infos" v-bind:skills="skills"/>
    </v-app>
</template>

<script>
    import {mapActions} from 'vuex'
    import { useRoute } from 'vue-router';
    import Navbar from '@/components/layouts/Navbar.vue'
    import Footer from '@/components/layouts/Footer.vue'
    export default {
        name:"main",
        components: {
            Navbar, Footer
        },
        data(){
            return {
                skills: [],
                website_infos: []
            }
        } ,
        created(){
            this.data();
        },
        computed:{
            currentRouteName(){
               return useRoute().name
            }
        },
        methods:{
            async data(){
                const { data } = await axios.get('/api/site-data');
                this.skills = data.skills;
              this.website_infos = data.website_infos;
            }
        }
    }
</script>
