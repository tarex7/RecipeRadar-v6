<script setup>
import HeroSection from '@/Components/HeroSection.vue';
import List from '@/Components/List.vue';
import SearchBar from '@/Components/SearchBar.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />

    <v-app>
        <v-container>
        <HeroSection />
        <List />
        </v-container>
      </v-app>
      
</template>

<style>

</style>
