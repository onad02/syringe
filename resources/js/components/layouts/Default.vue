<template>
    <div>
        <div class="site-mobile-menu site-navbar-target">
             <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                   <span class=" js-menu-toggle"><i class="fa fa-times"></i></span>               
                </div>
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
                </ul>
            </div>
        </div>
        <nav class="site-navbar site-navbar-target fixed-top" >
             <div class="container">
                 <div class="row align-items-center position-relative py-5 py-md-3">
                     <div class="col-3 text-left order-1">
                         <div class="site-logo">
                             <a href="/" class="font-weight-bold text-danger"><img :src="'/images/'+website_infos.app_logo" alt=""></a>
                         </div>
                     </div>
                     <div class="col-5 ml-auto order-2 text-right d-none d-lg-block">
                         <form class="navbar__search">
                             <input class="form-control mr-sm-2" type="text" placeholder="Nurse, Physio, Consultants, Oncologist, Medical, Executives" aria-label="Search" id="product_name" data-autocompleturl="https://boozards.com/merchant-product/search">
                             <button class="btn btn--search" type="submit"><i class="fas fa-search"></i></button>
                         </form>
                     </div>
                     <div class="col-2 order-2 text-right d-none d-lg-block">
                         <div class="navbar__signup  text-center">
                             <a href="" class="text-white">Sign Up / Register</a>
                         </div>
                     </div>
                     <div class="col-6  order-2 text-right d-lg-none d-sm-block d-xl-none">
                         <div class="navbar__signup text-center">
                             <a href="" class="text-white">Sign Up / Register</a>
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
       
        <main role="main">
            <router-view></router-view>
        </main>

        <footer class="first-footer">
         <div class="top-footer">
            <div class="container">
               <div class="row">
                  <div class="widget col-lg-3 col-md-6">
                     <h3 class="widget-title pt-4">About {{ website_infos.company_name }}</h3>
                     <div class="netabout">
                        <p class="pt-2">{{ website_infos.app_description }}</p>
                     </div>
                     <div class="contactus">
                        <ul>
                           <li>
                              <div class="info">
                                 <i class="fa fa-map-marker" aria-hidden="true"></i>
                                 <p class="in-p">{{ website_infos.location }}</p>
                              </div>
                           </li>
                           <li>
                              <div class="info">
                                 <i class="fa fa-phone" aria-hidden="true"></i>
                                 <p class="in-p">{{ website_infos.mobile_number }}</p>
                              </div>
                           </li>
                           <li>
                              <div class="info">
                                 <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                                 <p class="in-p">{{ website_infos.whats_app }}</p>
                              </div>
                           </li>
                           <li>
                              <div class="info">
                                 <i class="fa fa-envelope" aria-hidden="true"></i>
                                 <p><a :href="'mailto:'+website_infos.email_id" class="in-p ti">{{website_infos.email_id}}</a></p>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                     <div class="widget quick-link clearfix">
                        <h3 class="widget-title pt-4">Quick Links</h3>
                        <div class="quick-links">
                           <ul class="one-half mr-2 p-0">
                              <li><a href="#"> <i class="fa fa-angle-double-right fa-sm"></i> Job Categories</a></li>
                              <li><a href="#"><i class="fa fa-angle-double-right fa-sm"></i> Sign Up/Register</a></li>
                           </ul>
                           <ul class="one-half p-0">
                              <li><a href="#"><i class="fa fa-angle-double-right fa-sm"></i> Agencies</a></li>
                              <li><a href="#"><i class="fa fa-angle-double-right fa-sm"></i> Employers</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                     <div class="widget pt-4">
                        <h3>Job Categories</h3>
                        <ul class="photo">
                           <li class="hover-effect" v-for="(skill, i) in skills">
                             <a :href="skill.app_link" class="text-dark">{{ skill.group_name.substring(0, 12) }}..</a>
                             <figure>
                                <a :href="skill.app_link">
                                    <img :src="'images/'+skill.image" alt="">
                                </a>
                             </figure>
                          </li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                     <div class="widget newsletters pt-4">
                        <h3>Jobseekers</h3>
                        <p>Sign Up and be part of our community of Healthcare Jobs around the world. Please type your email and press get started.</p>
                     </div>
                     <form class="bloq-email mailchimp form-inline" method="post" novalidate="true">
                        <label for="subscribeEmail" class="error"></label>
                        <div class="email">
                           <input type="email" id="subscribeEmail" name="EMAIL" placeholder="Enter Your Email">
                           <input type="button" value="Get started">
                           <p class="subscription-success"></p>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="second-footer">
            <div class="container">
               <p class="mb-0">
                  <!-- <a href="#" class="text-white">Terms & Policies</a> &nbsp; <a href="#" class="text-white">Privacy Policy</a>.  -->
                  
               </p>
               <ul class="netsocials">
                  <li><a :href="website_infos.facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
                  <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                  <li><a :href="website_infos.instagram"><i class="fa-brands fa-instagram"></i></a></li>
                  <li><a :href="website_infos.youtube"><i class="fa-brands fa-youtube"></i></a></li>
               </ul>
            </div>
         </div>
      </footer>
      
      <div class="shop">
         <div class="item">
            <a href="" class="btn btn-warning mr-2 py-2 px-4 top-button">Employers</a>
            <a class="btn btn-danger mr-1 py-2 px-4 top-button">Agencies</a>
         </div>
      </div>
      <a onclick='window.scrollTo({top: 0, behavior: "smooth"});' class="go-up" style="display: inline;">
      <i class="fa fa-angle-double-up" aria-hidden="true"></i>
      </a>
    </div>
</template>

<script>
import {mapActions} from 'vuex'
export default {
    name:"default-layout",
    data(){
        return {
            user:this.$store.state.auth.user,
            skills: {},
            major_cities: {},
            employer_setting: {},
            website_infos: {},
        }
    },
    created() {
        this.siteData();
    },
    methods: {
         ...mapActions({
            signOut:"auth/logout"
        }),
        async logout(){
            await axios.post('/logout').then(({data})=>{
                this.signOut()
                this.$router.push({name:"login"})
            })
        },
        siteData() {
            axios.get('/api/site-data').then((response) => {
                this.skills = response.data.skills;
                this.website_infos = response.data.website_infos;
            });
        }
    }
}
</script>