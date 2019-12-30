<template>
    <div id="login">
        <div
            class="mask"
            :style="{ backgroundImage: `url(${BackgroundImg})` }"
        ></div>
        <div class="form-card animated fadeIn faster">
            <div class="title">{{ $route.meta.title }}</div>
            <el-form :model="form" status-icon :rules="rules" ref="form">
                <el-form-item prop="username">
                    <el-input
                        type="text"
                        name="username"
                        v-model="form.username"
                        clearable
                        autocomplete="off"
                        placeholder="请输入账号（工号）"
                        prefix-icon="el-icon-user"
                    ></el-input>
                </el-form-item>

                <el-form-item prop="password">
                    <el-input
                        type="password"
                        name="password"
                        v-model="form.password"
                        show-password
                        autocomplete="off"
                        placeholder="请输入密码"
                        prefix-icon="el-icon-lock"
                    ></el-input>
                </el-form-item>

                <el-form-item prop="remember">
                    <el-checkbox
                        label="true"
                        name="remember"
                        v-model="form.remember"
                        >记住我</el-checkbox
                    >
                </el-form-item>

                <el-form-item>
                    <el-button
                        type="primary"
                        class="full-width"
                        @click="submitForm('form')"
                        :loading="$store.state.admin.loading"
                        >登 录</el-button
                    >
                </el-form-item>
                <router-link to="reset-password" class="el-link el-link--info">
                    <span class="el-link--inner">忘记密码？</span>
                </router-link>
                <router-link
                    to="register"
                    class="register el-link el-link--primary"
                >
                    <span class="el-link--inner">
                        注册
                        <i class="el-icon-d-arrow-right"></i>
                    </span>
                </router-link>
            </el-form>
        </div>
        <copy-right class="copy-right-fixed" />
    </div>
</template>

<script>
import CopyRight from "@/views/layouts/CopyRight";
import BackgroundImg from "@images/background.01.jpg";
export default {
    components: { CopyRight },
    data() {
        return {
            BackgroundImg,
            form: {
                username: "",
                password: "",
                remember: false
            },
            rules: {
                username: [{ required: true, message: "请输入工号" }],
                password: [{ required: true, message: "请输入密码" }]
            },
            loading: false
        };
    },
    methods: {
        submitForm(formName) {
            this.$refs[formName].validate(valid => {
                if (valid) {
                    this.$http.post("/login", this.form).then(response => {
                        storeAuthToken(response.data);
                    });
                }
            });
        },
        resetForm(formName) {
            this.$refs[formName].resetFields();
        }
    },
    mounted: function() {
        console.log(this.$store);
    }
};
</script>

<style lang="scss" scoped>
#login {
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
        background-position: center;
    }
    .form-card {
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
