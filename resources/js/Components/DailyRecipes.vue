<template>
<v-row justify="center" class="mx-5">
    <v-col sm="2" class="mx-5" v-for="(recipe, index) in paginatedItems" :key="index">

        <a :href="`/show/${recipe.idMeal}`">
            <v-card>
                <v-img :src="recipe.strMealThumb" class="white--text align-end" height="100%"></v-img>
            </v-card>
            <v-card-text class="white--text py-2  gradient-overlay">{{ recipe.strMeal }}</v-card-text>
        </a>
    </v-col>
</v-row>
</template>

<script>
import {
    ref,
    computed,
    watch,
    onBeforeMount
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
    name: 'DailyRecipes',
    setup() {
        const store = useStore();
        const recipe = ref([]);
        const itemsPerPage = 10; // Numero di ricette per pagina
        const currentPage = ref(1); // Pagina corrente iniziale
        const totalRecipes = ref(store.getters.getSearchResults.length); // Numero totale di ricette disponibili
        console.log('tot recipes', totalRecipes)
        // Calcola il numero totale di pagine
        const totalPages = computed(() => Math.ceil(totalRecipes.value / itemsPerPage));

        // Preleva i dati paginati dallo store
        const paginatedItems = ref()

        const fetchRecipeInfo = async () => {
            const URL = `https://www.themealdb.com/api/json/v2/1/randomselection.php`;

            try {
                const res = await axios.get(URL);
                paginatedItems.value = res.data.meals;
                console.log('show res.data', recipe.value);
            } catch (error) {
                console.error('Errore nella chiamata Axios:', error);

            }
        };

        onBeforeMount(() => {
            fetchRecipeInfo()
        })

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
