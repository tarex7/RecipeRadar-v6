<template>
<v-container class=" pa-5">
    <v-row justify="center">
        <v-col cols="12" md="6">
            <v-text-field class="text-green custom-input" v-model="searchQuery" append-inner-icon="mdi-magnify" label="Cerca ricette" variant="solo-inverted" single-line hide-details @click:append="onSearch" @keyup.enter="onSearch"></v-text-field>

        </v-col>
    </v-row>
</v-container>
</template>

  
  
  
  
<script>
import {
    onMounted,
    ref
} from 'vue';
import axios from 'axios';
import {
    useStore
} from 'vuex';

export default {
    name: "SearchBar",
    setup() {
        const store = useStore();
        const searchQuery = ref('');
        const items = ref([]);
        const nextPageUrl = ref(''); // Inizializza l'URL della prossima pagina

        async function onSearch() {
            if (!searchQuery.value) {
                console.log("Inserisci una query di ricerca.");
                return;
            }

           
            const URL = `https://www.themealdb.com/api/json/v1/1/search.php?s=${encodeURIComponent(searchQuery.value)}`;
            try {
                const response = await axios.get(URL);
                // Gestisci la risposta
               

                console.log('Risultati della ricerca:', response.data);
              

                // Qui puoi gestire i dati della risposta, come aggiornare lo stato del componente
                // o navigare a una pagina di risultati
                //recipes.value = response.data.hits
                store.commit('setSearchResults', response.data.meals)
              
                if (response.data._links && response.data._links.next) {
                    nextPageUrl.value = response.data._links.next.href;
                } else {
                    nextPageUrl.value = ''; // Nessuna altra pagina da caricare
                }
            } catch (error) {
                console.error('Errore nella chiamata API:', error);
                // Gestisci eventuali errori qui
            }
        }

        return {
            searchQuery,
            onSearch,
            items
        }
    }
}
</script>
  
  
<style>
.custom-text-color .v-field__input,
.custom-text-color input {
    color: #4c4eaf;
    /* Sostituisci con il colore che preferisci */
}

.text-green input {
    color: green !important;
}

.custom-input {
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.16);
}

.v-text-field,
.v-text-field {

    background-color: transparent !important;
    border: 2px transparent solid;
}
</style>
