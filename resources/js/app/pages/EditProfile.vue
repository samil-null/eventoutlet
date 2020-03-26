<template>
    <div>
        <section class="profile-edit">
            <div class="container">
                <div class="profile-edit__content">
                    <div class="row no-gutters">
                        <div class="col-xl-3">
                            <user-card
                                v-if="userCardRender"
                                :avatar="user.avatar.original"
                                :status="user.status_name"
                                :name="user.name"
                                :speciality="user.info.speciality"
                            />
                        </div>
                        <div class="col-xl-8 offset-xl-1">
                            <div class="profile-edit__wrapper">
                                <a href="/lk/profile" class="back-btn back-btn-white">
                                    <span class="back-arrow-svg"></span>
                                    <span>Назад</span>
                                </a>
                                <div class="profile-edit__title">
                                    <span>Редактирование анкеты</span>
                                </div>
                                <form class="profile-edit__body" @submit.prevent="send">
                                    <!-- Line -->
                                    <div class="pe-block">
                                        <div class="pe-block__title">
                                            <span>Личные данные</span>
                                        </div>
                                        <div class="pe-block__form form">
                                            <form action="">
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <label class="form__label" :class="{invalid:!!errors.speciality_id.length}">
                                                            <span>Специальность</span>
                                                            <select-app
                                                                :options="specialities"
                                                                select-value="id"
                                                                select-name="name"
                                                                v-model="form.speciality_id"
                                                                description="Выберете вашу специальность"
                                                                empty-selected="Выберете вашу специальность"
                                                            ></select-app>
                                                            <span class="validation" v-for="error in errors.speciality_id">{{ error }}</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <label class="form__label" :class="{invalid:!!errors.name.length}">
                                                            <span>Имя, фамилия или название</span>
                                                            <input type="text" class="form__input" v-model="form.name" placeholder="Иван Иванов">
                                                            <span class="validation" v-for="error in errors.name">{{ error }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <label class="form__label" :class="{invalid:!!errors.city_id.length}">
                                                            <span>Город</span>
                                                            <select-app
                                                                :options="cities"
                                                                select-value="id"
                                                                select-name="name"
                                                                v-model="form.city_id"
                                                                description="Выберете город"
                                                                empty-selected="Выберете город"
                                                            ></select-app>
                                                            <span class="validation" v-for="error in errors.city_id">{{ error }}</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <label class="form__label" :class="{invalid:!!errors.city_id.length}">
                                                            <span>Тип аккаунт</span>
                                                            <select-app
                                                                :options="usersTypes"
                                                                select-value="id"
                                                                select-name="name"
                                                                v-model="form.user_type"
                                                                description="Выберете тип"
                                                                empty-selected="Выберете тип"
                                                            ></select-app>
                                                            <span class="validation" v-for="error in errors.user_type">{{ error }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <label class="form__label">
                                                            <span>Расскажите о себе</span>
                                                            <textarea-app
                                                                limit="1000"
                                                                v-model="form.about_me"
                                                                placeholder="Начните писать"
                                                            ></textarea-app>
                                                        </label>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Line -->
                                    <div class="pe-block">
                                        <div class="pe-block__title">
                                            <span>Контакты</span>
                                        </div>
                                        <div class="pe-block__form form">
                                            <form action="">
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <label class="form__label">
                                                            <span>Телефон</span>
                                                            <div class="form__icon-input-wrapper">
                                                                <div class="phone-svg input-svg"></div>
                                                                <div class="delimiter"></div>
                                                                <input type="text" v-model="form.phone" v-mask="['+7 (###) ###-##-##']" class="form__icon-input" placeholder="+7 (965) 632-34-12">
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <label class="form__label">
                                                            <span>Ваш сайт</span>
                                                            <div class="form__icon-input-wrapper">
                                                                <div class="exploier-svg input-svg"></div>
                                                                <div class="delimiter"></div>
                                                                <input type="text" v-model="form.site" class="form__icon-input" placeholder="portfolio_my.ru">
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <label class="form__label">
                                                            <span>Email</span>
                                                            <div class="form__icon-input-wrapper">
                                                                <div class="at-svg input-svg"></div>
                                                                <div class="delimiter"></div>
                                                                <input type="text" v-model="form.email" class="form__icon-input" placeholder="event-outlet@gmail.com">
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <label class="form__label">
                                                            <span>Instagram</span>
                                                            <div class="form__icon-input-wrapper">
                                                                <div class="inst-svg input-svg"></div>
                                                                <div class="delimiter"></div>
                                                                <input type="text" v-model="form.instagram" class="form__icon-input" placeholder="@my_acaunt">
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <label class="form__label">
                                                            <span>Вконтакте</span>
                                                            <div class="form__icon-input-wrapper">
                                                                <div class="vk-svg input-svg"></div>
                                                                <div class="delimiter"></div>
                                                                <input type="text" v-model="form.vk" class="form__icon-input" placeholder="vk.com/my_account">
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <label class="form__label">
                                                            <span>WhatsApp</span>

                                                            <div class="form__icon-input-wrapper">
                                                                <div class="wa-svg input-svg"></div>
                                                                <div class="delimiter"></div>
                                                                <input type="text" class="form__icon-input" v-model="form.whatsapp" v-mask="['+7 (###) ###-##-##']" placeholder="+7 (965) 632-34-12">
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Line -->
                                    <!-- Line -->
                                    <div class="pe-block">
                                        <div class="pe-block__title">
                                            <span>Портфолио</span>
                                        </div>
                                        <div class="pe-block__form">
                                            <div class="pe-portfolio">
                                                <div class="pe-portfolio__wrapper">
                                                    <div class="row">
                                                        <!-- Add/Edit Main avatar -->
                                                        <div class="col-xl-4">
                                                            <div class="pe-portfolio__item">
                                                                <div class="pe-portfolio__item-title">
                                                                    <span>Аватар</span>
                                                                </div>
                                                                <div class="pe-portfolio__block">
                                                                    <avatar-loader :prev-image="avatar"></avatar-loader>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Add/Edit portfolio photos -->
                                                        <div class="col-xl-4">
                                                            <div class="pe-portfolio__item">
                                                                <div class="pe-portfolio__item-title">
                                                                    <span>Добавить фото </span>
                                                                </div>
                                                                <gallery
                                                                    v-if="gallery"
                                                                    :images="gallery"
                                                                    id="profile-gallery"
                                                                    @error="triggerAlert"
                                                                    :limit="20"
                                                                ></gallery>
                                                            </div>
                                                        </div>
                                                        <!-- Add/Edit portfolio video -->
                                                        <div class="col-xl-4">
                                                            <div class="pe-portfolio__item">
                                                                <div class="pe-portfolio__item-title">
                                                                    <span>Добавить видео</span>
                                                                </div>
                                                                <video-loader
                                                                    :limit="5"
                                                                ></video-loader>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Line -->
                                    <div class="pe-block pe-list">
                                        <services-list-app
                                            :services="services"
                                            v-if="services.length"
                                            :price-options="priceOptions"
                                            :additional-fields="additionalFields"
                                            @update-service="triggerAlert"
                                            @delete-service="deleteService"
                                            @create-service="createService"
                                        ></services-list-app>
                                    </div>
                                    <div id="add-service"></div>
                                    <create-service-app

                                        v-if="renderServiceApp && services.length <= 6"
                                        :price-options="priceOptions"
                                        :additional-fields="additionalFields"
                                        @create-service="createService"
                                    ></create-service-app>
                                    <div class="pe-block__save-button">
                                        <button type="submit" class="rectangle-btn rectangle-btn-green">
                                            <span>Сохранить анкету</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <alert :messages="alertMessages" v-if="isActiveAlert"></alert>
    </div>
</template>

<script>
    import axios from '../modules/axios'
    import CreateServiceApp from "../components/CreateServiceApp";
    import ServicesListApp from "../components/ServicesListApp";
    import Gallery from "../components/Gallery";
    import ImageLoader from "../components/ImageLoader";
    import VideoLoader from "../components/VideoLoader";
    import TextareaApp from "../components/TextareaApp";
    import SelectApp from "../components/SelectApp";
    import AvatarLoader from "../components/AvatarLoader";
    import Alert from "../components/Alert";
    import {mask} from 'vue-the-mask'
    import UserCard from "../components/Profile/UserCard";

    export default {
        name: 'Profile',
        props:['userId'],
        data() {
            return {
                user:{},
                services:[],
                //
                isActiveAlert:false,
                userCardRender:false,
                alertMessages:[],
                renderServiceApp:false,
                specialities:[],
                priceOptions:[],

                speciality:{},
                avatar:null,
                email:null,
                gallery:null,
                videos:null,
                additionalFields:[],
                cities:[],
                usersTypes:[],
                form: {
                    name:null,
                    email:null,
                    about_me: null,
                    phone: null,
                    site: null,
                    instagram: null,
                    vk: null,
                    speciality_id:0,
                    whatsapp:null,
                    city_id:0,
                    user_type:0
                },
                errors:{
                    name:[],
                    speciality_id:[],
                    city_id:[],
                    user_type:[]
                }
            }
        },
        methods: {
            send() {
                axios.put(`/app/profiles/${this.userId}`, this.form)
                    .then(({data}) => {
                        if (data.success) {
                            this.errors.name = [];
                            this.errors.speciality_id = [];
                            this.errors.city_id = [];

                            location.href = '/lk/profile'

                        }
                    }).catch(({ response }) => {
                        if (response.status === 422) {
                            let errors = response.data.errors;
                            this.triggerAlert([{
                                type:'error',
                                body:'В форме содержится ошибка!'
                            }]);
                            this.errors.name = errors.name || [];
                            this.errors.speciality_id = errors.speciality_id || [];
                            this.errors.city_id = errors.city_id || [];
                            this.errors.user_type = errors.user_type || [];
                        }
                    })
            },
            triggerAlert(messages) {
                this.isActiveAlert = true;
                this.alertMessages = messages;
                setTimeout(() => this.isActiveAlert = false, 7000);

            },
            createService(service) {
                this.triggerAlert([{
                    type:'success',
                    body:'Услуга успешно добавлена'
                }]);
                 this.services.push(service);
            },
            deleteService({id, index}) {
                this.services.splice(index, 1);
                axios.delete('/app/services/' + id)
                    .then(res => res.data)
                    .then(({data}) => {

                    })
            },
        },
        computed: {

        },
        mounted() {
            let form = this.form;

            axios.get('/app/users')
                .then(({data}) => {
                    this.user = data.user;
                    this.userCardRender = true;
                });
            axios.get('/app/services')
                .then(({data}) => {
                    this.services = data.services;
                });

            axios.get('/app/media/gallery')
                .then(({data}) => {
                    this.gallery = data.gallery;
                });

            axios.get(`/app/profiles/${this.userId}/edit`)
                .then(res => res.data.data)
                .then(data =>  {
                    this.specialities  = data.specialties;
                    this.priceOptions = data.price_options;
                    this.avatar = data.avatar;
                    this.cities = data.cities;
                    this.usersTypes = data.user_types;
                    return data.user
                })
                .then(user => {
                    form.name = user.name;
                    this.additionalFields = user.speciality.fields;
                    this.speciality = user.speciality|| {};

                    return user.info;
                })
                .then(info => {
                    form.about_me = info.about_me;
                    form.specialty = info.specialty;
                    form.phone = info.phone;
                    form.site = info.site;
                    form.instagram = info.instagram;
                    form.vk = info.vk;
                    form.email = info.email;
                    form.speciality_id = info.speciality_id;
                    form.whatsapp = info.whatsapp;
                    form.city_id = info.city_id;
                    form.user_type = info.user_type;
                    this.renderServiceApp = true;
                })
        },
        directives: {mask},
        components: {
            UserCard,
            AvatarLoader,
            SelectApp,
            TextareaApp,
            VideoLoader,
            ImageLoader,
            CreateServiceApp,
            ServicesListApp,
            Gallery,
            Alert
        }
    }
</script>
