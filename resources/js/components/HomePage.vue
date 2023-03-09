<template>
    <div>
        <section class="hero-image">
            <img :src="`https://the-syringe.com/images/${website_infos.main_image}`" class="w-100">

            <div class="hero-text">
              <h1 class="display-5 fw-bold text-danger">
                <span class="text-white">Jobs</span> | <span class="text-white">Healthcare</span>
              </h1>
            </div>
        </section>
        <section class="feature-categories">
            <div class="container">
                <div class="sec-title">
                    <h2><span>Job </span>Categories</h2>
                    <p>What Job are you looking for ?</p>
                </div>
                <v-fade-transition mode="out-in">
                    <v-row>
                        <v-col v-for="(skill, i) in skills" :key="i" cols="12" sm="12" :md="skill.sgm_id == 1 ? '12' : '4'">

                            <a href="#" class="img-box hover-effect">
                                <v-img
                                    :src="`https://the-syringe.com/images/${skill.image}?image=${i * 5 + 10}`"
                                    :lazy-src="`https://the-syringe.com/images/${skill.image}?image=${i * 5 + 10}`"
                                    aspect-ratio="1"
                                    cover
                                    class="bg-grey-lighten-2"
                                >
                                <template v-slot:placeholder>
                                      <v-row
                                        class="fill-height ma-0"
                                        align="center"
                                        justify="center"
                                      >
                                        <v-progress-circular
                                          indeterminate
                                          color="grey-lighten-5"
                                        ></v-progress-circular>
                                      </v-row>
                                    </template>
                                </v-img>

                                
                                <div class="overlay"></div>
                                <div class="listing-badges">
                                  <span class="featured">{{ skill.job_number }} Jobs</span>
                                </div>
                                <div class="img-box-content visible">
                                  <h4 class="mb-3">{{ skill.group_name }}</h4>
                                  <span>{{ skill.description }}</span>
                                </div>
                            </a>
                        </v-col>
                    </v-row>
                </v-fade-transition>   

                <div class="row justify-content-center">
                    <a href="#" class="btn btn-outline-light mt-2">View All <i class="fa fa-circle-arrow-right"></i></a>
                </div>     
            </div>
            
        </section>
        <section class="feature-categories employer-cities">
            <div class="container">
              <div class="sec-title">
                <h2>
                  <span>Employer </span>Settings
                </h2>
                <p>List of places where you can find work</p>
              </div>
               <v-fade-transition mode="out-in">
                    <v-row v-if="employer_setting.length > 0">
                    
                        <v-col class="px-2"  cols="12" sm="12" md="6" lg="4">
                          <!-- Image Box -->
                          <a href="#" class="img-box hover-effect">

                            <v-img
                                :src="`https://the-syringe.com/images/${employer_setting[0].image}`"
                                :lazy-src="`https://the-syringe.com/images/${employer_setting[0].image}`"
                                aspect-ratio="1"
                                cover
                                class="bg-grey-lighten-2"
                            >
                            <template v-slot:placeholder>
                                  <v-row
                                    class="fill-height ma-0"
                                    align="center"
                                    justify="center"
                                  >
                                    <v-progress-circular
                                      indeterminate
                                      color="grey-lighten-5"
                                    ></v-progress-circular>
                                  </v-row>
                                </template>
                            </v-img>

                            <div class="overlay"></div>
                            <div class="listing-badges">
                              <span class="featured">{{ employer_setting[0].job_number }} Jobs</span>
                            </div>
                            <div class="img-box-content visible">
                              <h4 class="mb-3">{{ employer_setting[0].settings_name }}</h4>
                            </div>
                          </a>
                        </v-col>

                        <v-col class="employer-image " cols="12" sm="12" md="6" lg="4">
                            <div class="row">
                                <div class="col-6" v-for="(setting, i) in filterEmployerSetting">
                                
                                  <a href="#" class="img-box hover-effect">

                                    <v-img
                                        :src="`https://the-syringe.com/images/${setting.image}`"
                                        :lazy-src="`https://the-syringe.com/images/${setting.image}`"
                                        aspect-ratio="1"
                                        cover
                                        class="bg-grey-lighten-2"
                                    >
                                    <template v-slot:placeholder>
                                          <v-row
                                            class="fill-height ma-0"
                                            align="center"
                                            justify="center"
                                          >
                                            <v-progress-circular
                                              indeterminate
                                              color="grey-lighten-5"
                                            ></v-progress-circular>
                                          </v-row>
                                        </template>
                                    </v-img>

                                    <div class="overlay"></div>
                                    <div class="listing-badges">
                                      <span class="featured">{{ setting.job_number }} Jobs</span>
                                    </div>
                                    <div class="img-box-content visible">
                                      <h6 class="mb-3 text-white">
                                        <strong>{{ setting.settings_name }}</strong>
                                      </h6>
                                    </div>
                                  </a>
                                </div>
                            </div>
                        </v-col>
                        

                        <v-col class="px-2" cols="12" sm="12" md="6" lg="4">
                          <a href="#" class="img-box hover-effect">
                            <v-img
                                :src="`https://the-syringe.com/images/${employer_setting[5].image}`"
                                :lazy-src="`https://the-syringe.com/images/${employer_setting[5].image}`"
                                aspect-ratio="1"
                                cover
                                class="bg-grey-lighten-2"
                            >
                            <template v-slot:placeholder>
                                  <v-row
                                    class="fill-height ma-0"
                                    align="center"
                                    justify="center"
                                  >
                                    <v-progress-circular
                                      indeterminate
                                      color="grey-lighten-5"
                                    ></v-progress-circular>
                                  </v-row>
                                </template>
                            </v-img>
                            <div class="overlay"></div>
                            <div class="listing-badges">
                              <span class="featured">{{ employer_setting[5].job_number }} Jobs</span>
                            </div>
                            <div class="img-box-content visible">
                              <h4 class="mb-3">{{ employer_setting[5].settings_name }}</h4>
                            </div>
                          </a>
                        </v-col>
                    </v-row>
                </v-fade-transition>

                <div class="row justify-content-center">
                    <a href="#" class="btn btn-outline-light mt-2">View All <i class="fa fa-circle-arrow-right"></i></a>
                </div>

            </div>
        </section>

        <section class="feature-categories who-uses">
            <div class="container">
              <div class="sec-title">
                <h2>
                  <span>Who will </span>use
                </h2>
                <p>Everyone in Healthcare</p>
              </div>
              <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6 col-sm-6 px-2">
                  <!-- Image Box -->
                  <router-link :to="{name:'signup'}" class="img-box hover-effect">

                    <v-img
                        src="https://the-syringe.com/images/jobseeker.jpg"
                        lazy-src="https://the-syringe.com/images/jobseeker.jpg"
                        height="100%"
                        cover
                        class="bg-grey-lighten-2"
                    >
                    <template v-slot:placeholder>
                          <v-row
                            class="fill-height ma-0"
                            align="center"
                            justify="center"
                          >
                            <v-progress-circular
                              indeterminate
                              color="grey-lighten-5"
                            ></v-progress-circular>
                          </v-row>
                        </template>
                    </v-img>
                    <div class="overlay"></div>
                    <div class="img-box-content visible">
                      <h4 class="mb-3">Job Seekers</h4>
                        <router-link :to="{name:'signup'}" class="btn btn-job text-white rounded-0">
                          Signup / Register
                        </router-link>
                    </div>
                  </router-link>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 px-2">
                  <!-- Image Box -->
                  <router-link :to="{name:'merchant-inquiry'}" class="img-box hover-effect">
                    <v-img
                        src="https://the-syringe.com/images/employer.jpg"
                        lazy-src="https://the-syringe.com/images/employer.jpg"

                        cover
                        class="bg-grey-lighten-2"
                    >
                    <template v-slot:placeholder>
                          <v-row
                            class="fill-height ma-0"
                            align="center"
                            justify="center"
                          >
                            <v-progress-circular
                              indeterminate
                              color="grey-lighten-5"
                            ></v-progress-circular>
                          </v-row>
                        </template>
                    </v-img>
                    <div class="overlay"></div>
                    <div class="img-box-content visible">
                      <h4 class="mb-3">Employers</h4>
                      <button class="btn btn-danger text-white rounded-0">Open free account</button>
                    </div>
                  </router-link>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 px-2">
                  <!-- Image Box -->
                   <router-link :to="{name:'agency-inquiry'}" class="img-box hover-effect">
                     <v-img
                        src="https://the-syringe.com/images/agency.jpg"
                        lazy-src="https://the-syringe.com/images/agency.jpg"

                        cover
                        class="bg-grey-lighten-2"
                    >
                    <template v-slot:placeholder>
                          <v-row
                            class="fill-height ma-0"
                            align="center"
                            justify="center"
                          >
                            <v-progress-circular
                              indeterminate
                              color="grey-lighten-5"
                            ></v-progress-circular>
                          </v-row>
                        </template>
                    </v-img>
                    <div class="overlay"></div>
                    <div class="img-box-content visible">
                      <h4 class="mb-3">Agencies</h4>
                      <button class="btn btn-success rounded-0">Send Inquiry</button>
                    </div>
                  </router-link>
                </div>
              </div>
            </div>
          </section>
    </div>
</template>


<script>
  import {mapActions} from 'vuex'
  export default {
      name:"default-layout",
      data(){
          return {
              user: this.$store.state.auth.user,
              skills: [],
              major_cities: [],
              employer_setting: [],
              website_infos: [],
              filterEmployerSetting: [],
          }
      },
      created(){
          this.data();
      },
      methods:{
          async data(){
              const { data } = await axios.get('/api/home-data');
              this.skills = data.skills;
              this.major_cities = data.major_cities;
              this.employer_setting = data.employer_setting;
              this.website_infos = data.website_infos;

              this.filterEmployerSetting = this.employer_setting.slice(1, 5);
          }
      }
  }
</script>
