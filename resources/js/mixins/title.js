export default {
    computed: {
        Backend() {
            return "admin";
        }
    },
    mounted: function() {
        document.title = `${this.$route.meta.title} | 'Admin`;
    }
};
