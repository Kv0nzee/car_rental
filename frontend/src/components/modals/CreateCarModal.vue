<template>
  <TransitionRoot appear :show="isOpen" as="template">
    <Dialog as="div" @close="closeModal" class="relative z-10">
      <TransitionChild
        as="template"
        enter="duration-300 ease-out"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="duration-200 ease-in"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <div class="fixed inset-0 bg-black/25" />
      </TransitionChild>

      <div class="fixed inset-0 overflow-y-auto">
        <div
          class="flex items-center justify-center min-h-full p-4 text-center"
        >
          <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0 scale-95"
            enter-to="opacity-100 scale-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100 scale-100"
            leave-to="opacity-0 scale-95"
          >
            <DialogPanel
              class="w-full max-w-md p-6 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl"
            >
              <DialogTitle
                as="h3"
                class="text-lg font-medium leading-6 text-gray-900"
              >
                Create Car
              </DialogTitle>
              <div class="mt-2">
                  <form @submit.prevent="submitForm">
                    <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" v-model="name" class="block w-full p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                    <label for="brand" class="block text-sm font-medium text-gray-700">Brand Name</label>
                    <select v-model="brand" style="width: 100%" class="block w-full p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{ brand.name }}</option>
                    </select>
                    </div>
                    <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <select v-model="category" style="width: 100%" class="block w-full p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
                    </select>
                    </div>
                    <div class="mb-4">
                    <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                    <input type="number" id="year" v-model="year" class="block w-full p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                    <label for="city_mpg" class="block text-sm font-medium text-gray-700">City MPG</label>
                    <input type="number" id="city_mpg" v-model="city_mpg" class="block w-full p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                    <label for="highway_mpg" class="block text-sm font-medium text-gray-700">Highway MPG</label>
                    <input type="number" id="highway_mpg" v-model="highway_mpg" class="block w-full p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <!-- Add more input fields for other car details -->
                    
                    <div class="flex justify-end">
                    <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-blue-900 bg-blue-100 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
                        Create Car
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
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useStore } from 'vuex';
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue';
import { message } from 'ant-design-vue';


export default {
  components: {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle
  },
  emits: ['closeLoginModal'],
  props: {
    isOpen: Boolean,
    brands: Object,
    categories: Object,
  },
  setup(props, { emit }) {
    const store = useStore();
    const name = ref('');
    const brand = ref('');
    const category = ref('');
    const year = ref('');
    const city_mpg = ref('');
    const highway_mpg = ref('');

    const closeModal = () => {
      name.value = '';
      brand.value = '';
      category.value = '';
      year.value = '';
      city_mpg.value = '';
      highway_mpg.value = '';
      emit('closeModal');
    };

    const submitForm = async () => {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/cars', {
          name: name.value,
          brand_id: brand.value,
          category_id: category.value,
          year: year.value,
          city_mpg: city_mpg.value,
          highway_mpg: highway_mpg.value,
        });
        emit('closeModal');
        message.success('Car Inserted successfully.');
      } catch (error) {
        console.error('Error:', error);
         message.error('Failed to fetch data.');
      }
    };

    return {
      closeModal,
      submitForm,
      name,
      brand,
      category,
      year,
      city_mpg,
      highway_mpg
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
