<template>
    <v-row>
      <v-col cols="12">
        <v-timeline dense>
          <v-timeline-item v-for="(step, index) in recipe.steps" :key="index" color="deep-purple accent-4" fill-dot>
            <v-card color="green darken-1 lighten-2" dark>
              <div class="m-4">Step {{ step.number }}</div>
              <div class="m-4">equipment: 
                <div v-for="equipment in step.equipment" :key="step.equipment.id">{{equipment.name}}

                    <img :src="`https://spoonacular.com/cdn/ingredients_100x100/${equipment.image}`">

                </div>
              </div>
              <v-card-title class="headline">{{ step.step }}</v-card-title>
              <v-card-text>
                <v-chip-group column>
                  <v-chip v-for="ingredient in step.ingredients" :key="ingredient.id" color="purple lighten-3">
                    {{ ingredient.name }}
                  </v-chip>
                </v-chip-group>
              </v-card-text>
            </v-card>
          </v-timeline-item>
        </v-timeline>   
      </v-col>
    </v-row> 
  </template>
  
  <script setup>
  import { ref, watchEffect, defineProps } from 'vue';
  
  const props = defineProps({
    recipeInstructions: Array,
  });
  
  const recipe = ref({ steps: [] });
  
  watchEffect(() => {
    if (props.recipeInstructions && props.recipeInstructions.length > 0) {
      recipe.value = props.recipeInstructions[0]; 
    }
  });
  
  </script>
  