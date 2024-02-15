import { createStore } from 'vuex';

// Definizione dello store Vuex
const store = createStore({
  state() {
    return {
      searchResults: [],
      selectedRecipe: {},
    };
  },
  mutations: {
    setSearchResults(state, results) {
      state.searchResults = results;
    },
    setSelectedRecipe(state, recipe) {
      state.selectedRecipe = recipe;
    },
  },
  actions: {
    getselectedRecipe({ commit }, recipe_id) {
      // Implementazione dell'azione
    },
  },
  getters: {
    getSearchResults: state => state.searchResults,
    getselectedRecipe: state => state.selectedRecipe,
  },
});

// Esportazione nominata dello store
export { store };
