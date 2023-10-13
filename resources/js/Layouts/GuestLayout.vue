<script setup>
import Navbar from "@/Components/Navbar.vue";
</script>

<template>
    <div class="border-b border-gray-500 p-6 lg:p-8">
        <div class="container mx-auto">
            <Navbar/>
        </div>
    </div>

    <div class="relative container mx-auto">
        <slot/>
    </div>
</template>
