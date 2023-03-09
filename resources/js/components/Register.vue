<template>

    <div class="d-flex align-center flex-column h-100 bg-signup">
       <v-container  class="px-0">
            <v-row align="center">
                <v-col class="pa-0 pa-md-5" align-self="center" cols="12" sm="12" md="12" lg="8" offset-lg="2">
                    <v-sheet class="mx-auto p-3"  width="100%" >
                        <v-row align="center" no-gutters v-if="step == 1" transition="slide-x-transition">
                          <v-col cols="12" sm="12" md="6" class="justify-center align-center pa-5">
                            <h3>Email ID</h3>
                            <p>Please enter your email and press Continue</p>
                            <v-form ref="form" class="mx-2" lazy-validation>
                              <v-text-field
                                v-model="email"
                                label="Email Address"
                                :rules="emailRules"
                                type="email"
                                variant="solo"
                              ></v-text-field>

                                <v-btn
                                  :loading="processing"
                                  :disabled="processing"
                                  color="pink"  size="large" block class="mt-2"
                                  @click="register"
                                >
                                  Continue
                                </v-btn>
                            </v-form>
                          </v-col>
                          <v-divider class="border-opacity-75 d-none d-sm-block" color="grey" vertical></v-divider>
                          <v-divider  class="border-opacity-75 d-block d-sm-none" color="grey"></v-divider>
                          <v-col cols="12" sm="12" md="6" class="justify-center align-center text-center pa-5">
                            <h3>Social Media</h3>
                            <p>Please select anyone from below</p>
                            <v-row justify="space-between" class="text-center">
                              <v-col>
                                <v-btn
                                  icon="fa-brands fa-facebook-f"
                                  color="blue"
                                ></v-btn>
                              </v-col>

                              <v-col>
                                <v-btn
                                  icon="fa-brands fa-google-plus-g"
                                  color="red"
                                ></v-btn>
                              </v-col>

                              <v-col>
                                <v-btn
                                  icon="fa-brands fa-linkedin-in"
                                  color="light-blue"
                                ></v-btn>
                              </v-col>

                             
                            </v-row>
                          </v-col>
                        </v-row>
                        <v-row align="center" no-gutters v-else-if="step == 2" transition="slide-x-transition">
                          <v-col cols="12" sm="12" md="6" class="justify-center align-center pa-5">
                            <h3 class="mb-5">Step 1 - Email Verification</h3>
                            
                            <v-form ref="form_otp" class="mx-2" lazy-validation>

                                
                                    
                                        <v-alert transition="slide-y-reverse-transition" v-model="otp_error"  closable   class="mb-2"  type="error" text="Invalid OTP"></v-alert>
                                   
                                  
                                        <v-alert transition="slide-y-reverse-transition" v-model="otp_resend"  closable  class="mb-2"  type="success" text="Otp successfully resend!"></v-alert>
                                    
                                
                                    
                                    

                                <v-text-field
                                    v-model="email"
                                    label="Email Address"
                                    type="email"
                                    variant="solo"
                                    readonly
                                ></v-text-field>
                                 <v-row justify="space-between" >
                                        <v-col cols="12" sm="12" md="8">
                                            <v-text-field
                                              v-model="otp"
                                              label="OTP"
                                              type="input"
                                              variant="solo"
                                              :rules="[v => !!v || 'OTP is required']"
                                              hide-details="auto"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="4">
                                            <v-btn variant="text" color="blue"
                                              :loading="processing"
                                              :disabled="resend_disable"
                                              size="large" block class="mt-2"
                                              @click="resendOTP"
                                            >
                                              Resend OTP
                                            </v-btn>
                                        </v-col>
                                </v-row>
                                
                                    
                                    <v-row justify="space-between">
                                        <v-col cols="12" sm="12" md="8">
                                            <v-btn
                                              :loading="processing_otp"
                                              :disabled="processing_otp"
                                              color="pink"  size="large" block class="mt-2"
                                              @click="verifyOTP"
                                            >
                                              Next
                                            </v-btn>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="4">
                                            <v-btn variant="text" color="blue" size="large" block  class="mt-2" @click="step = 1">
                                              Back
                                            </v-btn>
                                        </v-col>
                                    </v-row>
                               
                            </v-form>
                          </v-col>
                          <v-divider class="border-opacity-75 d-none d-sm-block" color="grey" vertical></v-divider>
                          <v-col cols="12" sm="12" md="6" class="justify-center align-center text-center pa-10 d-none d-md-block">
                   
                            <h3>Please check your email as we have sent an OTP to verify it.</h3>
                            
                          </v-col>
                        </v-row>
                        <v-row align="center" no-gutters v-else-if="step == 3" transition="slide-x-transition">
                          <v-col cols="12" sm="12" md="6" class="justify-center align-center pa-5">
                            <h3 class="mb-5">Step 2 - Personal Details</h3>
                            <v-form ref="form_personal_details" class="mx-2" lazy-validation>
                                <v-row align="center" justify="space-between" no-gutters>
                                    <v-col cols="4" align="start">
                                        <b>Name</b>
                                    </v-col>
                                    <v-col cols="8" align="end">
                                        <v-radio-group class="pa-5" hide-details="auto" v-model="gender" inline :rules="[v => !!v || 'Gender is required']">
                                        <v-spacer></v-spacer>
                                          <v-radio hide-details="auto"
                                            label="Male"
                                            value="M"
                                            color="pink"
                                          ></v-radio>
                                          <v-radio hide-details="auto"
                                            label="Female"
                                            value="F"
                                            color="pink"
                                          ></v-radio>
                                        </v-radio-group>
                                    </v-col>
                                </v-row>

                                <v-text-field
                                    v-model="name"
                                    variant="solo"
                                    :rules="nameRules"
                                ></v-text-field>

                                <b>Mobile Number</b>
                                <MazPhoneNumberInput
                                    v-model="mobile_number"
                                    show-code-on-list
                                    color="info"
                                    :default-country-code="'SG'"
                                    :preferred-countries="['SG', 'BD', 'IN', 'MY', 'GB', 'PH']"
                                    @update="phoneEvent = $event"
                                    :success="phoneEvent?.isValid"
                                    size="lg"
                                />
                                <br>
                                <v-row align="center" justify="space-between" no-gutters>
                                    <v-col cols="5" sm="4" md="8"  align="start">
                                        <b>What's App</b>
                                    </v-col>
                                    <v-col cols="7" sm="8" md="4" align="center">
                                        <v-checkbox v-model="same_phone" color="pink"   @change="sameAsPhone" hide-details="auto"  label="Same as Mobile #"></v-checkbox>
                                    </v-col>
                                </v-row>
                                <MazPhoneNumberInput
                                    v-model="whats_app"
                                    show-code-on-list
                                    color="info"
                                    :default-country-code="'SG'"
                                    :preferred-countries="['SG', 'BD', 'IN', 'MY', 'GB', 'PH']"
                                    :disabled="same_phone"
                                    size="lg"
                                />
                                 <br>
                                 <v-btn
                                  :loading="processing"
                                  :disabled="processing"
                                  color="pink"  size="large" block class="mt-2"
                                  @click="personalDetails"
                                >
                                  Next
                                </v-btn>
                               
                            </v-form>
                          </v-col>
                          <v-divider class="border-opacity-75 d-none d-sm-block" color="grey" vertical></v-divider>
                          <v-col cols="12" sm="12" md="6" class="justify-center align-center text-center pa-10 d-none d-md-block">
                   
                            <h3>Please enter your personal details and press Next to continue.</h3>
                            
                          </v-col>
                        </v-row>
                        <v-row align="center" no-gutters v-else-if="step == 4" transition="slide-x-transition">
                          <v-col cols="12" sm="12" md="6" class="justify-center align-center pa-5">
                            <h3 class="mb-5">Step 3 - Additional Security</h3>
                            <v-form ref="form_additional_security" class="mx-2" lazy-validation>
                                 <v-text-field v-model="password" type="password"  label="Password" variant="solo" :rules="passwordRules"> </v-text-field>   
                                 <br>
                                 <v-text-field v-model="confirm_password" type="password"  label="Confirm Password" variant="solo" :rules="passwordConfirmRules"> </v-text-field>   
                                 <v-btn
                                  :loading="processing"
                                  :disabled="processing"
                                  color="pink"  size="large" block class="mt-2"
                                  @click="additionalSecurity"
                                >
                                  Next
                                </v-btn>
                               
                            </v-form>
                          </v-col>
                          <v-divider class="border-opacity-75 d-none d-sm-block" color="grey" vertical></v-divider>
                          <v-col cols="12" sm="12" md="6" class="justify-center align-center text-center pa-10 d-none d-md-block">
                            <h3>Please create a password so you can use that to login.</h3>
                          </v-col>
                        </v-row>
                        <v-row align="center" no-gutters v-else-if="step == 5" transition="slide-x-transition">
                          <v-col cols="12" sm="12" md="6" class="justify-center align-center pa-5">
                            <h3 class="mb-5">Step 4 - Where are you located?</h3>
                            <v-form ref="form_location" class="mx-2" lazy-validation>
                                 
                                <v-combobox
                                    item-title="country_name"
                                    item-value="country_id"
                                    return-object
                                    v-model="country"
                                    :items="countries"
                                    label="Select Country"
                                    variant="solo"
                                    :rules="[v => !!v || 'Country is required']"
                                ></v-combobox>
                                <br>
                                <v-combobox
                                    item-title="city_name"
                                    item-value="city_id"
                                    return-object
                                    v-model="city"
                                    :items="cities"
                                    label="Select City"
                                    variant="solo"
                                    :rules="[v => !!v || 'City is required']"
                                ></v-combobox>

                                <br>
                                <v-combobox
                                    item-title="town_name"
                                    item-value="town_id"
                                    return-object
                                    v-model="town"
                                    :items="towns"
                                    label="Select Town"
                                    variant="solo"
                                    :rules="[v => !!v || 'Town is required']"
                                ></v-combobox>
                                <br>

                                 <v-btn
                                  :loading="processing"
                                  :disabled="processing"
                                  color="pink"  size="large" block class="mt-2"
                                  @click="location"
                                >
                                  Next
                                </v-btn>
                               
                            </v-form>
                          </v-col>
                          <v-divider class="border-opacity-75 d-none d-sm-block" color="grey" vertical></v-divider>
                          <v-col cols="12" sm="12" md="6" class="justify-center align-center text-center pa-10 d-none d-md-block">
                            <h3>Where are you currently, which country, city and town?</h3>
                          </v-col>
                        </v-row>
                        <v-row align="center" no-gutters v-else-if="step == 6" transition="slide-x-transition">
                          <v-col cols="12" sm="12" md="6" class="justify-center align-center pa-5">
                            <h3 class="mb-5">Step 5 - Additional Information</h3>
                            <v-form ref="form_additional_info" class="mx-2" lazy-validation>
                                 
                                 <v-combobox
                                    item-title="nationality"
                                    item-value="country_id"
                                    return-object
                                    v-model="nationality"
                                    :items="countries"
                                    label="Nationality"
                                    variant="solo"
                                    :rules="[v => !!v || 'Nationality is required']"
                                ></v-combobox>
                                <br>
                                <v-combobox
                                    item-title="country_name"
                                    item-value="country_id"
                                    return-object
                                    v-model="passport_country"
                                    :items="countries"
                                    label="Passport Country"
                                    variant="solo"
                                    :rules="[v => !!v || 'Passport Country is required']"
                                ></v-combobox>
                                <br>
                                <v-text-field
                                    label="DD/MM/YYYY"
                                    v-model="birth_date"
                                    v-mask="'##/##/####'"
                                    variant="solo"
                                    :rules="[v => !!v || 'Date of Birth is required']"
                                ></v-text-field>
                                <br>
                                <v-btn
                                  :loading="processing"
                                  :disabled="processing"
                                  color="pink"  size="large" block class="mt-2"
                                  @click="additionalInformation"
                                >
                                  Next
                                </v-btn>
                               
                            </v-form>
                          </v-col>
                          <v-divider class="border-opacity-75 d-none d-sm-block" color="grey" vertical></v-divider>
                          <v-col cols="12" sm="12" md="6" class="justify-center align-center text-center pa-10 d-none d-md-block">
                            <h3>Please enter additional information in regards to your Nationlity, Passport Country and Date of Birth.</h3>
                          </v-col>
                        </v-row>
                        <v-row align="center" no-gutters v-else-if="step == 7" transition="slide-x-transition">
                          <v-col cols="12" sm="12" md="12" class="justify-center align-center pa-5">
                            <h3 class="mb-5">Step 6 - Select Skills</h3>
                            <v-form ref="form_additional_security" class="mx-2" lazy-validation>
                                 <v-radio-group v-model="skill" inline >
                                    
                                    <v-radio class="skills" v-for="skill in skills" :key="skill.group_name" :value="skill.sgm_id" color="pink"><template v-slot:label>

                                            <v-sheet  class="fill-height fill-width pa-2" fluid style="min-height: 75px; width: 140px;">
                                                <small>{{ skill.group_name }}</small>
                                                <v-img height="75" cover :src="`/images/${skill.image}`"></v-img>
                                            </v-sheet>
                                        
                                        </template
                                      ></v-radio
                                    >
                                  </v-radio-group>

                                   <v-row justify="space-between" class="text-center">
                                        <v-col cols="12" sm="12" md="6">
                                             <v-btn
                                              :loading="processing"
                                              :disabled="processing"
                                              color="pink"  size="large" block class="mt-2"
                                              @click="processRegister"
                                            >
                                              Next
                                            </v-btn>
                                        </v-col>
                                    </v-row>

                                
                               
                            </v-form>
                          </v-col>
                          
                        </v-row>
                        <v-row align="center" no-gutters v-else-if="step == 8" transition="slide-x-transition">
                          <v-col cols="12" sm="12" md="12" class="justify-center align-center pa-5">
                            <h3 class="mb-5">Hi {{ name }}</h3>
                            <p>You have successfully registerd in The-Syringe, a marketplace for Healthcare jobs around the world.</p>
                            <p>Goodluck in your job hunt !!!</p>

                            <v-row justify="space-between" class="text-center">
                                <v-col cols="12" sm="12" md="6">
                                     <router-link :to="{name:'home'}">
                                       <v-btn color="blue" block class="mt-2">Homepage</v-btn>
                                    </router-link>
                                </v-col>
                            </v-row>

                            
                          </v-col>
                        </v-row>
                  </v-sheet>
                </v-col>
            </v-row>
        </v-container>    
    </div>

