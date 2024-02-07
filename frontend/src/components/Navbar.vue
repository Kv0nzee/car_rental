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
      

      <CustomButton
        title="Log in"
        btnType="button"
        :containerStyles="' color-[#B480FF] rounded-full bg-gray-200 min-w-[130px]'"
        @click="openLoginModal"
      />
      <CustomButton
        title="Register"
        btnType="button"
        :containerStyles="' color-[#B480FF] rounded-full bg-white min-w-[130px]'"
        @click="openRegisterModal"
      />
    </nav>
  </header>
</template>

<script>
import { ref } from "vue";
import { useStore } from 'vuex';
import CustomButton from './CustomButton.vue';

export default {
  components: {
    CustomButton
  },
  setup() {
    const store = useStore(); // Access the Vuex store

    const openLoginModal = () => {
      store.commit('openLoginModal'); 
    };

    const openRegisterModal = () => {
      store.commit('openRegisterModal'); 
    };

    return {openLoginModal, openRegisterModal};
  },
};
</script>
