<template>
  <main class="overflow-hidden">
    <Hero />

    <div class="mt-12 padding-x padding-y max-width" id="discover">
      <div class="flex flex-col items-start justify-start gap-y-2.5 text-black-100">
        <h1 class="text-4xl font-extrabold">Car Catalogue</h1>
        <p>Explore our cars you might like</p>
      </div>

      <!-- <div class="home__filters">
        <SearchBar />

        <div class="home__filter-container">
          <CustomFilter title="fuel" :options="fuels" />
          <CustomFilter title="year" :options="yearsOfProduction" />
        </div>
      </div> -->

      <section v-if="!isDataEmpty">
        <div class="home__cars-wrapper">
          <CarCard v-for="car in cars" :key="car.id" :car="car" />
        </div>
      </section>

      <div v-else class="home__error-container">
        <h2 class="text-xl font-bold text-black">Oops, no results</h2>
        <p>{{ cars.message }}</p>
      </div>
    </div>
  </main>
</template>

<script>
import Hero from '../components/Hero.vue';
import CarCard from '../components/CarCard.vue';
import { ref, onBeforeMount } from 'vue';
import axios from 'axios';

export default {
  components: {
    Hero,
    CarCard
  },
  setup() {
    const cars = ref([]);
    const isDataEmpty = ref(false);

    const getAllCars = async () => {
      try {
        const res = await axios.get('http://127.0.0.1:8000/api/cars');
        cars.value = res.data;
        isDataEmpty.value = false;
      } catch (e) {
        console.error(e);
        isDataEmpty.value = true;
      }
    };

    onBeforeMount(getAllCars);

    return {
      cars,
      isDataEmpty,
    };
  },
};
</script>
