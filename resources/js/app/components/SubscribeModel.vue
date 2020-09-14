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
                            <div class="modal__var modal__second-var">
                                <div class="row">
                                    <div class="col-xl-6 offset-xl-3">
                                        <div class="modal__title-type-second">
                                            <span>Следите за датой</span>
                                        </div>
                                        <div class="modal__subtitle-type-second">
                                            <span>Если у вас есть вопросы по сотрудничеству, предложения или обратная связь по работе портала, пишите нам! Нам очень важно быть с вами на связи.</span>
                                        </div>
                                        <div class="modal__form-second-type">
                                            <form action="">
                                                <label class="modal__label" for="">
                                                    <span class="modal__input-name">Ваше Имя</span>
                                                    <input type="text" v-model="email" placeholder="Александр">
                                                </label>
                                                <label class="form__label">
                                                    <span>Выберите дату или диапазон дат </span>
                                                    <div class="form__select" :class="{'show':openDateSelect}">
                                                        <div class="form__select-intro" @click="openDateSelect = !openDateSelect ">
                                                            <span>Выбрать дату</span>
                                                            <span class="arrow-svg"></span>
                                                        </div>
                                                        <div class="form__select-body select-body-second-type">
                                                            <div class="form__select-title">
                                                                <span>Выбрать дату</span>
                                                            </div>
                                                            <div class="form__select-wrapper select-wrapper-second-type">
                                                                <v-calendar
                                                                    class="calendar main-calendar"
                                                                    title-position="left"
                                                                    v-model="date"
                                                                    is-inline
                                                                    color="red"
                                                                    :popover="{ placement: 'bottom', visibility: 'click' }">
                                                                </v-calendar>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </label>

                                                    <label class="form__label">
                                                        <span>Выберите специалиста, но это не обязательно </span>
                                                        <template v-for="sel in specialitySelectedList">
                                                        <select-app
                                                            v-if="specialities"
                                                            :options="specialities"
                                                            select-value="id"
                                                            select-name="name"
                                                            v-model="sel.value"
                                                            @input="addSpeciality"
                                                            description="Выберете вашу специальность"
                                                            empty-selected="Выберете вашу специальность"
                                                        ></select-app>
                                                         </template>
                                                    </label>

                                                <label class="form__label">
                                                    <span>Выберите город</span>
                                                    <select-app
                                                        v-if="cities"
                                                        :options="cities"
                                                        select-value="id"
                                                        select-name="name"
                                                        v-model="selectedCity"
                                                        description="Выберете ваш город"
                                                        empty-selected="Выберете ваш город"
                                                    ></select-app>
                                                </label>

                                                <div class="checkpol">
                                                    <label class="filter-checkbox">
                                                        Я даю согласие на обработку персональных данных
                                                        <input type="checkbox" checked="checked" v-model="agree">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>

                                                <div class="track-button-modal">
                                                    <a href="#" class="benefits-btn yellow" @click="sendForm">
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

export default {
    props: ['specialities', 'cities'],
    name: "SubscribeModal",

    data () {
        return {
            email:'denis.budancev@gmail.com',
            date:null,
            active: true,
            agree:true,
            openDateSelect: false,
            selectedSpeciality: 0,
            selectedCity:0,
            specialitySelectedList: [{value:0}]
        }
    },
    methods: {
        addSpeciality() {
            this.specialitySelectedList.push({
                value: 0
            });
        },
        sendForm() {
            // console.log({

            // });

            axios.post('/subscriber', {
                email: this.email,
                date: this.date,
                city_id: this.selectedCity,
                specialities: this.specialitySelectedList.map(speciality => speciality.value),
                agree: this.agree
            })
        }
    },
    components: {
        VCalendar,
        SelectApp
    },
    created() {
        document.querySelector('.subscription-btn').addEventListener('click', (e) => {
            e.preventDefault();
            this.active = true;
        });
    }
}
</script>

<style scoped>

</style>
