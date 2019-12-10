<template>
    <div>
        <button class="btn btn-outline-primary" @click="isOpen = !isOpen">
            <template v-if="user.email">{{ user.email }}</template>
            <template v-else>Воход / Регистрация</template>
        </button>
        <div class="container" v-if="isOpen">
            <div class="col-lg-4" >
                <login-form></login-form>
                <register-form></register-form>
            </div>
        </div>
    </div>
</template>


<script>
    import LoginForm from "./LoginForm";
    import RegisterForm from "./RegisterForm";
    import { setToken } from "../../modules/apiToken";

    export default {
        props:['user'],
        name: "AuthForm",
        data() {
            return {
                isOpen: false
            }
        },
        components: {
            RegisterForm,
            LoginForm
        },
        mounted() {
            if (this.user.email) {
                setToken(this.user.api_token);
                this.$store.dispatch('SET_USER',this.user);
            }
        }
    }
</script>

<style scoped>

</style>
