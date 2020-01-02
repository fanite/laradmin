<template>
  <el-container>
    <el-header>
      <el-menu
        default-active="1"
        class="header-menu"
        mode="horizontal"
        background-color="#545c64"
        text-color="#fff"
        active-text-color="#ffd04b"
      >
        <el-menu-item index="1">处理中心</el-menu-item>
        <el-submenu index="2">
          <template slot="title">我的工作台</template>
          <el-menu-item index="2-1">选项1</el-menu-item>
          <el-menu-item index="2-2">选项2</el-menu-item>
          <el-menu-item index="2-3">选项3</el-menu-item>
          <el-submenu index="2-4">
            <template slot="title">选项4</template>
            <el-menu-item index="2-4-1">选项1</el-menu-item>
            <el-menu-item index="2-4-2">选项2</el-menu-item>
            <el-menu-item index="2-4-3">选项3</el-menu-item>
          </el-submenu>
        </el-submenu>
        <el-menu-item index="3" disabled>消息中心</el-menu-item>
        <el-menu-item index="4">
          <a href="https://www.ele.me" target="_blank">订单管理</a>
        </el-menu-item>
      </el-menu>
    </el-header>
    <el-main>
      <router-view />
    </el-main>
    <el-footer>
      <copy-right />
    </el-footer>
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
