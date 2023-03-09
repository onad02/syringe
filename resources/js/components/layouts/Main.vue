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
<script setup>
    import { ref, computed } from 'vue'
    import { useRouter } from 'vue-router';
    import Navbar from '@/components/layouts/Navbar.vue'
    import Footer from '@/components/layouts/Footer.vue'
    
    const skills = ref([]);
    const website_infos = ref([]);

    const currentRouteName = computed(() => {
      return useRouter().currentRoute.value.name;
    })

    const { data } = await axios.get('/api/site-data');
    skills.value = data.skills;
    website_infos.value = data.website_infos;

</script>