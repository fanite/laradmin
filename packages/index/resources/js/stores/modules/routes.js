import * as Api from "@/apis/routes";

export default {
  namespaced: true,
  state: {
    routes: []
  },
  getters: {},
  mutations: {
    fetchUserList(state, payload) {
      state.list = payload;
    }
  },
  actions: {
    list({ commit }) {
      Api.userRoutes().then(response => {
        commit("fetchUserList", response.data);
      });
    }
  }
};
