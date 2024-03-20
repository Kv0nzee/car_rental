<template>
  <div class="car-card group">
    <div class="car-card__content">
      <h2 class="car-card__content-title">{{ car.brand_name }} {{ car.name }}</h2>
    </div>

    <h5 class="text-[15px] text-gray-600 mt-2 ">Type: {{ car.category_name }}</h5>
    <p class="flex mt-6 text-[32px] leading-[38px] font-extrabold">
      <span class="self-start text-[14px] leading-[17px] font-semibold">$</span>
      {{ carRent }}
      <span class="self-end text-[14px] leading-[17px] font-medium">/day</span>
    </p>

    <div class="relative object-contain w-full h-40 my-3">
      <img :src="generateCarImageUrlC" alt="car model" class="object-contain" />
    </div>

    <div class="relative flex w-full mt-2">
      <div class="flex justify-between w-full group-hover:invisible text-grey">
        <div class="flex flex-col items-center justify-center gap-2">
          <img src="/steering-wheel.svg" width="20" height="20" alt="steering wheel" />
          <p class="text-[14px] leading-[17px]">
            {{ car.transmission === "a" ? "Automatic" : "Manual" }}
          </p>
        </div>
        <div class="car-card__icon">
          <img src="/tire.svg" width="20" height="20" alt="seat" />
          <p class="car-card__icon-text">{{ car.drive.toUpperCase() }}</p>
        </div>
        <div class="car-card__icon">
          <img src="/gas.svg" width="20" height="20" alt="seat" />
          <p class="car-card__icon-text">{{ car.city_mpg }} MPG</p>
        </div>
      </div>

      <div class="car-card__btn-container">
        <custom-button
          title="View More"
          containerStyles="w-full py-[16px] rounded-full bg-primary-blue"
          textStyles="text-white text-[14px] leading-[17px] font-bold"
          :rightIcon="'/right-arrow.svg'"
          @click="openModal"
        />
      </div>
    </div>

    <CarDetails :carRent="carRent" :carAngles="carAngles" :generateCarImageUrlC="generateCarImageUrlC" :isOpen="isOpen" @closeModal="closeModal" :car="car" />
    <RentModal :car="car" :carRent="carRent"/>

  </div>
</template>
<script>
import { ref, computed } from 'vue';
import { calculateCarRent, generateCarImageUrl } from '@/utils';
import CustomButton from './CustomButton.vue';
import CarDetails from './CarDetails.vue';
import RentModal from './modals/RentModal.vue';

export default {
  props: {
    car: Object,
  },
  components: {
    CustomButton,
    CarDetails,
    RentModal
  },
  setup(props) {
    const isOpen = ref(false);
    const carangles = ref([]);

    // Array of paintIds
    const paintIds = ["pspc0150", "pspc0028", "pspc0317", "pspc0076", "pspc0064", "pspc0109"];
    // Randomly select a paintId from the array
    const randomPaintId = paintIds[Math.floor(Math.random() * paintIds.length)];
    const carRent = computed(() => calculateCarRent(props.car.city_mpg, props.car.year));
    const generateCarImageUrlC = computed(() => generateCarImageUrl(props.car, 22, randomPaintId));
    const generateCarImageUrlA1 = computed(() => generateCarImageUrl(props.car, 29, randomPaintId));
    const generateCarImageUrlA2 = computed(() => generateCarImageUrl(props.car, 33, randomPaintId));
    const generateCarImageUrlA3 = computed(() => generateCarImageUrl(props.car, 13, randomPaintId));

    // Combine computed properties into an array
    const carAngles = computed(() => [
      generateCarImageUrlA1.value,
      generateCarImageUrlA2.value,
      generateCarImageUrlA3.value
    ]);

    const openModal = () => {
      isOpen.value = true;
    };

    const closeModal = () => {
      isOpen.value = false;
    };

    return {
      isOpen,
      carRent,
      openModal,
      closeModal,
      generateCarImageUrlC,
      carAngles
    };
  },
};
</script>

<style scoped>
/* Add your scoped styles here */
</style>
