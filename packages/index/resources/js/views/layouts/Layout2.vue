<template>
    <el-container>
        <el-aside>
            <div class="logo">你好</div>
            <el-scrollbar
                class="default-scrollbar"
                wrap-class="default-scrollbar__wrap"
                view-class="default-scrollbar__view"
            >
                <el-menu
                    router
                    :default-active="$route.path"
                    :collapse="isCollapse"
                    unique-opened
                    class="el-menu-vertical"
                >
                    <el-menu-item index="/dashboard">
                        <i class="el-icon-menu"></i>
                        <span slot="title">仪表盘</span>
                    </el-menu-item>
                    <el-submenu index="project-manager">
                        <template slot="title">
                            <i class="el-icon-coin"></i>
                            <span>项目管理</span>
                        </template>
                        <el-menu-item index="/projects">项目列表</el-menu-item>
                        <el-menu-item-group>
                            <template slot="title">分组</template>
                            <el-menu-item index="/sys-setting"
                                >选项1</el-menu-item
                            >
                            <el-menu-item index="1-2">选项2</el-menu-item>
                        </el-menu-item-group>
                        <el-menu-item-group title="个人配置">
                            <el-menu-item index="1-3">选项3</el-menu-item>
                        </el-menu-item-group>
                    </el-submenu>
                    <el-submenu index="user-manager">
                        <template slot="title">
                            <i class="el-icon-user"></i>
                            <span>人员管理</span>
                        </template>
                        <el-menu-item index="/uers">用户列表</el-menu-item>
                        <el-menu-item-group>
                            <template slot="title">分组</template>
                            <el-menu-item index="/sys-setting"
                                >选项1</el-menu-item
                            >
                            <el-menu-item index="1-2">选项2</el-menu-item>
                        </el-menu-item-group>
                        <el-menu-item-group title="个人配置">
                            <el-menu-item index="1-3">选项3</el-menu-item>
                        </el-menu-item-group>
                    </el-submenu>
                    <el-submenu index="sys-setting">
                        <template slot="title">
                            <i class="el-icon-setting"></i>
                            <span>系统配置</span>
                        </template>
                        <el-menu-item-group title="个人配置">
                            <el-menu-item index="1-3">个人设置</el-menu-item>
                        </el-menu-item-group>
                        <el-menu-item-group>
                            <template slot="title">系统配置</template>
                            <el-menu-item index="/sys-setting"
                                >系统设置</el-menu-item
                            >
                            <el-menu-item index="1-2">权限管理</el-menu-item>
                            <el-menu-item index="1-2">操作日志</el-menu-item>
                            <el-menu-item index="1-2">系统 BUG</el-menu-item>
                        </el-menu-item-group>
                    </el-submenu>
                    <el-menu-item index="/help">
                        <i class="el-icon-help"></i>
                        <span slot="title">帮助</span>
                    </el-menu-item>
                </el-menu>
            </el-scrollbar>
        </el-aside>
        <el-container class="right-container">
            <el-header>
                <el-button
                    type="text"
                    :icon="isCollapse ? 'el-icon-s-unfold' : 'el-icon-s-fold'"
                    class="btn-collapse"
                    @click="handleCollapse"
                ></el-button>
                <el-menu
                    :default-active="activedUrl"
                    class="el-header-menu"
                    mode="horizontal"
                >
                    <el-menu-item
                        index="http://127.0.0.1:8000/backend/"
                        icon="el-icon-s-home"
                        ><a href="http://127.0.0.1:8000/backend/"
                            >后台管理</a
                        ></el-menu-item
                    >
                    <el-submenu index="workspace">
                        <template slot="title">工作台</template>
                        <el-menu-item index="/reports?uid=123"
                            >日报</el-menu-item
                        >
                        <el-menu-item index="/tasks?uid=123">任务</el-menu-item>
                        <el-menu-item index="/posts?uid=123">文章</el-menu-item>
                    </el-submenu>
                    <el-menu-item index="/projects" disabled>项目</el-menu-item>
                </el-menu>
            </el-header>
            <el-scrollbar
                class="default-scrollbar"
                wrap-class="default-scrollbar__wrap"
                view-class="default-scrollbar__view"
            >
                <el-main>
                    <transition
                        v-on:before-enter="beforeEnter"
                        v-on:enter="enter"
                    >
                        <router-view></router-view>
                    </transition>
                    <el-footer>
                        <copy-right></copy-right>
                    </el-footer>
                </el-main>
            </el-scrollbar>
        </el-container>
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
            activedUrl: location.origin + this.$router.options.base,
            isCollapse: Lockr.get("is_collapsed") || false,
            transitionName: ""
        };
    },
    watch: {
        $route(to, from) {
            const toDepth = to.path.split("/").length;
            const fromDepth = from.path.split("/").length;
            this.transitionName =
                toDepth < fromDepth ? "slide-right" : "slide-left";
        }
    },
    methods: {
        handleCollapse() {
            this.isCollapse = !this.isCollapse;
            Lockr.set("is_collapsed", this.isCollapse);
        },
        beforeEnter: function(el) {
            el.style.opacity = 0;
        },
        enter: function(el, done) {
            Velocity(el, { opacity: 1 }, { duration: 800 });
        }
    },
    mounted: function() {
        console.log(this.activedUrl);
        console.log(this.$router);
    }
};
</script>

<style lang="scss" scoped>
.el-header,
.el-footer {
    //   background-color: #b3c0d1;
    color: #333;
    line-height: 60px;
}

.el-header {
    display: flex;
    .el-header-menu {
        overflow-y: hidden;
        flex: 1;
    }
}

.el-aside {
    color: #333;
    height: inherit;
    width: unset !important;
    display: flex;
    flex-direction: column;
    //   border-right: solid 1px #e6e6e6;
}

.el-aside .logo {
    height: 60px;
    line-height: 60px;
    text-align: center;
}

.el-container {
    height: 100%;
}

.el-container:nth-child(5) .el-aside,
.el-container:nth-child(6) .el-aside {
    line-height: 260px;
}

.el-container:nth-child(7) .el-aside {
    line-height: 320px;
}

.el-menu {
    border-right: unset;
    overflow-x: hidden;
}

.el-menu.el-menu--horizontal {
    border-bottom: unset;
}

.el-menu-vertical:not(.el-menu--collapse) {
    width: 200px;
    min-height: 400px;
}
</style>
