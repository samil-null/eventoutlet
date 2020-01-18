<template>
    <div class="modal__var">
        <div class="row">
            <div class="col-xl-6 offset-xl-3">
                <div class="modal__title">
                    <span>Восстановление пароля</span>
                </div>
                <div class="modal__subtitle">
                    <span>Введите почту на которую был зарегистрирован ваш профиль, на него придет письмо с подтверждением смены пароля</span>
                </div>
                <div class="modal__form" @submit.prevent="send">
                    <form action="">
                        <label class="modal__label" for="">
                            <span class="modal__input-name">Ваш почта</span>
                            <input type="email" v-model="email"  placeholder="eventoutlet@gmail.com">
                        </label>

                        <button type="submit" class="rectangle-btn rectangle-btn-green">
                            <span>Восстановить</span>
                        </button>
                        <a href="#" class="empty-btn" @click="$emit('switch-to-login')">Вход</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from '../../modules/axios'

    export default {
        name: "ForgotPasswordForm",
        data() {
            return {
                email:''
            }
        },
        methods: {
            send() {
                let payload = {
                    email: this.email
                }
                axios.post('auth/forgot', payload)
                    .then(({data}) => {
                        if (data.success) {
                            this.$emit('success-forgot-password')
                        }
                    })
            }
        }
    }
</script>

<style scoped>

</style>
