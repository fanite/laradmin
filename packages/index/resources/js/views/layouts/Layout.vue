<template>
  <el-container>
    <el-header>
      <div class="logo" key="collapse" ref="logo">
        <router-link to="/">
          <img src="@images/logo.png" />
          <div>{{ title }}</div>
        </router-link>
      </div>
      <el-button
        type="text"
        :icon="isCollapse ? 'el-icon-s-unfold' : 'el-icon-s-fold'"
        class="btn-collapse"
        @click="handleCollapse"
      ></el-button>
      <el-menu :default-active="activedUrl" class="el-header-menu" mode="horizontal">
        <el-menu-item index="http://127.0.0.1:8000/backend/" icon="el-icon-s-home">
          <a href="http://127.0.0.1:8000/backend/">后台管理</a>
        </el-menu-item>
        <el-submenu index="workspace">
          <template slot="title">工作台</template>
          <el-menu-item index="/reports?uid=123">日报</el-menu-item>
          <el-menu-item index="/tasks?uid=123">任务</el-menu-item>
          <el-menu-item index="/posts?uid=123">文章</el-menu-item>
        </el-submenu>
        <el-menu-item index="/projects" disabled>项目</el-menu-item>
      </el-menu>
    </el-header>
    <el-container>
      <el-aside>
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
                <el-menu-item index="/sys-setting">选项1</el-menu-item>
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
                <el-menu-item index="/sys-setting">选项1</el-menu-item>
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
                <el-menu-item index="/sys-setting">系统设置</el-menu-item>
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
      <el-scrollbar
        class="default-scrollbar main"
        wrap-class="default-scrollbar__wrap"
        view-class="default-scrollbar__view"
      >
        <el-main>
          <transition @before-enter="beforeEnter" @enter="enter">
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
    setLogoWidth(width) {
      this.$refs.logo.style.width = width;
    },
    beforeEnter: function(el) {
      el.style.opacity = 0;
    },
    enter: function(el) {
      Velocity(el, { opacity: 1 }, { duration: 800 });
    }
  },
  mounted: function() {
    this.setLogoWidth((this.isCollapse ? 64 : 200) + "px");
  }
};
</script>
