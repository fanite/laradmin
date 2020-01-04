<template>
    <el-container>
        <el-header>方高平同学</el-header>
        <el-scrollbar
            class="default-scrollbar main"
            wrap-class="default-scrollbar__wrap"
            view-class="default-scrollbar__view"
        >
            <el-main>
                <router-view />
            </el-main>
            <el-footer>
                <copy-right />
            </el-footer>
        </el-scrollbar>
    </el-container>
</template>

<script>
import CopyRight from "@/views/layouts/CopyRight";
import Lockr from "@/lib/lockr";
import Velocity from "velocity-animate";
import "velocity-animate/velocity.ui.js";
export default {
    components: { CopyRight },
    data() {
        return {
            title: "康师傅牛肉面",
            activedUrl: location.origin + this.$router.options.base,
            isCollapse: Lockr.get("is_collapsed") || false
        };
    },
    methods: {
        handleCollapse() {
            this.isCollapse = !this.isCollapse;
            Lockr.set("is_collapsed", this.isCollapse);
            const width = (this.isCollapse ? 64 : 200) + "px";
            Velocity(
                this.$refs.logo,
                { width },
                { duration: 300, easing: "ease-in-out" }
            );
        },
        beforeEnter: function(el) {
            el.style.opacity = 0;
        },
        enter: function(el) {
            Velocity(el, { opacity: 1 }, { duration: 800 });
        }
    }
};
</script>
