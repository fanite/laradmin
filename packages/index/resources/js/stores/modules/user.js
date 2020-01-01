export default {
    namespaced: true,
    state: {
        list: []
    },
    getters: {},
    mutations: {
        fetchUserList(state, payload) {
            state.list = payload;
        }
    },
    actions: {
        list({ commit }) {
            axios.get("/users").then(response => {
                commit("fetchUserList", response.data);
            });
        }
    }
};
