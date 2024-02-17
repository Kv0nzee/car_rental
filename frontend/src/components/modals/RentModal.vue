<template>
  <TransitionRoot appear :show="store.state.isRentOpen"   @click="closeModal" name="modal-fade" as="template">
    <Dialog as="div" class="relative z-10">
      <TransitionChild
        as="div"
        enter="duration-300 ease-out"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="duration-200 ease-in"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <div class="fixed inset-0 " @click="closeModal"></div> <!-- Add @click handler here -->
      </TransitionChild>

      <div class="fixed inset-0 overflow-y-auto ">
        <div
          class="flex items-center justify-center min-h-full p-4 text-center"
        >
          <TransitionChild
            as="div"
            enter="duration-300 ease-out"
            enter-from="opacity-0 scale-95"
            enter-to="opacity-100 scale-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100 scale-100"
            leave-to="opacity-0 scale-95"
          >
            <DialogPanel
              class="w-full max-w-md p-6 overflow-hidden text-left align-middle transition-all transform bg-white rounded-2xl"
            >
              <DialogTitle
                as="h3"
                class="text-lg font-medium leading-6 text-gray-900"
              >
                Rent a Car
              </DialogTitle>
              <div class="mt-2">
                <form @submit.prevent="submitForm">
                  <div class="mb-4">
                    <label for="days" class="block text-sm font-medium text-gray-700">Days to Rent</label>
                    <input type="number" id="days" min="1" v-model="daysToRent" class="block w-full p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                  </div>
                  <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Price (per day)</label>
                    <p class="block w-full p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{pricePerDay}}</p>
                  </div>
                  <div class="mb-4">
                    <label for="totalPrice" class="block text-sm font-medium text-gray-700">Total Price</label>
                    <p class="block w-full p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{totalPrice}}</p>
                  </div>
                  <div class="flex justify-end">
                    <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-blue-900 bg-blue-100 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
                      Rent Now
                    </button>
                  </div>
                </form>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script>
import { ref, computed } from 'vue';
import axios from 'axios';
import { useStore } from 'vuex';
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue';

export default {
  components: {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle
  },
  props:{
    car: Object,
    carRent: String,
  },
  setup(props) {
    const store = useStore();
    const daysToRent = ref(1);
    const pricePerDay = ref(props.carRent); 
    const totalPrice = computed(() => daysToRent.value * pricePerDay.value);

    const closeModal = () => {
      daysToRent.value = 1;
      store.commit('closeRentModal'); 
    };
    
    const submitForm = async () => {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/rent', {
          days: daysToRent.value,
          total_price: totalPrice.value,
          car_id: props.car.id,
          user_id: store.state.user.id
        });
        console.log('Response:', response.data);
        store.commit('closeRentModal'); 
      } catch (error) {
        console.error('Error:', error);
      }
    };

    return {
      closeModal,
      submitForm,
      daysToRent,
      pricePerDay,
      totalPrice,
      store
    };
  },
};
</script>
