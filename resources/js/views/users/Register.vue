<template>
  <div id="register">
    <div class="mask" :style="{ backgroundImage: `url(${BackgroundImg})` }"></div>
    <div class="form-card animated fadeIn faster">
      <div class="title">{{ $route.meta.title }}</div>
      <el-form :model="form" :rules="rules" ref="form" class="register-form">
        <el-form-item prop="fullname">
          <el-input
            type="text"
            v-model="form.fullname"
            clearable
            autocomplete="off"
            placeholder="姓名"
            prefix-icon="el-icon-user-solid"
          ></el-input>
        </el-form-item>
        <el-form-item prop="staff_code">
          <el-input
            type="text"
            v-model="form.staff_code"
            clearable
            autocomplete="off"
            placeholder="请输入账号（工号）"
            prefix-icon="el-icon-user"
          ></el-input>
        </el-form-item>
        <el-form-item prop="email">
          <el-input
            type="text"
            v-model="form.email"
            clearable
            autocomplete="off"
            placeholder="公司邮箱地址"
            prefix-icon="el-icon-message"
          ></el-input>
        </el-form-item>
        <el-form-item prop="password">
          <el-input
            type="password"
            v-model="form.password"
            clearable
            autocomplete="off"
            placeholder="密码"
            prefix-icon="el-icon-unlock"
            show-password
          ></el-input>
        </el-form-item>
        <el-form-item prop="password_confirmation">
          <el-input
            type="password"
            v-model="form.password_confirmation"
            clearable
            autocomplete="off"
            placeholder="确认密码"
            prefix-icon="el-icon-lock"
            show-password
          ></el-input>
        </el-form-item>
        <el-form-item>
          <select-field v-model="form.type" class="full-width" placeholder="请选择用户类型"></select-field>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="submitForm('form')">马上注册</el-button>
          <el-button @click="resetForm('form')">重置</el-button>
        </el-form-item>
      </el-form>
    </div>
    <copy-right class="copy-right-fixed" />
  </div>
</template>

<script>
import CopyRight from "@/views/layouts/CopyRight";
import SelectField from "@/components/SelectField";
import BackgroundImg from "@images/background.01.jpg";
export default {
  components: { CopyRight, SelectField },
  data() {
    const validatePass = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("请输入密码"));
      } else {
        if (this.form.password_confirmation !== "") {
          this.$refs.form.validateField("password_confirmation");
        }
        callback();
      }
    };
    const validatePassConfirm = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("请再次输入密码"));
      } else if (value !== this.form.password) {
        callback(new Error("两次输入密码不一致!"));
      } else {
        callback();
      }
    };

    return {
      BackgroundImg,
      form: {
        fullname: "",
        staff_code: "",
        email: "",
        password: "",
        password_confirmation: "",
        type: "staff"
      },
      rules: {
        fullname: [
          { required: true, message: "请输入你的姓名", trigger: "blur" }
        ],
        staff_code: [
          { required: true, message: "请输入你的工号", trigger: "blur" }
        ],
        email: [
          {
            required: true,
            pattern: /^\w+([-+.]\w+)*@huaqin.com$/,
            message: "请输入正确的邮箱地址",
            trigger: "blur"
          }
        ],
        password: [
          { validator: validatePass, trigger: "blur" },
          { min: 8, max: 12, message: "密码长度为8~12", trigger: true }
        ],
        password_confirmation: [
          { validator: validatePassConfirm, trigger: "blur" }
        ]
      }
    };
  },
  methods: {
    submitForm(formName) {
      this.$refs[formName].validate(valid => {
        if (valid) {
          this.$http.post("/register", this.form).then(response => {
            console.log(response.data);
          });
        }
      });
    },
    resetForm(formName) {
      this.$refs[formName].resetFields();
    }
  }
};
</script>

<style lang="scss" scoped>
#register {
  height: 100%;
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
  .mask {
    height: inherit;
    width: inherit;
    filter: blur(10px);
    transform: scale(1.2);
    z-index: 2999;
    position: absolute;
    background-size: cover;
  }
  .form-card {
    width: 280px;
    border-radius: 5px;
    padding: 30px;
    z-index: 3000;
    background-color: #fff;
  }
  .title {
    height: 68px;
    font-size: x-large;
    font-weight: bold;
    text-align: center;
    color: lightslategray;
  }
}
</style>