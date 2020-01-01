<template>
    <div id="reset-password">
        <div
            class="mask"
            :style="{ backgroundImage: `url(${BackgroundImg})` }"
        ></div>
        <div class="form-card animated fadeIn faster">
            <el-form :inline="true" :model="form">
                <el-form-item>
                    <el-input
                        v-model="form.email"
                        placeholder="邮箱地址"
                    ></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit"
                        >重置密码</el-button
                    >
                </el-form-item>
            </el-form>
        </div>
        <copy-right class="copy-right-fixed" />
    </div>
</template>

<script>
import CopyRight from "@/views/layouts/CopyRight";
import BackgroundImg from "@images/background.03.jpg";
export default {
    components: { CopyRight },
    data() {
        return {
            BackgroundImg,
            form: {
                email: ""
            }
        };
    },
    methods: {
        onSubmit() {
            console.log(this.form);
        }
    }
};
</script>

<style lang="scss" scoped>
#reset-password {
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
        border-radius: 5px;
        padding: 30px;
        z-index: 3000;
        .el-input__inner,
        .el-button {
            background-color: unset;
        }
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
