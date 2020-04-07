<template>
    <div>
        <div>
            <a href="#" class="oval-btn oval-btn-green" @click="openModal">
                <span>Вход / Регистрация</span>
            </a>
            <div class="modal" :class="{'active':isOpen}"  >
                <div class="modal__wrapper" @click="closeModal" data-close-modal="true">
                    <div class="container">
                        <div class="row no-gutters">
                            <div class="col-xl-8 offset-xl-2">

                                <div class="modal-body">
                                    <div class="modal__f-figure"></div>
                                    <div class="modal__s-figure"></div>
                                    <div class="modal-body__figure"></div>
                                    <div class="modal-body__cross">
                                        <div @click="closeModal" data-close-modal="true" class="times-svg"></div>
                                    </div>
                                    <!-- sign in  -->
                                    <login-form
                                        v-show="activeForm.login"
                                        @forgot-password="switchForm('forgotPassword')"
                                        @switch-to-register="switchForm('register')"
                                    ></login-form>
                                    <!-- sign up  -->
                                    <register-form
                                        v-show="activeForm.register"
                                        @switch-to-login="switchForm('login')"
                                        @switch-to-success-register="switchForm('successRegister')"
                                    ></register-form>
                                    <!-- Password recovery  -->
                                    <forgot-password-form
                                        v-show="activeForm.forgotPassword"
                                        @switch-to-login="switchForm('login')"
                                        @success-forgot-password="switchForm('successForgotPassword')"
                                    ></forgot-password-form>
                                    <!-- Thanks -->
                                    <success-forgot-password
                                        v-if="activeForm.successForgotPassword"
                                        @switch-to-login="switchForm('login')"
                                    ></success-forgot-password>
                                    <success-register
                                        v-show="activeForm.successRegister"
                                        @switch-to-login="switchForm('login')"
                                    >
                                    </success-register>
                                    <!-- Wanna meet? -->
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="acquainted">
                                                <div class="acquainted__wrapper">
                                                    <div class="acquainted__body">
                                                        <div class="acquainted__intro">
                                                            <div class="acquainted__title">
                                                                <span>Мы еще не знакомы?</span>
                                                            </div>
                                                            <div class="acquainted__subtitle">
                                                                <p>Давайте знакомиться. Ознакомитесь с нашим сервисов, чем он будет вам полезен и как выгодно и эффективно его использовать.</p>
                                                            </div>
                                                            <div class="acquainted__button">
                                                                <a href="/process" class="thin-rectangle-btn thin-rectangle-btn-dark">
                                                                    <span>Обучение работе с сервисом</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="acquainted__pic">
                                                            <img src="assets/img/general/meet.png" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import LoginForm from "./LoginForm";
    import RegisterForm from "./RegisterForm";
    import { setToken } from "../../modules/apiToken";
    import ForgotPasswordForm from "./ForgotPasswordForm";
    import SuccessForgotPassword from "./SuccessForgotPassword";
    import SuccessRegister from "./SuccessRegister";

    export default {
        props:['user', 'avatar'],
        name: "AuthForm",
        data() {
            return {
                isOpen: false,
                auth:false,
                activeForm: {
                    login:true,
                    register:false,
                    forgotPassword:false,
                    successForgotPassword:false,
                    successRegister:false
                }
            }
        },
        methods: {
            closeModal(event, prevent = false) {
                if (prevent || event.target.dataset.closeModal) {
                    this.isOpen = false;
                }
            },
            openModal() {
                this.isOpen = true;
            },
            switchForm(form) {
                for (let name in this.activeForm) {
                    this.activeForm[name] = false;
                }

                this.activeForm[form] = true;
            }
        },
        components: {
            SuccessRegister,
            SuccessForgotPassword,
            ForgotPasswordForm,
            RegisterForm,
            LoginForm
        },
        mounted() {
            if (this.user) {
                this.auth = true
            }
            
            document.querySelectorAll('.open-register-modal').forEach(item => {
                item.addEventListener('click', (e) => {
                    this.openModal();
                    this.switchForm('register');
                })
            })
        }
    }
</script>

<style scoped>

</style>
