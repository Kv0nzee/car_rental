<template>
  <main>
    <Hero/>
  </main>
</template>

<script>
import { ref, onMounted } from 'vue';
import Hero from '../components/Hero.vue'
import axios from 'axios';
export default{
  components: {
    Hero
  },
  setup() {
    const getRecipes = async() => {
      try {
        let res = await axios.get('http://127.0.0.1:8000/api/cars')
        if(res) {
         console.log(res);
        }
      }catch (e) {
        console.log(e)
      }
    }

    onMounted(() => {
      getRecipes();
    });

    return {getRecipes,onMounted};
  },
}
</script>

