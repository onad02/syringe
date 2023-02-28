<template>
    <Suspense>
        <template #default>
            <Main/>
        </template>
        <template #fallback>
            <v-overlay :value="overlay">
              <v-progress-circular indeterminate size="64"></v-progress-circular>
            </v-overlay>
        </template>
    </Suspense>    
</template>

<script setup>
    import Main from '@/components/layouts/Main.vue'
</script>

