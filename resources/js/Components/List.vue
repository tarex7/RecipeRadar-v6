<template>
    <v-container>
      <!-- Lista di elementi -->
      <v-list>
        <v-list-item
          v-for="item in items"
          :key="item.uri"
        >
          <v-list-item-content>
            <v-list-item-title>{{ item.label }}</v-list-item-title>
            <v-list-item-subtitle>{{ item.uri }}</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-container>
  </template>
  
  <script>
  import { defineComponent, toRefs } from 'vue';
  
  export default defineComponent({
    name: 'Lista',
    props: {
      items: {
        type: Array,
        required: true,
      },
    },
    setup(props) {
      // Utilizza toRefs per mantenere la reattività delle prop
      const { items } = toRefs(props);
  
      return { items };
    },
  });
  </script>
  
  <style>
  /* Stili personalizzati, se necessario */
  </style>
  