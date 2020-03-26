

<template>

    <div class="modal__var" >
        <div class="row">
            <div class="col-xl-6 offset-xl-3">
                <div class="modal__title">
                    <span>Вход</span>
                </div>
                <div class="modal__subtitle">
                    <span>Введите ваш адрес почты и пароль для входа в личный кабинет.</span>
                </div>
                <div class="modal__form">
                    <span v-if="noAccount">Неверная почта или пароль</span>
                    <form @submit.prevent="send">
                        <label class="modal__label" for="login-email-input" :class="{invalid:(noAccount || errors.email.length)}">
                            <span class="modal__input-name">Ваша почта </span>
                            <input type="email" id="login-email-input" name="email" v-model="email" placeholder="eventoutlet@gmail.com">
                            <span class="validation" v-for="error in errors.email">{{ error }}</span>
                        </label>
                        <label class="modal__label" for="login-password-input" :class="{invalid:noAccount || errors.password.length}">
                            <span class="modal__input-name">Пароль</span>
                            <input type="password" name="password" id="login-password-input" v-model="password" placeholder="*********">
                            <span class="validation" v-for="error in errors.password">{{ error }}</span>
                            <span class="forgot-pass">
                                <a href="#" @click="$emit('forgot-password')">Забыли пароль?</a>
                            </span>
                        </label>
                        <button type="submit" class="rectangle-btn rectangle-btn-green">
                            <span>Вход</span>
                        </button>
                        <a href="#" class="empty-btn" @click="$emit('switch-to-register')">Регистрация</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import axios from '../../modules/axios'

    export default {
        name: "LoginForm",
        data() {
            return {
                email:'',
                password:'',
                noAccount:false,
                errors: {
                    email:[],
                    password:[]
                }
            }
        },
        methods: {
            send() {
                let payload = {
                    email: this.email,
                    password: this.password
                }

                axios.post('/auth/login', payload)
                    .then(res => {
                        this.errors.email = [];
                        this.errors.password = [];

                        return res.data
                    })
                    .then(data => {
                        if (data.success) {
                            location.href = '/'
                        } else {
                            this.noAccount = true;
                        }
                    })
                    .catch(({response}) => {
                        console.log(response);
                        if (response.status == 422) {
                            this.noAccount = false;
                            this.errors.password = response.data.errors.password || [];
                            this.errors.email = response.data.errors.email || [];
                        }
                    });
            },
            forgotPassword() {
                this.$emit('forgot-password');
            }
        }
    }
</script>

<style scoped>

</style>
