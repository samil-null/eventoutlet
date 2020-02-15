<template>
<div>
    <div class="profile-edit__body" v-for="offer in offers">
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
                <div class="special-offer__item"><span>Скидка</span> <span>{{ offer.discount }}%</span></div>
                <div class="special-offer__button">
                    <a href="#">Удалить</a>
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
                    <input type="checkbox" :checked="(offer.status == 1)" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</template>

<script>
    import axios from "../modules/axios";

    export default {
        data() {
            return {
                offers:[]
            }
        },
        mounted() {
            axios.get('/app/offers')
                .then(({data}) => {
                    this.offers = data.data.offers;
                })
        }
    }
</script>