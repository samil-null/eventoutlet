import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
      user: null
  },

  getters: {
    USER: state => {
        return state.user;
    }
  },

  mutations: {
    SET_USER : (state, payload) => {
        state.user = payload;
    }
  },

  actions: {
    SET_USER: (context, payload) => {
        context.commit('SET_USER', payload);
    },
    OPEN_REGISTER_MODEL: (context, payload) => {
        context.commit('OPEN_REGISTER_MODEL', payload);
    }
  }
});
