<script setup>
import { useStore } from 'vuex';
import { onMounted } from 'vue';
import axios from 'axios';

// Import components
import Navbar from './components/Navbar.vue';
import LoginModal from './components/modals/LoginModal.vue';
import RegisterModal from './components/modals/RegisterModal.vue';

const store = useStore(); // Access the Vuex store

// Function to fetch user data
const fetchUserData = async () => {
  try {
    const token = localStorage.getItem('token');
    if(token){
        const response = await axios.get('http://127.0.0.1:8000/api/user', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        store.commit('setUser', response.data.user);
        store.commit('setIsLoggedIn', true);
    }
  } catch (error) {
    store.commit('setUser', null);
    store.commit('setIsLoggedIn', false);
  }
};

// Call fetchUserData when the component is mounted
onMounted(async () => {
  await fetchUserData();
});
</script>


<template>
<section class="overflow-hidden">
   <Navbar/>
  <LoginModal @loadUser="fetchUserData"/>
  <RegisterModal @loadUser="fetchUserData"/>
  <RouterView />
</section>
</template>

