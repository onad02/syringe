<template>
    <Suspense>
        <template #default>
            <Main/>
        </template>
        <template #fallback>
            <div class="overlay">
                <div class="overlayDoor"></div>
                <div class="overlayContent">
                    <div class="loader">
                        <div class="inner"></div>
                    </div>
                </div>
            </div>
        </template>
    </Suspense>    
</template>

<script setup>
    import Main from '@/components/layouts/Main.vue'
</script>