</template>

<script>
import { mapActions } from 'vuex'
import MazPhoneNumberInput from 'maz-ui/components/MazPhoneNumberInput'
export default {
    name:'register',
    components: {
        MazPhoneNumberInput
    },
    props: ['data'],
    data(){
        return {
            countries: [],
            cities: [],
            towns: [],
            skills: [],
            email: '',
            emailRules: [
              v => !!v || 'E-mail is required',
              v => /^(([^<>()[\]\\.,;:\s@']+(\.[^<>()\\[\]\\.,;:\s@']+)*)|('.+'))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(v) || 'E-mail must be valid',
            ],
            otp: '',
            otp_error: false,
            otp_resend: false,
            resend_disable: false,
            name: '',
            nameRules: [
                v => !!v || 'Name is required',
                v => (v && v.length <= 50) || 'Name must be less than 50 characters',
            ],
            gender: '',
            phoneEvent: '',
            mobile_number: '',
            same_phone: false,
            whats_app: '',
            password: '',
            confirm_password: '',
            passwordRules: [
                v => !!v || "Password required",
                v => (v && v.length > 8) || 'Password min of 8 characters',
            ],
            passwordConfirmRules: [
                v => !!v || "Confirm password",
                v => v === this.password || "Passwords do not match"
            ],
            country: '',
            city: '',
            town: '',
            nationality: '',
            passport_country: '',
            birth_date: '',
            skill: '',
            processing: false,
            processing_resend: false,
            processing_otp: false,
            step: 1,
        }
    },
    created(){
        this.countryData();
        this.skillsData();
        if(this.$route.query.step && this.$route.query.email){
            this.step = 2;
            this.email = this.$route.query.email;
        }
    },
    watch: {
        country: function(val) {
            this.cities = [];
            this.city = '';

            axios.get('/api/city',{ params: {country_id: val.country_id} }).then(response=>{
                this.cities = response.data.cities;
                this.towns = [];
                this.town = '';
            }).catch(({error})=>{
                 console.log(error)
            });
        },
        city: function(val) {
            axios.get('/api/town',{ params: {city_id: val.city_id} }).then(response=>{
                this.towns = response.data.towns;
            }).catch(({error})=>{
                 console.log(error)
            });
        }
    },
    methods:{
        ...mapActions({
            signIn:'auth/login'
        }),
        async processRegister(){
            const user = {
                email: this.email,
                name: this.name,
                password: this.password,
                password_confirmation: this.confirm_password,
                gender: this.gender,
                mobile_number: this.mobile_number,
                whats_app: this.whats_app,
                country: this.country,
                city: this.city,
                town: this.town,
                nationality: this.nationality.country_id ,
                passport: this.passport_country.country_id,
                birth_date: this.birth_date,
                skill: this.skill,
            }
            await axios.get('/sanctum/csrf-cookie')
            await axios.post('/register',user).then(response=>{
                this.signIn();
                this.step = 8;
            }).catch(({response})=>{
                console.log(response);
            });
        },
        async countryData(){
            await axios.get('/api/countries').then(response=>{
                this.countries = response.data.countries;
            }).catch(({error})=>{
                 console.log(error)
            });
        },
        async skillsData(){
            await axios.get('/api/skills').then(response=>{
                this.skills = response.data.skills;
            }).catch(({error})=>{
                 console.log(error)
            });
        },
        async register(){
            const { valid } = await this.$refs.form.validate();
            if(valid){
                this.processing = true;
                axios.post('/api/register',{ action: 'send-otp', email: this.email }).then(response=>{
                    this.processing = false;
                    this.step = 2;
                }).catch(({error})=>{
                     console.log(error)
                });
            }
        },
        async resendOTP(){
            this.processing = true;
            this.resend_disable = true;
            axios.post('/api/register',{ action: 'send-otp', email: this.email }).then(response=>{
                this.processing = false;
                this.otp_resend = true;
                setTimeout(() => this.resend_disable = false, 60000);
                //setTimeout(() => this.otp_resend = false, 5000);
            }).catch(({error})=>{
                this.processing = false;
                setTimeout(() => this.resend_disable = false, 60000);
            });
        },
        async verifyOTP(){
            const { valid } = await this.$refs.form_otp.validate();
            if(valid){
                this.processing_otp = true;
                axios.post('/api/register',{ action: 'verify-otp', email: this.email, otp: this.otp }).then(response=>{
                    this.processing_otp = false;
                    this.step = 3;
                }).catch(({error})=>{
                    this.processing_otp = false;
                    this.otp_error = true;
                    //setTimeout(() => this.otp_error = false, 5000);
                });
            }
        },
        async personalDetails(){
            const { valid } = await this.$refs.form_personal_details.validate();
            if(valid){
                this.step = 4;
            }
        },
        async additionalSecurity(){
            const { valid } = await this.$refs.form_additional_security.validate();
            if(valid){
                this.step = 5;
            }
        },
        async location(){
            const { valid } = await this.$refs.form_location.validate();
            if(valid){
                this.step = 6;
            }
        },
        async additionalInformation(){
            const { valid } = await this.$refs.form_additional_info.validate();
            if(valid){
                this.step = 7;
            }
        },
        sameAsPhone(e){
            if(this.same_phone){
                this.whats_app = this.mobile_number;
            } else {
                 this.whats_app = '';
            }
        }
    }
}
</script>