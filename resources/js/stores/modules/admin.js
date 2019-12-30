export default {
    namespaced: true,
    state: {
        loading: false,
        user: null
    },
    getters: {},
    mutations: {
        switchLoading(state) {
            state.loading = !state.loading;
        },
        setUser(state, payload) {
            state.user = payload;
        }
    },
    actions: {
        //
    }
};
