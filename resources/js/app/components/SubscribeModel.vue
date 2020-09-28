<template>
    <div :class="{'modal': true, 'active': active}">
        <div class="modal__wrapper">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-10 offset-md-1 col-lg-8 offset-lg-2 offset-xl-1 col-xl-8 offset-xl-2"> <!-- html change new -->

                        <div class="modal-body">
                            <div class="modal__t-figure"></div>
                            <div class="modal__f-figure"></div>
                            <div class="modal-body__figure"></div>
                            <div class="modal-body__cross" @click="active = false">
                                <div class="times-svg"></div>
                            </div>
                            <!-- Track the date -->
                            <div class="modal__var modal__second-var" v-if="!successSend">
                                <div class="row">
                                    <div class="col-xl-6 offset-xl-3">
                                        <div class="modal__title-type-second">
                                            <span>Следите за датой</span>
                                        </div>
                                        <div class="modal__subtitle-type-second">
                                            <span>
                                                Нет подходящих предложений?
                                                Подпишитесь на вашу дату и как только что-то появится, мы вам сообщим.
                                                Ваши данный мы никому не сообщаем
                                            </span>
                                        </div>
                                        <div class="modal__form-second-type">
                                            <form action="">
                                                <label class="modal__label" :class="{invalid:!!errors.email.length}">
                                                    <span class="modal__input-name">Ваша почта</span>
                                                    <input type="text" v-model="email" placeholder="eventoutlet@gmail.com">
                                                    <span class="validation" v-for="error in errors.email">{{ error }}</span>
                                                </label>
                                                <label class="form__label" ref="dateSelect" :class="{invalid:!!errors.dates.length}">
                                                    <span>Выберите дату или диапазон дат</span>
                                                    <div class="form__select" :class="{'show':openDateSelect}">
                                                        <div class="form__select-intro" @click.stop="openDateSelect = !openDateSelect">
                                                            <span v-if="dates.length">{{ formatDate }}</span>
                                                            <span v-else>Выбрать дату</span>
                                                            <span class="arrow-svg"></span>
                                                        </div>
                                                        <div class="form__select-body select-body-second-type">
                                                            <div class="form__select-title">
                                                                <span>Выбрать дату</span>
                                                            </div>
                                                            <div class="form__select-wrapper select-wrapper-second-type">
                                                                <v-calendar
                                                                    mode="multiple"
                                                                    class="calendar main-calendar"
                                                                    title-position="left"
                                                                    v-model="dates"
                                                                    is-inline
                                                                    color="red"
                                                                    :popover="{ placement: 'bottom', visibility: 'click' }">
                                                                </v-calendar>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <span class="validation" v-for="error in errors.date">{{ error }}</span>
                                                </label>
                                                <div class="form__label" ref="specialtySelect">
                                                    <span>Выберите специалиста, но это не обязательно </span>
                                                    <div class="form__select" :class="{show:openSpecialtySelect}">
                                                        <div class="form__select-intro" @click="openSpecialtySelect = !openSpecialtySelect">
                                                            <span v-if="!specialitySelectedList.length">Выбрать специалиста</span>
                                                            <span>{{ formatSpecialty }}</span>
                                                            <span class="arrow-svg"></span>
                                                        </div>
                                                        <div class="form__select-body">
                                                            <div class="form__select-title">
                                                                <span>Выбрать специалиста</span>

                                                            </div>
                                                            <div class="form__select-wrapper">
                                                                <div class="form__select-list mscroll" data-simplebar data-simplebar-auto-hide="false">

                                                                    <label v-for="specialty in specialities" :key="'spec-' + specialty.id" class="collapse-checkbox filter-checkbox">
                                                                        <input type="checkbox" :value="specialty.id" v-model="specialitySelectedList">
                                                                        <span class="checkmark"></span>
                                                                        <span class="collapse-checkbox__title">{{ specialty.name }}</span>
                                                                    </label>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <label class="form__label" :class="{invalid:!!errors.city_id.length}">
                                                    <span>Выберите город</span>
                                                    <select-app
                                                        v-if="cities"
                                                        :options="cities"
                                                        select-value="id"
                                                        select-name="name"
                                                        v-model="city_id"
                                                        description="Выберете ваш город"
                                                        empty-selected="Выберете ваш город"
                                                    ></select-app>
                                                    <span class="validation" v-for="error in errors.city_id">{{ error }}</span>
                                                </label>

                                                <div class="checkpol">
                                                    <label class="filter-checkbox">
                                                        Я даю согласие на обработку персональных данных
                                                        <input type="checkbox" checked="checked" v-model="agree">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>

                                                <div class="track-button-modal">
                                                    <a href="#" class="benefits-btn yellow" @click.prevent="sendForm">
                                                        <div class="bell-svg"></div>
                                                        <span>Следить за датой</span>
                                                        <div class="full-arrow-svg"></div>
                                                    </a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end track -->
                            <div class="modal__var thanks-modal" v-else>
                                <div class="row">
                                    <div class="col-xl-6 offset-xl-3">
                                        <div class="modal__title">
                                            <span>Заявка успешно создана!</span>
                                        </div>
                                        <div class="modal__subtitle">
                                            <span>Вам на почту было отправлено письмо для подтверждения</span>
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


