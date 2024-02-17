<template>
  <div class="hero">
    <div class="flex-1 pt-36 padding-x">
      <h1 class="hero__title">
        Find, book, rent a car—quick and super easy!
      </h1>
      <p class="hero__subtitle">
        Streamline your car rental experience with our effortless booking process.
      </p>
      <CustomButton
        title="Explore Cars"
        containerStyles="bg-gray-800 text-black text-white rounded-full mt-10"
        @click="handleScroll"
      />
    </div>
    <div class=" hero__image-container">
      <div class=" hero__image">
        <img src="/hero.png" alt="hero" class="object-contain lg:mt-20" />
      </div>
      <div class="hero__image-overlay" />
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import CustomButton from '../components/CustomButton.vue';

export default {
  components: {
    CustomButton,
  },
  setup() {
    const handleScroll = () => {
      const nextSection = document.getElementById('discover');

      if (nextSection) {
        nextSection.scrollIntoView({ behavior: 'smooth' });
      }
    };

    // Add any other reactive data or methods here

    // Lifecycle hook for actions after the component is mounted
    onMounted(() => {
      // Add any actions you want to perform after the component is mounted
    });

    // Return data and methods to be used in the template
    return {
      handleScroll,
    };
  },
};
</script>

<style scoped>
.hero__image-overlay {
    position: absolute;
    right: -50%;
    top:5%;
    z-index: -10;
    height: 590px;
    width: 100%;
    overflow: hidden;
    background-image: url(/hero-bg.png);
    background-repeat: round;
}
</style>
