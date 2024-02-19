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

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },

});
</script>

<template>
<v-app>
    <Head title="Dashboard" />

   <Navbar />
<HeroSection class="my-5" />
        <List v-if="searchIsActive"  />
    <DailyRecipes v-else />

</v-app>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
