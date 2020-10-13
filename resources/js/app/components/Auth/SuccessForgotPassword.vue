<template>
    <div class="modal__var thanks-modal">
        <div class="row">
            <div class="col-xl-6 offset-xl-3">
                <div class="modal__title">
                    <span>Пароль отправлен на вашу почту</span>
                </div>
                <div class="modal__subtitle">
                    <span>Мы отправили письмо с инструкцией по восстановлению пароля на вашу почту.</span>
                </div>
                <div class="modal__form">
                    <a href="#" @click="$emit('switch-to-login')" class="rectangle-btn-border rectangle-btn-border-green">
                        <span>Вход</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SuccessForgotPassword"
    }
</script>

<style scoped>

</style>
