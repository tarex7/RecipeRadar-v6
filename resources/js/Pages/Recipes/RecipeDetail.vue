<template>
 <v-app >
    <Navbar />
    <v-snackbar v-model="snackbar.show" :color="snackbar.color" timeout="3000" :top="true">
     {{ snackbar.message }}
 </v-snackbar>
<v-container>
    <v-row>
        <v-col cols="3"></v-col>
        <v-col cols="6">
            <v-card >
                <v-col cols="12">

                    <div class="flex justify-between align-center">
                        
                      <div>
                        <v-card-title class="mb-0">
                            {{ recipe.strMeal }}
                            <i @click="toggleFavorite"
                            :class="{'fa-solid bg-red': isFavorite == true, 'fa-regular': !isFavorite}"
                            class="ml-5 fa-heart">
                         </i>
                        </v-card-title>
                        
                        <v-card-text class="my-0">
                          {{recipe.strArea}} | {{recipe.strCategory}}
                        </v-card-text>
                      </div>
                  
                      <v-btn href="/" color="secondary mt-5 mr-3">Back</v-btn>

                    </div>
                  </v-col>
                  

                <v-row class="fill-width" align="center" justify="center">
                    <v-col cols="12" md="12">
                       
                               <div class="mx-5">
                                <v-img :src="recipe.strMealThumb" style="max-width: 500px;"></v-img>
                               </div>
                          
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12">
                        <v-card outlined height="100%" class="mx-5">
                            <v-card-title class="headline">Ingredients</v-card-title>
                            <v-card-text>
                                <div class="ingredients-grid">
                                    <div class="my-1 d-flex flex-column" v-for="(ingredient, index) in ingredientsList" :key="index">
                                        <div>
                                            <img :src="`https://www.themealdb.com/images/ingredients/${ingredient.name}-Small.png`" alt="">
                                        </div>
                                        <div>
                                            {{ ingredient.name }}:
                                            <b>{{ ingredient.measure }} </b>
                                        </div>
                                    </div>
                                </div>
                            </v-card-text>
                        </v-card>
                    </v-col>

                    <v-col cols="12">
                        <v-card outlined class="m-5">
                            <v-card-title class="headline">Preparation Steps</v-card-title>
                            <v-card-text>{{recipe.strInstructions}}</v-card-text>
                        </v-card>
                        
                    </v-col>
                </v-row>
            </v-card>
        </v-col>
    </v-row>

</v-container>
 </v-app>
</template>

<script setup>
import Navbar from '@/Components/Navbar.vue';
import axios from 'axios';
import {
    defineProps,
    onBeforeMount,
    ref,
    computed

} from 'vue';

onBeforeMount(() => {
    fetchRecipeInfo()
})

const recipe = ref([]);
let isFavorite = ref(1);
const snackbar = ref({
    show: false,
    message: '',
    color: 'error', 
});

const props = defineProps({
    recipe_id: {
        type: Number,
        required: true,
    },
});

// Crea un array computato di ingredienti e misure
const ingredientsList = computed(() => {
    const ingredients = []
    const ingredientsTotal = [];

    Object.keys(recipe.value).forEach(value => {
        if (value.slice(0, 13) == 'strIngredient') {
            ingredientsTotal.push(value)
        }
    })

    for (let i = 0; i < ingredientsTotal.length; i++) {
        const name = recipe.value[ingredientsTotal[i]];
        const measure = recipe.value[`strMeasure${i+1}`];
        if (recipe.value[ingredientsTotal[i]] != "")
            ingredients.push({
                "name": name,
                'measure': measure
            })
    }

    return ingredients;
});



const fetchRecipeInfo = async () => {
    const URL = `https://www.themealdb.com/api/json/v1/1/lookup.php?i=${props.recipe_id}`;

    axios.post(`/api/checkIfFavorite/${props.recipe_id}`).then(res => isFavorite.value = res.data)
    
    
    try {
        const res = await axios.get(URL);
        recipe.value = res.data.meals[0];
        console.log('show res.data', recipe.value);
    } catch (error) {
        console.error('Errore nella chiamata Axios:', error);
        snackbar.message = 'Errore nella chiamata Axios: ' + (error.response?.data?.message || error.message);
        snackbar.color = 'error'; // Puoi impostare dinamicamente il colore in base al tipo di errore
        snackbar.show = true;
    }
};

const toggleFavorite = () => {
    
    if (isFavorite.value == false) {
        console.log('isFav',isFavorite.value)
        const postData = {
        recipe_id: recipe.value.idMeal, // ID esterno della ricetta
        name: recipe.value.strMeal,
        category: recipe.value.strCategory,
        area: recipe.value.strArea,
        instructions: recipe.value.strInstructions,
        image_url: recipe.value.strMealThumb,
        tags: recipe.value.strTags,
        video_url: recipe.value.strYoutube,
        ingredients: ingredientsList.value,
        favorite:1
    };
    axios.post('/api/favorite',postData)
        .then(res => {
            snackbar.value.show = true;
            snackbar.value.message = res.data.message; 
            snackbar.value.color = 'success';
            console.log('res', res.data)
        })
        .catch(error => {
            console.error('Errore:', error)
            snackbar.value.show = true;
            snackbar.value.message = error.response.data.message || 'Si è verificato un errore';
            snackbar.value.color = 'error';
        });
        isFavorite.value = true
    } else {
       
        axios.post(`/api/removeFromFavorite/${props.recipe_id}`).then(res => {
            snackbar.value.show = true;
            snackbar.value.message = res.data.message; 
            snackbar.value.color = 'error';
            console.log('res', res.data)
       })
           isFavorite.value = !isFavorite.value;


    }
   

   
        
};


</script>

<style>
.ingredients-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-gap: 20px;
}
.bg-red {
    color: red; 
}

</style>
