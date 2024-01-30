<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />

    <v-app>
        <v-container>
          <v-btn color="primary">Primary Button</v-btn>
          <v-text-field label="Label"></v-text-field>
        </v-container>
      </v-app>
</template>

<style>

</style>
