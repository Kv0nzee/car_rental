<template>
  <TransitionRoot appear :show="store.state.isRegisterModalOpen" as="template">
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
                Register
              </DialogTitle>
              <div class="mt-2">
                <form @submit.prevent="submitForm">
                  <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" v-model="username" class="block w-full p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                  </div>
                  <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" v-model="email" class="block w-full p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                  </div>
                  <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" v-model="password" class="block w-full p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                  </div>
                  <div class="flex justify-end">
                    <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-blue-900 bg-blue-100 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
                      Register
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
import { ref } from 'vue';
import axios from 'axios';
import { useStore } from 'vuex';
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue'

export default {
  components: {
    Dialog, // Remove this line
    TransitionRoot,
    TransitionChild,
    DialogPanel,
    DialogTitle
  },
  emits: ['closeRegisterModal'],
  setup(props, { emit }) {
    const store = useStore();
     const username = ref('');
    const password = ref('');
     const email = ref('');
    const submitForm = async() => {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/register', {
          name: username.value,
          email: email.value,
          password: password.value
        }, {
              headers: {
                'content-type' : 'application/json'
              }
        });
        localStorage.setItem('token', response.data.token);
        emit("loadUser");
       closeModal();
      } catch (error) {
        console.error('Error:', error);
      }
    };
    const closeModal = () => {
      username.value = '';
      email.value = '';
      password.value = ''; 
      store.commit('closeRegisterModal'); 
    };
    return{
        closeModal,
        submitForm,
        username,
        password,
        email,
        store
    }
  }
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