import VCalendar from 'v-calendar/lib/components/date-picker.umd';
import SelectApp from "./SelectApp";
import axios from '../modules/axios';
import dayjs from 'dayjs';

export default {
    props: ['specialities', 'cities'],
    name: "SubscribeModal",
    data () {
        return {
            email:'',
            dates:[],
            active: false,
            agree:true,
            openDateSelect: false,
            selectedSpeciality: [],
            city_id:0,
            successSend:false,
            specialitySelectedList: [],
            openSpecialtySelect:false,
            errors: {
                email:[],
                dates:[],
                city_id:[]
            }
        }
    },
    computed: {
        formatDate() {
            return this.dates.map(date => {
                return dayjs(date).format('DD.MM.YYYY')
            }).join(', ');
        },
        formatSpecialty() {
            return this.specialitySelectedList.map(spec => {
                return this.specialities.filter(item => item.id == spec)[0].name;
            }).join(', ');
        }
    },
    methods: {
        addSpeciality() {
            this.specialitySelectedList.push({
                value: 0
            });
        },
        sendForm() {

            if (this.agree) {
                axios.post('/subscriber', {
                    email: this.email,
                    dates: this.dates.map(date => {
                        return dayjs(date).format('DD.MM.YYYY')
                    }),
                    city_id: this.city_id,
                    specialities: this.specialitySelectedList
                })
                .then((response) => {
                    this.successSend = true;
                    //this.active = false;
                })
                .catch(({response}) => {
                    if (response.status === 422) {
                        let errors = response.data.errors;

                        this.errors.email = errors.email || [];
                        this.errors.dates = errors.dates || [];
                        this.errors.city_id = errors.city_id || [];
                    }
                })
            }


        },
        documentClick(e){
            let el = this.$refs.dateSelect;
            let target = e.target;
            if ( (el !== target) && !el.contains(target)) {
                this.openDateSelect = false
            }
        },

        documentClick2(e){
            let el = this.$refs.specialtySelect;
            let target = e.target;
            if ( (el !== target) && !el.contains(target)) {
                this.openSpecialtySelect = false
            }
        },
    },
    components: {
        VCalendar,
        SelectApp
    },
    mounted() {
        document.addEventListener('click', this.documentClick)
        document.addEventListener('click', this.documentClick2)

        window.addEventListener('load',  () =>  {

            document.querySelectorAll('.subscription-btn').forEach(el => {
                el.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.active = true;
                });
            });
        });

    }
}
</script>

<style scoped>
    .form__select-intro > span {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: block;
        padding-right: 10px;
    }
</style>
