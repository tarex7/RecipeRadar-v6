<template>
    <v-container fluid>
     
      <v-row justify="center" align="center" class="hero-background">
        <v-col  cols="12" sm="8" md="6">
          <h1 class="text-center hero-title mt-5">Benvenuti a Recipe Radar</h1>
          <p class="text-center hero-subtitle">Trova le migliori ricette da tutto il mondo.</p>
          <SearchBar />
        </v-col>
      </v-row>
    </v-container>
  </template>
  
  <script>
  import SearchBar from './SearchBar.vue';
  
  export default {
    name: 'HeroSection',
    components: {
      SearchBar
    }
  };
  </script>
  
  <style scoped>
  .hero-background {
    background-image: url('C:\laravel\RecipeRadar-v6\public\build\assets\imgs\hero.jpg'); /* Aggiorna con il percorso dell'immagine di sfondo */
    background-size: cover;
    background-position: center;
    height: 400px; 
    margin-top: 27px;
  }
  
  .hero-title {
    color: #fff;
    font-size: 2.5rem;
    margin-bottom: 1rem;
  }
  
  .hero-subtitle {
    color: #fff;
    font-size: 1.5rem;
    margin-bottom: 2rem;
  }
  </style>
  