import { createStore } from 'vuex';

export default createStore({
  state() {
    return {
      searchResults: [],
    };
  },
  mutations: {
    setSearchResults(state, results) {
      state.searchResults = results;
    },
  },
  actions: {
    updateSearchResults({ commit }, results) {
      commit('setSearchResults', results);
    },
  },
  getters: {
    getSearchResults: state => state.searchResults,
  },
});
