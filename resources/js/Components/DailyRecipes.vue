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

    onBeforeMount
} from 'vue';
import {
    useStore
} from 'vuex';

export default {
    name: 'DailyRecipes',
    setup() {
        const store = useStore();

        const paginatedItems = ref()

        const fetchRecipeInfo = async () => {
            const URL = `https://www.themealdb.com/api/json/v2/1/randomselection.php`;

            try {
                const res = await axios.get(URL);
                paginatedItems.value = res.data.meals;

            } catch (error) {
                console.error('Errore nella chiamata Axios:', error);

            }
        };

        onBeforeMount(() => {
            fetchRecipeInfo()
        })

        return {
            paginatedItems,

        };
    },
};
</script>
