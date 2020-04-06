<template>
    <section id="pass-recovery" class="pass-recovery">
        <div class="container">
            <div class="pass-recovery__wrapper">
                <div class="pass-recovery__title">
                    <div class="modal__title"><span>Восстановление пароля</span></div>
                </div>
                <div class="modal__subtitle"><span>Введите новый пароль. Новый пароль не должен совпадать со старым паролем.</span></div>
                <div class="pass-recovery__body">
                    <form action="" @submit.prevent="change">
                        <label class="form__label" :class="{invalid:!!errors.password.length}">
                            <span>Новый пароль</span>
                            <input type="password" v-model="password" placeholder="********" class="form__input">
                            <span class="validation" v-for="error in errors.password">{{ error }}</span>
                        </label>
                        <label class="form__label" :class="{invalid:!!errors.password_confirmation.length}">
                            <span>Подтверждение пароля</span>
                            <input type="password" v-model="password_confirmation" placeholder="********" class="form__input">
                            <span class="validation" v-for="error in errors.password_confirmation">{{ error }}</span>
                        </label>
                        <div class="pass-recovery__save-button">
                            <button class="rectangle-btn rectangle-btn-green"><span>Сохранить пароль</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import axios from '../modules/axios'
    export default {
        props:['token'],
        name: "ChangePassword",
        data() {
            return {
                password:'',
                password_confirmation:'',
                errors:{
                    password:[],
                    password_confirmation:[]
                }
            }
        },
        methods: {
            change() {
                let payload = {
                    password:this.password,
                    password_confirmation:this.password_confirmation,
                    token: this.token
                }

                axios.post('/auth/forgot/change', payload)
                    .then(({data}) => {
                        if (data.success) {
                            this.errors.email = [];
                            this.errors.password = [];
                            this.errors.password_confirmation = [];
                            //
                            location.href = '/';
                        }
                    })
                    .catch(({response}) => {
                        if (response.status === 422) {
                            this.errors.email = response.data.errors.email || [];
                            this.errors.password = response.data.errors.password || [];
                            this.errors.password_confirmation = response.data.errors.password_confirmation || [];
                        }
                    })
            }
        }
    }
</script>

<style scoped>

</style>
