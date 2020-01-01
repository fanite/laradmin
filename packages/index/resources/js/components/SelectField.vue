<template>
  <el-select v-model="selectValue" v-bind="$attrs">
    <el-option v-for="item in options" :key="item.id" :label="item.text" :value="item.field_value"></el-option>
  </el-select>
</template>

<script>
export default {
  inheritAttrs: false,
  props: {
    value: {
      type: [String, Number, Boolean],
      required: true
    }
  },
  data() {
    return {
      selectValue: this.value,
      options: []
    };
  },
  watch: {
    value(newValue) {
      this.selectValue = newValue;
    },
    selectValue(newVal, oldVal) {
      if (newVal !== oldVal) {
        this.$emit("input", this.selectValue);
      }
    }
  },
  methods: {
    fetchFields() {
      this.$http.get("/user/fields/account_type").then(resp => {
        this.options = resp.data.data;
      });
    }
  },
  mounted: function() {
    this.fetchFields();
  }
};
</script>