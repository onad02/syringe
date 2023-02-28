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
    </div>
</template>

<script setup>
    const props = defineProps({
      website_infos: Object
    });
</script>