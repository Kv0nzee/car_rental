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
      />
      <CustomButton
        title="Sign in"
        btnType="button"
        :containerStyles="' color-[#B480FF] rounded-full bg-white min-w-[130px]'"
      />
    </nav>
  </header>
</template>

<script>
import { ref } from "vue";
import CustomButton from './CustomButton.vue';

export default {
  components: {
    CustomButton
  },
  setup() {
    // You can add any logic or reactive data here if needed

    return {};
  },
};
</script>
