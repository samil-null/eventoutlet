<template>
    <div class="modal" :class="{active}">
      <div class="modal__wrapper">
        <div class="container">
          <div class="row no-gutters">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-10 offset-md-1 col-lg-8 offset-lg-2 offset-xl-1 col-xl-8 offset-xl-2">
              <div class="modal-body">
                <div class="modal__f-figure"></div>
                <div class="modal__s-figure"></div>
                <div class="modal-body__figure"></div>
                <div class="modal-body__cross" @click="active = false">
                  <div class="times-svg"></div>
                </div>
                <!-- Callback ememe  -->
                <div class="modal__var" v-if="!success">
                  <div class="row">
                    <div class="col-xl-6 offset-xl-3">
                      <div class="modal__title">
                        <span>Обратная связь</span>
                      </div>
                      <div class="modal__subtitle">
                        <span>Если у вас есть вопросы по сотрудничеству, предложения или обратная связь по работе портала, пишите нам! Нам очень важно быть с вами на связи.</span>
                      </div>
                      <div class="modal__form">
                        <form action="" @submit.prevent="send">
                          <label class="modal__label" for="" :class="{invalid:!!errors.name.length}">
                            <span class="modal__input-name">Ваше Имя</span>
                            <input type="text" placeholder="Александр" v-model="name">
                             <span class="validation" v-for="error in errors.name">{{ error }}</span>
                          </label>
                          <label class="modal__label" for="" :class="{invalid:!!errors.email.length}">
                            <span class="modal__input-name">Ваша почта</span>
                            <input type="email" placeholder="eventoutlet@gmail.com" v-model="email">
                             <span class="validation" v-for="error in errors.email">{{ error }}</span>
                          </label>
                          <label class="modal__label" for="" :class="{invalid:!!errors.topic.length}">
                            <span class="modal__input-name">Тема</span>
                            <input type="text" placeholder="Тема сообщения" v-model="topic">
                             <span class="validation" v-for="error in errors.topic">{{ error }}</span>
                          </label>
                          <label class="form__label" :class="{invalid:!!errors.message.length}">
                            <span>Сообщение</span>
                            <div class="form__textarea-wrapp">
                              <textarea v-model="message" class="form__textarea" placeholder="Начните писать"></textarea>
                             <span class="validation" v-for="error in errors.topic">{{ error }}</span>
                            </div>
                          </label>

                          <button type="submit" class="rectangle-btn rectangle-btn-green">
                            <span>Отправить</span>
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal__var thanks-modal" v-else>
                    <div class="row">
                        <div class="col-xl-6 offset-xl-3">
                            <div class="modal__title">
                                <span>Заявка успешно отправлена!</span>
                            </div>
                            <div class="modal__subtitle">
                                <span>Спасибо за обращение</span>
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
import axios from '../modules/axios';

export default {
    data() {
        return {
            active:false,
            name:'',
            email:'',
            topic:'',
            message:'',
            success: false,
            errors: {
                name:[],
                email:[],
                topic:[],
                message:[]
            }
        }
    },
    methods: {
        send() {
            let payload = {
                name: this.name,
                email: this.email,
                topic: this.topic,
                message: this.message
            }

            axios.post('/app/feedback', payload)
                .then(({data}) => {
                    if (data.success == true) {
                        this.success = true;

                        this.errors.name = [];
                        this.errors.topic = [];
                        this.errors.email = [];
                        this.errors.message = [];
                    }
                })
                .catch(({response}) => {
                        if (response.status === 422) {
                            this.errors.name = response.data.errors.name || [];
                            this.errors.topic = response.data.errors.topic || [];
                            this.errors.email = response.data.errors.email || [];
                            this.errors.message = response.data.errors.message || [];
                        }
                    })
        }
    },
    mounted() {
        document.querySelectorAll('.feedback-open-trigger').forEach(item => {
            item.addEventListener('click', e => {
                e.preventDefault();
                this.active = true;
            })
        })
    }
}
</script>
