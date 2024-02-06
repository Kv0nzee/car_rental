<script setup>
import { RouterLink, RouterView } from 'vue-router'
import Navbar from './components/Navbar.vue';
</script>

<template>
<section class="overflow-hidden">
   <Navbar/>

  <RouterView />
</section>
</template>

