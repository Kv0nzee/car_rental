<template>
  <TransitionRoot :show="isOpen"  name="modal-fade">
    <Dialog :open="isOpen" @close="closeModal">
      <TransitionChild
        enter-active-class="transition-opacity duration-300 ease-out"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition-opacity duration-200 ease-in"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
      >
        <div class="fixed inset-0 bg-black bg-opacity-50" @click="closeModal"></div>
      </TransitionChild>
      <Dialog className='fixed inset-0 overflow-y-auto' as="div">
        <div class="flex items-center justify-center min-h-screen" @click.self="closeModal">
            <TransitionChild
                enter-active-class="transition-opacity duration-300 ease-out"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="transition-opacity duration-200 ease-in"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
          <div class="relative w-full max-w-lg px-10 py-5 bg-white rounded-lg shadow-xl ">
               <button
                    type="button"
                    class="absolute z-10 p-2 rounded-full top-2 right-2 w-fit bg-primary-blue-100"
                    @click="closeModal"
                    >
                    <img
                        src="/close.svg"
                        alt="close"
                        width="20"
                        height="20"
                        class="object-contain"
                />
                </button>

                <div class="flex flex-col flex-1 gap-3">
                <div class="relative w-full h-40 bg-center rounded-lg ">
                    <img
                    :src="generateCarImageUrlC"
                    alt="car model"
                    fill
                    priority
                    class="object-contain"
                    />
                </div>

                <div class="flex gap-3">
                    <div v-for="angles in carAngles" :key="angles" class="relative flex-1 w-full h-24 rounded-lg bg-primary-blue-100">
                        <img
                            :src="angles"
                            alt="car model"
                            fill
                            priority
                            class="object-contain"
                        />
                    </div>
                </div>
                </div>

                <div class="flex flex-col flex-1 gap-2">
                <h2 class="text-xl font-semibold capitalize">
                   {{ car.brand_name }} {{ car.name }}
                </h2>

                <div class="flex flex-wrap gap-4 mt-3 ">
                    <div class="flex justify-between w-full gap-5 text-right">
                        <h4 class="capitalize text-grey">Cylinders</h4>
                        <p class="font-semibold text-black-100">{{ car.cylinders }}</p>
                    </div>
                    <div class="flex justify-between w-full gap-5 text-right">
                        <h4 class="capitalize text-grey">Displacement</h4>
                        <p class="font-semibold text-black-100">{{ car.displacement }}</p>
                    </div>
                    <div class="flex justify-between w-full gap-5 text-right">
                        <h4 class="capitalize text-grey">Drive</h4>
                        <p class="font-semibold text-black-100">{{ car.drive }}</p>
                    </div>
                    <div class="flex justify-between w-full gap-5 text-right">
                        <h4 class="capitalize text-grey">Fuel Type</h4>
                        <p class="font-semibold text-black-100">{{ car.fuel_type }}</p>
                    </div>
                    <div class="flex justify-between w-full gap-5 text-right">
                        <h4 class="capitalize text-grey">City Mpg</h4>
                        <p class="font-semibold text-black-100">{{ car.city_mpg }}</p>
                    </div>
                    <div class="flex justify-between w-full gap-5 text-right">
                        <h4 class="capitalize text-grey">Highway Mpg</h4>
                        <p class="font-semibold text-black-100">{{ car.highway_mpg }}</p>
                    </div>
                    <div class="flex justify-between w-full gap-5 text-right">
                        <h4 class="capitalize text-grey">Combination Mpg</h4>
                        <p class="font-semibold text-black-100">{{ car.combination_mpg }}</p>
                    </div>
                    <div class="flex justify-between w-full gap-5 text-right">
                        <h4 class="capitalize text-grey">Transmission</h4>
                        <p class="font-semibold text-black-100">{{ car.transmission }}</p>
                    </div>
                </div>
                </div>
                <div>
                    <custom-button
                      title="Rent Car"
                      containerStyles="w-full py-[16px] rounded-full bg-primary-blue"
                      textStyles="text-white text-[14px] leading-[17px] font-bold"
                      :rightIcon="'/right-arrow.svg'"
                      @click="openRentModal"
                    />
                </div>
        </div>
      </TransitionChild>
        </div>
      </Dialog>
    </Dialog>
  </TransitionRoot>
</template>


<script>
import { ref } from 'vue';
import { Dialog, TransitionRoot, TransitionChild } from '@headlessui/vue';
import CustomButton from './CustomButton.vue';
import { useStore } from 'vuex';

export default {
  components: {
    Dialog,
    TransitionRoot,
    TransitionChild,
    CustomButton
  },
  props: {
    isOpen: Boolean,
    car: Object,
    generateCarImageUrlC: String,
    carAngles: Array[String]
  },
  emits: ['closeModal'],
  setup(props, { emit }) {

    const store = useStore(); 

    const openRentModal = () => {
      closeModal();
      store.commit('openRentModal');
    }

    const closeModal = () => {
      emit('closeModal');
    };

    return {
      closeModal,
      store,
      openRentModal
    };
  },
};
</script>

<style>
.modal-fade-enter-active, .modal-fade-leave-active {
  transition: opacity 0.3s;
}
.modal-fade-enter-from, .modal-fade-leave-to {
  opacity: 0;
}
</style>