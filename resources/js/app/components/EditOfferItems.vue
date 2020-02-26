<template>
<div>
    <div class="profile-special__title"><span>Ваши спецпредложения</span></div>
    <div class="profile-edit__body" v-for="(offer, index) in offers">
    <div class="pe-block pr-block">
        <div class="special-offer">
            <div class="special-offer__head">
                <div class="special-offer__icon">
                    <div class="catalog-card__discount-icon"><div class="percent-svg"></div></div>
                </div>
                <div class="special-offer__item "><span>Дата</span> <span>{{ offer.dates }}</span></div>
                <div class="special-offer__item"><span>Услуга</span> <span>{{ offer.serviceName }}</span></div>
                <div class="special-offer__item">
                    <span>Цена со скидкой</span> <span>{{ offer.price }} {{ offer.priceOption }}</span>
                </div>
                <div class="special-offer__item">
                    <span>Скидка</span> <span>{{ offer.discount }}%</span>
                </div>
                <div class="special-offer__button">
                    <a href="#" @click="deleteOffer(offer.id, index, $event)">Удалить</a>
                </div>
            </div>
            <div class="special-offer__desctipton">
                <div class="special-offer__desctipton-title">
                    <span>Описание</span
                ></div>
                <div class="special-offer__desctipton-body">
                    <p>
                       {{ offer.description }}
                    </p>
                </div>
            </div>
            <div class="special-offer__footer">
                <div class="additional_filters__checkbox">
                    <label class="filter-checkbox"
                    >Опубликовать спецпредложение
                    <input type="checkbox" v-model="published" :value="offer.id" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
        </div>

    </div>
</div>
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
            <a href="#" @click="sendPublished($event)" class="rectangle-btn rectangle-btn-green">
                <span>Опубликовать</span>
            </a>
        </div>
    </div>
</div>
</template>

<script>
    import axios from "../modules/axios";

    export default {
        data() {
            return {
                offers:[],
                published:[]
            }
        },
        methods: {

            deleteOffer(id, index, e) {
                e.preventDefault();
                axios.delete('/app/offers/'+id)
                    .then((data) => {
                        this.offers.splice(index, 1);
                    })
            },
            sendPublished(e) {
                e.preventDefault();
                axios.post('/app/offers/published', {published:this.published})
                    .then(({data})=> {
                        this.$emit('success-update');
                        console.log(data);
                    });
            }
        },
        mounted() {
            axios.get('/app/offers')
                .then(({data}) => {
                    let offers = data.data.offers;
                    this.offers = offers;
                    this.published = offers.map((offer)=> {
                        if (offer.status == 1) {
                            return offer.id;
                        }
                    })
                })
        }
    }
</script>
