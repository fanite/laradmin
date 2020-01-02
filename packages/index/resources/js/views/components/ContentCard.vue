<template>
  <el-card>
    <el-tabs :tab-position="tabPosition" style="height: 200px;">
      <el-tab-pane label="站点导航">站点导航</el-tab-pane>
      <el-tab-pane label="公司通告">公司通告</el-tab-pane>
      <el-tab-pane label="个人消息">角色管理</el-tab-pane>
      <el-tab-pane label="定时任务补偿">定时任务补偿</el-tab-pane>
    </el-tabs>
  </el-card>
</template>
<script>
export default {
  data() {
    return {
      activeName: "second",
      tabPosition: "left"
    };
  },
  methods: {
    handleClick(tab, event) {
      console.log(tab, event);
    }
  }
};
</script>
