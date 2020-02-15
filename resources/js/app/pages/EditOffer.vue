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
                                <form @submit.prevent="createOffer" class="profile-edit__body profile-special__body">
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
                                                                v-if="offer.dates"
                                                            ></edit-offer-date-picker>
                                                        </label>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-6 col-xl-6">
                                                        <discount-select v-model="discount"></discount-select>
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
                                <div class="profile-special__title"><span>Ваши спецпредложения</span></div>
                                <edit-offer-items></edit-offer-items>
                                <div class="profile-special__footer">
                                    <div class="profile-special__political">
                                        <div class="additional_filters__checkbox">
                                            <label class="filter-checkbox">
                                                Публикую данное предложение вы подвтерждаете свою готовность принять заказ по указанным вами
                                                условиям. <a href="#">Более подробные условия работы портала Event Outlet.</a>
                                                <input type="checkbox" checked="checked" /> <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="pe-block__save-button">
                                        <a href="#" class="rectangle-btn rectangle-btn-green"> <span>Опубликовать</span> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                dates:null,
                user:{},
                avatar:{},
                selectService:{},
                minDate:null,
                maxDate:null,
                offer:{}
            }
        },
        methods: {
            createOffer() {
                let payload = {
                    service_id: this.selectService,
                    dates: this.dates,
                    discount: this.discount,
                    description: this.description,
                }

                axios.post('/app/offers', payload)
                    .then(({data}) => {
                        location.href = data.data.url;
                    })
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
                    this.minDate = data.min_date;
                    this.maxDate = data.max_date;
                })
            axios.get('/app/offers/' + this.offerId)
                .then(res => res.data.data)
                .then(data => {
                    this.offer = data.offer;
                })
        },
        components: {
            EditOfferDatePicker,
            SelectApp,
            DiscountSelect,
            TextareaApp,
            EditOfferItems
        }
    }
</script>

<style scoped>

</style>
