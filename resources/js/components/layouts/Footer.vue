<template>
	<div>
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
	                     <v-form ref="form"  lazy-validation>
                              <v-text-field
                                v-model="email"
                                label="Enter Your Email"
                                :rules="emailRules"
                                type="email"
                                variant="solo"
                              ></v-text-field>

                                <v-btn
                                  :loading="processing"
                                  :disabled="processing"
                                  color="pink"  size="large" block
                                  @click="register"
                                >
                                  Get started
                                </v-btn>
                            </v-form>
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
  import { useRoute } from 'vue-router';
  export default {
        name:"default-layout",
        props: ['website_infos','skills'],
        data(){
            return {
             	processing: false,
             	email: '',
            	emailRules: [
              	v => !!v || 'E-mail is required',
              	v => /^(([^<>()[\]\\.,;:\s@']+(\.[^<>()\\[\]\\.,;:\s@']+)*)|('.+'))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(v) || 'E-mail must be valid',
            	],
            }
        },
        methods:{
          async register(){
	            const { valid } = await this.$refs.form.validate();
	            if(valid){
	                this.processing = true;
	                axios.post('/api/register',{ action: 'send-otp', email: this.email }).then(response=>{
	                		this.processing = false;
	                 		this.email = '';
								      this.$router.push({
								        name: "signup", 
								        //state: { step: 2}
								        query: { step: 2, email: this.email }
								      });
	                }).catch(({error})=>{
	                    this.processing = false;
	                });
	            }
	        },
        }	
      }
</script>
