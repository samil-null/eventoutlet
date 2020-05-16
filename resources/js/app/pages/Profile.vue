<template>
    <section class="profile-edit">
        <div class="container">
            <div class="profile-edit__content">
                <div class="row no-gutters">
                    <div class="col-md-12 col-lg-3 col-xl-3">
                        <user-card
                            v-if="user.id"
                            :avatar="user.avatar.original"
                            :name="user.name"
                            :status="user.status_name"
                            :speciality="user.info.speciality"
                            :editable="true"
                        />
                    </div>
                    <div class="col-md-12 col-lg-8 col-xl-8 offset-lg-1 offset-xl-1">
                        <div class="profile-edit__wrapper">
                            <div class="profile-edit__title lk__title">
                                <span>Здравствуйте, {{ user.name }}</span>
                            </div>
                            <!-- have no offers -->
                            <div  class="lk__havent-offers">
                                <div class="lk__havent-offers-title" v-if="!offers.length" >
                                    <span>
                                        У вас еще нет опубликованных спецпредложений, вам нужно срочно их опубликовать
                                    </span>
                                </div>

                                <div class="pe-block__add-btn">
                                    <a :href="createOfferLink" v-if="serviceCount" class="add-btn add-btn-corall">
                                        <span>Добавить спецпредложение</span>
                                    </a>
                                    <a href="/lk/profile/edit/#add-service" v-else class="add-btn add-btn-corall">
                                        <span>Добавить услугу</span>
                                    </a>
                                </div>
                            </div>
                            <template v-if="offers.length">
                                <div class="profile-edit__body lk__body" v-for="offer in offers">
                                    <!-- Line -->
                                    <div class="pe-block pr-block">
                                        <div class="special-offer">
                                            <div class="special-offer__head">
                                                <div class="special-offer__icon">
                                                    <div class="catalog-card__discount-icon"><div class="percent-svg"></div></div>
                                                </div>
                                                <div class="special-offer__item "><span>Дата</span> <span>{{ offer.dates }}</span></div>
                                                <div class="special-offer__item"><span>Услуга</span> <span>{{ offer.service_name }} </span></div>
                                                <div class="special-offer__item">
                                                    <span>Цена со скидкой</span> <span>{{ offer.price }} {{ offer.price_option }}</span>
                                                </div>
                                                <div class="special-offer__item"><span>Скидка</span> <span>{{ offer.discount }}%</span></div>
                                                <div class="special-offer__button"><a :href="offer.url">Изменить</a></div>
                                            </div>
                                            <div class="special-offer__desctipton">
                                                <div class="special-offer__desctipton-title"><span>Описание</span></div>
                                                <div class="special-offer__desctipton-body">
                                                    <p>
                                                        {{ offer.description }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
    import axios from "../modules/axios";
    import UserCard from "../components/Profile/UserCard";

    export default {
        components: {UserCard},
        props:['createOfferLink', 'editProfileLink', 'userId'],
        name:'Profile',
        data() {
            return {
                user: {},
                offers:[],
                serviceCount:0
            }
        },
        computed: {

        },
        mounted() {
            axios.get('/app/users')
                .then(({data}) => {
                    this.user = data.user;
                });

            axios.get('/app/offers?active=1')
                .then(({data}) => {
                    this.offers = data.offers;
                })

            axios.get('/app/services/count')
                .then(({data}) => {
                    this.serviceCount = data.count;
                })
        }
    }
</script>
