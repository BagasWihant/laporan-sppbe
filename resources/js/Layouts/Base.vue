<template>
    
    <div class="flex flex-nowrap">
        <SidebarXL />

        <!-- SIDEBAR PHONE -->
        <div class="container mx-auto p-2 h-64 md:w-4/5 md:px-4">
            <SidebarResponsive />
            <slot />
        </div>
    </div>
</template>

<script setup>
import SidebarResponsive from '@/Components/Sidebar/SidebarResponsive.vue';
import SidebarXL from '@/Components/Sidebar/SidebarXL.vue';
</script>
