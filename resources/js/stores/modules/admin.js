export default {
    namespaced: true,
    state: {
        loading: false,
        user: null
    },
    getters: {},
    mutations: {
        switchLoading(state, status) {
            state.loading = status;
        },
        setUser(state, payload) {
            state.user = payload;
        }
    },
    actions: {
        //
    }
};
