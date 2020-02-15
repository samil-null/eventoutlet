<template>
    <div class="alert__wrapper active">
        <div class="alert" :class="{
            active:alert.active,
            success: (alert.type === 'success'),
            error: (alert.type === 'error')
        }" v-for="(alert, index) in alerts" :key="'message-id-'+ index">
            <div class="alert__body">
                <div class="alert__color">
                    <div class="alert__sign">
                        <div class="check-mark-svg"></div>
                        <div class="exclamation-svg"></div>
                        <div class="times-svg"></div>
                    </div>
                </div>
                <div class="alert__intro">
                    <div class="times-svg" @click="alert.active = false"></div>
                    <div class="alert__head"><span class="alert__title"> Успешно </span></div>
                    <div class="alert__subtitle">
                        <p>{{ alert.body }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Alert",
        props:['messages'],
        data() {
            return {
                alerts:[]
            }
        },
        created() {
            setTimeout(() => {
                this.alerts = this.messages.map(message => {
                    let title;
                    switch (message.type) {
                        case 'success':
                            title = 'Успешно';
                            break;
                        case 'error':
                            title = 'Ошибка';
                    }
                    return {
                        title: title,
                        body: message.body,
                        type:message.type,
                        active:true
                    }
                })

                this.alerts.forEach(alert => {
                    setTimeout(() => {
                        alert.active = false
                    },5000)
                });
            },500)
        }
    }
</script>

<style scoped>
    .alert__intro {
        width: 100%;
    }
</style>
