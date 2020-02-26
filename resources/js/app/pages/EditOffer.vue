<template>
    <div>
        <section class="profile-edit">
            <div class="container">
                <div class="profile-edit__content">
                    <div class="row no-gutters">
                        <div class="col-md-12 col-lg-3 col-xl-3">
                            <div class="profile-edit__card-wrapper">
                                <div class="profile-edit__card profile-special">
                                    <div class="profile-edit__card-photo" :style="{'background-image': `url(${avatar})`}"></div>
                                    <div class="profile-edit__name"><span>{{ user.name }}</span></div>
                                    <div class="profile-edit__prof"><span>{{ user.speciality.name }}</span></div>
                                    <div class="pe-block__add-btn">
                                        <a :href="editProfileLink" class="add-btn"> <span>Редактировать профиль</span> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-8 col-xl-8 offset-lg-1 offset-xl-1">
                            <div class="profile-edit__wrapper">
                                <a href="#" onclick="window.history.back()" class="back-btn back-btn-white">
                                    <span class="back-arrow-svg"></span> <span>Назад</span>
                                </a>
                                <div class="profile-edit__title"><span>Спецпредложения</span></div>
                                <form @submit.prevent="updateOffer" class="profile-edit__body profile-special__body">
                                    <!-- Line -->
                                    <div class="pe-block">
                                        <div class="pe-block__form form">
                                            <div>
                                                <div class="row">
                                                    <div class="col-12 col-sm-12 col-md-6 col-xl-6">
                                                        <label class="form__label">
                                                            <select-app
                                                                :options="services"
                                                                select-value="id"
                                                                select-name="name"
                                                                v-model="offer.service_id"
                                                                description="Выберете услугу"
                                                                empty-selected="Выберете услугу"
                                                            ></select-app>
                                                        </label>
                                                        <label class="form__label">
                                                            <span>Выбериет дату, несколько дат или диапазон дат </span>

                                                            <edit-offer-date-picker
                                                                :raw-dates="offer.dates"
                                                                v-model="dates"
                                                                v-if="offer.dates"
                                                                :min-date="minDate"
                                                                :max-date="maxDate"
                                                            ></edit-offer-date-picker>
                                                        </label>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-6 col-xl-6">
                                                        <discount-select v-model="discount" v-if="offer.discount"></discount-select>
                                                        <label class="form__label">
                                                            <span>Дополнительные условия предложения</span>
                                                            <textarea-app
                                                                v-model="offer.description"
                                                                :limit="500"
                                                            ></textarea-app>
                                                            <div class="profile-special__label-comment">
                                                                <p>
                                                                    Здесь укажите все, что может повлиять на стоимость ваших услуг. Минимальное время
                                                                    или количество. Территориальные предпочтения. И прочее.
                                                                </p>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pe-block__add-btn">
                                        <button type="submit" class="add-btn add-btn-green">
                                            <div class="plus"><span></span> <span></span></div>
                                            <span>Обновить спецпредложение</span>
                                        </button>
                                    </div>
                                </form>
                                <edit-offer-items
                                    @success-update="successPublishedOffers"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <alert :messages="alertMessages" v-if="isActiveAlert" />
        </section>
    </div>

</template>

<script>
    import axios from '../modules/axios'
    import SelectApp from "../components/SelectApp";
    import EditOfferItems from "../components/EditOfferItems";
    import DiscountSelect from "../components/DiscountSelect";
    import TextareaApp from "../components/TextareaApp";
    import EditOfferDatePicker from "../components/Datepickers/EditOfferDatePicker";
    import Alert from "../components/Alert";
    import dayjs from 'dayjs';

    export default {
        name: "CreateOffer",
        props:['offerId', 'editProfileLink'],
        data() {
            return {
                services:[],
                offers:[],
                discount:0,
                service:0,
                description:null,
                dates:[],
                user:{},
                avatar:{},
                selectService:{},
                minDate:null,
                maxDate:null,
                offer:{},
                alertMessages:[],
                isActiveAlert:false,
            }
        },
        methods: {
            successPublishedOffers() {
                this.triggerAlert([{
                    type:'success',
                    body:'Ваши предложения успешно опубликованы'
                }]);
            },
            updateOffer() {
                let dates = [];

                dates = this.dates.map(date => {
                    return dayjs(date.toString()).format('YYYY-MM-DD')
                });

                let payload = {
                    service_id: this.offer.service_id,
                    dates: dates,
                    discount: this.discount,
                    description: this.offer.description,
                };

                axios.put('/app/offers/' + this.offer.id, payload)
                    .then(({data}) => {
                        this.triggerAlert([{
                            type:'success',
                            body:'Ваши предложение успешно обновлено'
                        }]);
                    })
                    .catch(({response}) => {
                        if (response.status === 422) {
                            let errors = response.data.errors;
                            let messages = [];
                            for(let key in errors) {
                                errors[key].map(er => {
                                    messages.push({
                                        type:'error',
                                        body: er
                                    });
                                })
                            }
                            this.triggerAlert(messages);
                        }
                    })
            },
            triggerAlert(messages) {
                this.isActiveAlert = true;
                this.alertMessages = messages;
                setTimeout(() => {
                    this.isActiveAlert = false
                    this.alertMessages = [];
                }, 5000);
            }
        },
        mounted() {
            axios.get('/app/offers/create')
                .then(res => res.data.data)
                .then(data => {
                    console.log(data);
                    this.user = data.user;
                    this.avatar = data.avatar;
                    this.services = data.services;
                    this.minDate = data.minDate;
                    this.maxDate = data.maxDate;
                })
            axios.get('/app/offers/' + this.offerId)
                .then(res => res.data.data)
                .then(data => {
                    this.offer = data.offer;
                    this.discount = data.offer.discount;
                })
        },
        components: {
            EditOfferDatePicker,
            SelectApp,
            DiscountSelect,
            TextareaApp,
            EditOfferItems,
            Alert
        }
    }
</script>

<style scoped>

</style>
