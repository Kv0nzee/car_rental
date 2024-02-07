<script setup>
import { useStore } from 'vuex';
import { ref } from 'vue';
import Navbar from './components/Navbar.vue'
import LoginModal from './components/modals/LoginModal.vue'; // Import your Modal component
import RegisterModal from './components/modals/RegisterModal.vue'; // Import your Modal component

const store = useStore(); // Access the Vuex store

const closeLoginModal = () => {
  store.commit('closeLoginModal'); 
};

const closeRegisterModal = () => {
  store.commit('closeRegisterModal'); 
};

</script>

<template>
<section class="overflow-hidden">
   <Navbar/>
  <LoginModal :isOpen="store.state.isLoginModalOpen" @closeLoginModal="closeLoginModal"/>
  <RegisterModal :isOpen="store.state.isRegisterModalOpen" @closeRegisterModal="closeRegisterModal"/>
  <RouterView />
</section>
</template>

