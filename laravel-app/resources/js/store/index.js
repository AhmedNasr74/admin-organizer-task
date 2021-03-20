import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);
const state = {
  admin: {},
  organizer: {},
};

const mutations = {
  AdminLoginSuccess(state, admin_object) {
    state.admin = admin_object;
  },
  OrganizerLoginSuccess(state, admin_object) {
    state.organizer = admin_object;
  },
  GetAdmin() {
    return state.admin;
  },
  ClearAdmin() {
    state.admin = {};
  },
};

export default new Vuex.Store({
  state: state,
  mutations: mutations,
  actions: {},
  modules: {},
});
