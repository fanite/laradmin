<template>
  <el-card>
    <el-row>
      <el-col :span="10">
        <el-avatar shape="square" :size="120" fit="fill" :src="url" class="avatar"></el-avatar>
        <span class="user-name">方高平</span>
        <dl class="user-info">
          <dt>工号</dt>
          <dd>
            <i class="el-icon-ice-tea"></i> 101005151
          </dd>
          <dt>电话</dt>
          <dd>
            <i class="el-icon-mobile"></i> 18676674421
          </dd>
          <dt>E-Mail</dt>
          <dd>
            <i class="el-icon-message"></i> fanggaoping@huaqin.com
          </dd>
          <dt>工作地点</dt>
          <dd>
            <i class="el-icon-location-outline"></i> 东莞
          </dd>
        </dl>
      </el-col>
    </el-row>
  </el-card>
</template>

<script>
export default {
  data() {
    return {
      url:
        "https://fuss10.elemecdn.com/e/5d/4a731a90594a4af544c0c25941171jpeg.jpeg"
    };
  }
};
</script>
