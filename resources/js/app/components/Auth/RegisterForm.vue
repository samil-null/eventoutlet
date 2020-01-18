<template>
    <div>
        <form action="" @submit.prevent="send">
            <div class="modal__var">
                <div class="row">
                    <div class="col-xl-6 offset-xl-3">
                        <div class="modal__title">
                            <span>Регистрация</span>
                        </div>
                        <div class="modal__subtitle">
                            <span>Вы можете зарегестрироваться и стать исполнителем в 2 клика на нашем сервисе.</span>
                        </div>
                        <div class="modal__form">
                            <form action="" @submit.prevent="send">
                                <label class="modal__label" for="" :class="{invalid:!!errors.email.length}">
                                    <span class="modal__input-name">Ваша почта</span>
                                    <input type="email"  v-model="email" placeholder="eventoutlet@gmail.com">
                                    <span class="validation" v-for="error in errors.email">{{ error }}</span>
                                </label>
                                <label class="modal__label" for="" :class="{invalid:!!errors.password.length}">
                                    <span class="modal__input-name">Пароль</span>
                                    <input type="password" v-model="password" placeholder="*********">
                                    <span class="validation" v-for="error in errors.password">{{ error }}</span>
                                </label>
                                <label class="modal__label" for="" :class="{invalid:!!errors.password_confirmation.length}">
                                    <span class="modal__input-name">Пароль еще раз</span>
                                    <input type="password" v-model="password_confirmation" placeholder="*********">
                                    <span class="validation" v-for="error in errors.password_confirmation">{{ error }}</span>
                                </label>
                                <button type="submit" class="rectangle-btn rectangle-btn-green">
                                    <span>Зарегестрироваться</span>
                                </button>
                                <a href="#" class="empty-btn" @click="$emit('switch-to-login')">Вход</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import axios from '../../modules/axios'

    export default {
        name: "RegisterForm",
        data() {
            return {
                email:'',
                password:'',
                password_confirmation:'',
                errors: {
                    email:[],
                    password:[],
                    password_confirmation:[]
                }
            }
        },
        methods: {
            send() {
                let payload = {
                    email:this.email,
                    password:this.password,
                    password_confirmation:this.password_confirmation
                }

                axios.post('/auth/register', payload)
                    .then(({data}) => {
                        this.errors.email = [];
                        this.errors.password = [];
                        this.errors.password_confirmation = [];

                        if (data.success) {
                            this.$emit('switch-to-success-register');
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
