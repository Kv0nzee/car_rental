<template>
  <header class="absolute z-10 w-full">
    <nav class="max-w-[1440px] mx-auto flex justify-between items-center sm:px-16 px-6 py-4 bg-transparent">
      <router-link to="/">
        <img
          src="/logo.svg"
          alt="logo"
          width="118"
          height="18"
          class="object-contain"
        />
      </router-link>
      
      <!-- Conditional rendering of buttons based on authentication status -->
      <template v-if="!isLoggedIn">
        <CustomButton
          title="Log in"
          btnType="button"
          :containerStyles="'color-[#B480FF] rounded-full bg-gray-200 min-w-[130px]'"
          @click="openLoginModal"
        />
        <CustomButton
          title="Register"
          btnType="button"
          :containerStyles="'color-[#B480FF] rounded-full bg-white min-w-[130px]'"
          @click="openRegisterModal"
        />
      </template>
      <template v-else>
        <div class="flex items-center gap-x-3">
            <h1 class="my-auto text-xl font-extrabold">Hello {{store.state.user.name}}</h1>
             <router-link :to="{name: 'rentedList', params: { name: store.state.user.name } }">
                <p class="my-auto text-blue-800">Rented Car List</p>
              </router-link>  
            <CustomButton
              title="Logout"
              btnType="button"
              :containerStyles="'color-[#B480FF] rounded-full bg-gray-200 min-w-[130px]'"
              @click="logout"
            />
        </div>
        <!-- Render user information if needed -->
      </template>
    </nav>
  </header>
</template>

<script>
import { computed, onMounted, ref } from "vue";
import { useStore } from 'vuex';
import CustomButton from './CustomButton.vue';
import axios from 'axios';

export default {
  components: {
    CustomButton
  },
  setup() {
    const store = useStore(); 

    const openLoginModal = () => {
      store.commit('openLoginModal'); 
    };

    const openRegisterModal = () => {
      store.commit('openRegisterModal'); 
    };

    const logout = async () => {
      await axios.post('http://127.0.0.1:8000/api/logout');
      store.commit('setUser', null);
      localStorage.removeItem("token");
      store.commit('setIsLoggedIn', false);
      store.commit('setIsLoggedIn', false);
    };

    // Retrieve isLoggedIn from the store
    const isLoggedIn = computed(() => store.state.isLoggedIn);

    return { openLoginModal, openRegisterModal, logout, isLoggedIn, store };
  },
};
</script>
