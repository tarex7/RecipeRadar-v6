<template>
<v-row justify="center mt-5">
    <v-col sm="2" class="mx-5" v-for="(recipe, index) in paginatedItems" :key="index">

        <router-link :to="`/show/${recipe.idMeal}`" custom v-slot="{ navigate }">
            <v-card @click="navigate">
                <v-img :src="recipe.strMealThumb" class="white--text align-end" height="100%"></v-img>
                <v-card-text class="white--text py-2 gradient-overlay">{{ recipe.strMeal }}</v-card-text>
            </v-card>
        </router-link>
        
    </v-col>
</v-row>
<v-pagination v-model="currentPage" :length="totalPages"></v-pagination>
</template>

<script>
import {
    ref,
    computed,
    watch,
    defineProps
} from 'vue';
import {
    useStore
} from 'vuex';
import {
    Link
} from '@inertiajs/vue3';
// import {
//     router
// } from '@inertiajs/vue3';
// const navigateTo = (routeName) => {
//     router.visit(route(routeName));
// }
export default {
    name: 'RecipeCardsWithPagination',
    setup() {
        const store = useStore();
        const itemsPerPage = 10; // Numero di ricette per pagina
        const currentPage = ref(1); // Pagina corrente iniziale
        const totalRecipes = ref(store.getters.getSearchResults.length); // Numero totale di ricette disponibili
        console.log('tot recipes', totalRecipes)
        // Calcola il numero totale di pagine
        const totalPages = computed(() => Math.ceil(totalRecipes.value / itemsPerPage));

        // Preleva i dati paginati dallo store
        const paginatedItems = computed(() => {
            const start = (currentPage.value - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            console.log('start', start)
            console.log('end', end)
            if (store.getters.getSearchResults) {
                return store.getters.getSearchResults.slice(start, end);
            } else {
                return
            }
        });

       

        // Osserva i cambiamenti nel risultato della ricerca e aggiorna il conteggio totale
        watch(() => store.getters.getSearchResults, (newVal) => {
            totalRecipes.value = newVal;
            console.log('newVal', totalRecipes.value)
        });

        return {
            currentPage,
            totalPages,
            paginatedItems,
          
        };
    },
};
</script>
