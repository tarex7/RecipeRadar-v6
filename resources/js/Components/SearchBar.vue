<template>
<v-text-field color="secondary" outlined v-model="searchQuery" append-icon="mdi-magnify" label="Cerca ricette" single-line hide-details @click:append="onSearch" @keyup.enter="onSearch"></v-text-field>


</template>

  
<script>
import {
    ref
} from 'vue';
import axios from 'axios';

export default {
    name: "SearchBar",
    setup() {
        const searchQuery = ref('');
        const recipes = ref([
        ]);


        async function onSearch() {
            if (!searchQuery.value) {
                console.log("Inserisci una query di ricerca.");
                return;
            }

            const EDAMAM_API_URL = 'https://api.edamam.com/search';
            const APP_ID = 'badd694d'; // Sostituisci con il tuo App ID
            const APP_KEY = '8b062e0d6c9f52fe8ec76e1ab1d47716'; // Sostituisci con la tua App Key

            try {
                const response = await axios.get(EDAMAM_API_URL, {
                    params: {
                        q: searchQuery.value,
                        app_id: APP_ID,
                        app_key: APP_KEY
                    }
                });

                console.log('Risultati della ricerca:', response.data);
                // Qui puoi gestire i dati della risposta, come aggiornare lo stato del componente
                // o navigare a una pagina di risultati
                recipes.value = response.data.hits
                console.log("recipes", recipes.value)
            } catch (error) {
                console.error('Errore nella chiamata API:', error);
                // Gestisci eventuali errori qui
            }
        }

        return {
            searchQuery,
            onSearch,
            recipes
        }
    }
}
</script>

  
<style>
/* Aggiungi qui eventuali stili personalizzati se necessario */
</style>
