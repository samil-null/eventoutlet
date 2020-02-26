<template>
    <div>
        <div v-if="false" class="container">
            <div class="col-lg-3"></div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Зравствуйте, {{ user.name }}</h1>
                    </div>
                </div>
                <div class="row">

                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <a :href="editProfileLink" class="btn btn-outline-success">Редактировать</a>
                    </div>
                    <div class="col-lg-8">
                        <a :href="createOfferLink" class="btn btn-outline-danger">Добавить спецпредложение</a>

                        <ul class="mt-5">
                            <li v-for="offer in user.offers" :key="'offer-'+offer.id">
                                {{ offer.service.name }} |
                                {{ offer.service.price }} |
                                {{ offer.discount }} %
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <section class="profile-edit">
            <div class="container">
                <div class="profile-edit__content">
                    <div class="row no-gutters">
                        <div class="col-md-12 col-lg-3 col-xl-3">
                            <div class="profile-edit__card-wrapper">
                                <div class="profile-edit__card profile-special">
                                    <div class="profile-edit__card-photo" :style="{'background-image': `url(${avatar})`}"></div>
                                    <div class="profile-edit__name"><span>{{ user.name }}</span></div>
                                    <div class="profile-edit__prof"><span>Фотограф</span></div>
                                    <div class="pe-block__add-btn">
                                        <a :href="editProfileLink" class="add-btn"> <span>Редактировать профиль</span> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-8 col-xl-8 offset-lg-1 offset-xl-1">
                            <div class="profile-edit__wrapper">
                                <div class="profile-edit__title lk__title">
                                    <span>Здравствуйте, {{ user.name }}</span>
                                </div>
                                <div class="profile-edit__body lk__body" v-for="offer in offers">
                                    <!-- Line -->
                                    <div class="pe-block pr-block">
                                        <div class="special-offer">
                                            <div class="special-offer__head">
                                                <div class="special-offer__icon">
                                                    <div class="catalog-card__discount-icon"><div class="percent-svg"></div></div>
                                                </div>
                                                <div class="special-offer__item "><span>Дата</span> <span>{{ offer.dates }}</span></div>
                                                <div class="special-offer__item"><span>Услуга</span> <span>{{ offer.serviceName }} </span></div>
                                                <div class="special-offer__item">
                                                    <span>Цена со скидкой</span> <span>{{ offer.price }} {{ offer.priceOption }}</span>
                                                </div>
                                                <div class="special-offer__item"><span>Скидка</span> <span>{{ offer.discount }}%</span></div>
                                                <div class="special-offer__button"><a :href="offer.editUrl">Изменить</a></div>
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
                            </div>
                            <!-- have no offers -->
                            <div class="lk__havent-offers">
                                <div class="lk__havent-offers-title">
                                <span>
                                  У вас еще нет опубликованных спецпредложений, вам нужно срочно их опубликовать
                                </span>
                                </div>

                                <div class="pe-block__add-btn">
                                    <a :href="createOfferLink" class="add-btn add-btn-corall"> <span>Добавить спецпредложение</span> </a>
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
    import axios from "../modules/axios";

    export default {
        props:['createOfferLink', 'editProfileLink', 'userId'],
        name:'Profile',
        data() {
            return {
                user: {},
                avatar:{},
                offers:[``]
            }
        },
        computed: {

        },
        mounted() {
            axios.get('/app/profiles/' + this.userId)
               .then(res => res.data.data)
               .then(data => {
                   this.user = data.user;
                   this.avatar = data.avatar;
               })
                .catch( e => {
                    console.log(e);
                });

            axios.get('/app/offers')
                .then(({data}) => {
                    this.offers = data.data.offers;
                })
        }
    }
</script>
