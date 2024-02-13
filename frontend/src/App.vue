<script setup>
import { useStore } from 'vuex';
import { ref } from 'vue';
import Navbar from './components/Navbar.vue'
import LoginModal from './components/modals/LoginModal.vue'; // Import your Modal component
import RegisterModal from './components/modals/RegisterModal.vue'; // Import your Modal component

const store = useStore(); // Access the Vuex store

</script>

<template>
<section class="overflow-hidden">
   <Navbar/>
  <LoginModal/>
  <RegisterModal/>
  <RouterView />
</section>
</template>

