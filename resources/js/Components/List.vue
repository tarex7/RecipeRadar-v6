<template>
  <v-container>
    <v-row>
      <v-col cols="12" sm="6" md="4" v-for="(item, index) in paginatedItems" :key="index">
          <v-card>
          <!-- Utilizza v-img come sfondo della card -->
          <v-img :src="item.recipe.image" class="white--text align-end" height="100%">
            <!-- Titolo posizionato in basso nella card -->
            <v-card-title class="white--text py-2 text-h6 gradient-overlay">{{ item.recipe.label }}</v-card-title>
          </v-img>
        </v-card>
      </v-col>
    </v-row>
    <v-pagination
      v-model="currentPage"
      :length="totalPages"
      @input="fetchPageData"
    ></v-pagination>
  </v-container>
</template>

<script>
import { ref, computed, watch } from 'vue';
import { useStore } from 'vuex';

export default {
  name: 'RecipeCardsWithPagination',
  setup() {
    const store = useStore();
    const itemsPerPage = 10; // Numero di ricette per pagina
    const currentPage = ref(1); // Pagina corrente iniziale
    const totalRecipes = ref(0); // Numero totale di ricette disponibili

    // Calcola il numero totale di pagine
    const totalPages = computed(() => Math.ceil(totalRecipes.value / itemsPerPage));

    // Preleva i dati paginati dallo store
    const paginatedItems = computed(() => {
      const start = (currentPage.value - 1) * itemsPerPage;
      return store.getters.getSearchResults.slice(start, start + itemsPerPage);
    });

    // Metodo per richiedere i dati di una specifica pagina
    function fetchPageData(page) {
      // Qui devi fare una chiamata API passando i parametri di paginazione
      // e aggiornare lo store con i nuovi dati
    }

    // Osserva i cambiamenti nel risultato della ricerca e aggiorna il conteggio totale
    watch(() => store.getters.getSearchResults, (newVal) => {
      totalRecipes.value = newVal.length;
    });

    return {
      currentPage,
      totalPages,
      paginatedItems,
      fetchPageData,
    };
  },
};
</script>
