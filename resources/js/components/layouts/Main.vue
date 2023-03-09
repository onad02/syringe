<template>
    <div>
        <Navbar v-bind:website_infos="website_infos"/>
        <main role="main">
            <router-view v-slot="{ Component }">
                <transition name="fade" mode="out-in">
                  <component :is="Component" />
                </transition>
            </router-view>
        </main>
        <Footer v-bind:website_infos="website_infos" v-bind:skills="skills"/>
    </div>
</template>
<script setup>
    import { ref } from 'vue'
    import Navbar from '@/components/layouts/Navbar.vue'
    import Footer from '@/components/layouts/Footer.vue'
    
    const skills = ref([]);
    const website_infos = ref([]);

    const { data } = await axios.get('/api/site-data');
    skills.value = data.skills;
    website_infos.value = data.website_infos;

</script>