import { createRouter, createWebHistory } from 'vue-router';
import HomePage from './Pages/HomePage.vue';
import RecipeDetail from './Pages/Recipes/RecipeDetail.vue';

const routes = [
  { path: '/', component: HomePage },
  {
    path: '/show/:id',
    name: 'recipe-details',
    component: RecipeDetail,
    props: true // Abilita il passaggio del parametro id come prop al componente
  },
 
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
