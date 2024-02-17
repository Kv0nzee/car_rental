import { createStore } from 'vuex';

// Create a new store instance.
const store = createStore({
  state() {
    return {
      isRegisterModalOpen: false,
      isLoginModalOpen: false,
      isLoggedIn: false,
      isRentOpen: false,
      user: null,
    };
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
    },
    openRentModal(state) {
      state.isRentOpen = true;
    },
    closeRentModal(state) {
      state.isRentOpen = false;
    },
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
    setIsLoggedIn(state, boo){
      state.isLoggedIn = boo;
    }
  }
});

export default store;
