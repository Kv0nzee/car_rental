import { createStore } from 'vuex';

// Create a new store instance.
const store = createStore({
  state() {
    return {
      isRegisterModalOpen: false,
      isLoginModalOpen: false,
      isLoggedIn: false,
    };
  },
  mutations: {
    openRegisterModal(state) {
      state.isRegisterModalOpen = true;
    },
    closeRegisterModal(state) {
      state.isRegisterModalOpen = false;
    },
    openLoginModal(state) {
      state.isLoginModalOpen = true;
    },
    closeLoginModal(state) {
      state.isLoginModalOpen = false;
    },
    isLoggedIn(state){
      state.isLoggedIn = !state.isLoggedIn;
    }
  }
});

export default store;
