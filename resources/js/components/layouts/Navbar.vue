<template>
    <div>
        <div class="site-mobile-menu site-navbar-target">
             <div class="site-mobile-menu-header" v-if="authenticated">
                <v-row no-gutters align="center">
                    <v-col cols="4">
                      <v-avatar image="/images/man.png" size="x-large"></v-avatar>
                    </v-col>
                    <v-col cols="8">
                        <h5 class="mb-0 text-white">{{ user.applicant_name }}</h5>
                    </v-col>
                  </v-row>
             </div>
             <div class="site-mobile-menu-header" v-else>
                <router-link :to="{name:'signup'}" class="nav-link"> Sign Up / Register
                </router-link>
             </div>
             <div class="site-mobile-menu-body">
                <ul class="site-nav-wrap">
                    <li class="active">
                        <router-link :to="{name:'home'}" class="nav-link">
                            <img src="https://the-syringe.com/images/menu/menu-home.png" alt="" class="w-20"> Home
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{name:'merchant-inquiry'}" class="nav-link">
                            <img src="https://the-syringe.com/images/menu/menu-home.png" alt="" class="w-20"> Employer
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{name:'agency-inquiry'}" class="nav-link">
                            <img src="https://the-syringe.com/images/menu/menu-merchants" alt="" class="w-20"> Agency
                        </router-link>
                    </li>
                    <li v-show="authenticated">
                        <v-btn  color="red"  block  @click="logout">Logout</v-btn>
                    </li>
                </ul>
            </div>
        </div>



        <nav class="site-navbar site-navbar-target fixed-top elevation-1" >
            <div class="container" v-if="currentRouteName == 'signup' ">
                <div class="d-flex justify-space-between  bg-surface-variant">
                  <v-sheet class="py-5 py-md-3">
                    <div class="site-logo">
                        <router-link :to="{name:'home'}" class="font-weight-bold text-danger">
                            <img :src="'/images/'+website_infos.app_logo" alt="">
                        </router-link>
                     </div>
                  </v-sheet>

                  <v-sheet class="py-5 py-md-3">
                    <span class="d-inline-block d-lg-block">
                             <a class="navbar__burger js-menu-toggle">
                                <img src="/images/man.png" class="avatar"> 
                                <img src="/images/menu.png" alt="profile-burger" class="menu-arrow"/>
                            </a>
                         </span>   
                  </v-sheet>
                </div>
              </div>
             <div class="container" v-else>
                 <div class="row align-items-center position-relative py-5 py-md-3">
                     <div class="col-3 text-left order-1">
                         <div class="site-logo">
                            <router-link :to="{name:'home'}" class="font-weight-bold text-danger">
                                <img :src="'/images/'+website_infos.app_logo" alt="">
                            </router-link>
                         </div>
                     </div>
                     <div class="col-5 ml-auto order-2 text-right d-none d-lg-block">
                         <form class="navbar__search">
                             <input class="form-control mr-sm-2" type="text" placeholder="Nurse, Physio, Consultants, Oncologist, Medical, Executives" aria-label="Search" id="product_name" data-autocompleturl="https://boozards.com/merchant-product/search">
                             <button class="btn btn--search" type="submit"><i class="fas fa-search"></i></button>
                         </form>
                     </div>
                     <div class="col-2 order-2 text-right d-none d-lg-block">
                         <div class="text-center" v-if="authenticated">
                            <v-btn  color="red"  block  @click="logout">Logout</v-btn>
                         </div>
                         <div class="navbar__signup  text-center"  v-else>
                            <router-link :to="{name:'signup'}" class="text-white">Sign Up / Register</router-link>
                         </div>
                     </div>
                     <div class="col-6  order-2 text-right d-lg-none d-sm-block d-xl-none">
                         <div class="text-center" v-if="authenticated">
                            <v-btn  color="red"  block @click="logout">Logout</v-btn>
                         </div>
                         <div class="navbar__signup  text-center"  v-else>
                            <router-link :to="{name:'signup'}" class="text-white">Sign Up / Register</router-link>
                         </div>
                     </div>
                     
                     <div class="col-2 order-2 text-right">
                         <span class="d-inline-block d-lg-block">
                             <a class="navbar__burger js-menu-toggle">
                                <img src="/images/man.png" class="avatar"> 
                                <img src="/images/menu.png" alt="profile-burger" class="menu-arrow"/>
                            </a>
                         </span>                        
                     </div>

                     <div class="col-11 mr-auto ml-auto order-2 mt-5 text-right d-lg-none d-sm-block d-xl-none">
                         <form class="navbar__search">
                             <input class="form-control mr-sm-2" type="text" placeholder="Nurse , Physio, Therapist , Oncologist, Medical, Executives" aria-label="Search" id="product_name" data-autocompleturl="https://boozards.com/merchant-product/search">
                             <button class="btn btn--search" type="submit"><i class="fas fa-search"></i></button>
                         </form>
                     </div>
                 </div>
              </div>
              
        </nav>
    </div>
</template>


<script>
  import {mapActions} from 'vuex'
  import { useRoute } from 'vue-router';
  export default {
        name:"default-layout",
        props: ['website_infos'],
        data(){
            return {
             
            }
        },
        computed:{
            currentRouteName(){
               return useRoute().name
            },
            authenticated(){
                return this.$store.state.auth.authenticated;
            },
            user(){
                return this.$store.state.auth.user;
            }
        },
        methods:{
            ...mapActions({
                signOut:"auth/logout"
            }),
            async logout(){
                await axios.post('/logout').then(({data})=>{
                    this.signOut()
                    this.$router.push({name:"home"});
              })
            },
        }
      }
</script>