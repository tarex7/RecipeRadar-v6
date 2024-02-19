// In un file di layout, es. `AppLayout.vue`
<template>
  <v-app>
    <Navbar />
    <slot /> <!-- Qui verranno inseriti i contenuti specifici delle pagine -->
    <HeroSection />
    <List v-if="searchIsActive"  />
    <DailyRecipes  v-else/>
  </v-app>
</template>

<script setup>
import DailyRecipes from '@/Components/DailyRecipes.vue';
import HeroSection from '@/Components/HeroSection.vue';
import List from '@/Components/List.vue';
import Navbar from '@/Components/Navbar.vue';
import {
    computed,
} from 'vue';

import {
    useStore
} from 'vuex';
const store = useStore();

const searchIsActive = computed(() => {
    return store.getters.getSearchResults.length
})
</script>
