<template>
    <div class="profile-core__sidebar">
        <div class="sidebar__item">
            <div class="sidebar__title">
                <span>Предложения по датам</span>
            </div>
            <div class="sidebar__core">
                <div class="sidebar__calendar">
                    <user-calendar :dates="dates" @select-date="selectDate"/>
                </div>

            </div>
        </div>
        <div class="sidebar__title" v-if="isDisplayTitle">
            <span>Спецпредложения</span>
        </div>
        <div class="sidebar__item" :key="'offer-item-' + offer.id" v-for="offer in offersList" v-if="offer.hasDisplay">
            <div class="sidebar__core">
                <div class="sidebar__head">
                    <div class="catalog-card__discount-icon">
                        <div class="percent-svg"></div>
                    </div>
                    <div class="sidebar__head_item">
                        <span>Дата</span>
                        <span class="sidebar-price">{{ offer.dates }}</span>
                    </div>
                    <div class="sidebar__head_item">
                        <span>Услуга</span>
                        <span class="service-name">{{ offer.serviceName }}</span>
                    </div>
                    <!-- <div class="sidebar__slash"></div> -->
                </div>
                <div class="sidebar__head">
                    <div class="sidebar__head_item">
                        <span>Скидка</span>
                        <span class="sidebar-price">{{ offer.discount }}%</span>
                    </div>
                    <div class="sidebar__head_item">
                        <span>Цена со скидкой</span>
                        <span class="service-name">{{ offer.price }} {{ offer.priceOption }}</span>
                    </div>
                    <!-- <div class="sidebar__slash"></div> -->
                </div>
                <div class="sidebar__description">
                    <span>Описание</span>
                    <p>
                        {{ offer.description }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>



<script>
import UserCalendar from '../Datepickers/UserCalendar'
export default {
    props:['offers', 'dates'],
    data() {
        return {
            offersList:[],
            isDisplayTitle:false
        }
    },
    components: {
        UserCalendar
    },
    methods: {
        selectDate(date) {
            this.isDisplayTitle = false;
            this.offersList.forEach(item => {
                if (item.datesList.indexOf(date) !== -1) {
                    if (!this.isDisplayTitle) {
                        this.isDisplayTitle = true;
                    }
                    item.hasDisplay = true;
                } else {
                    item.hasDisplay = false;
                }
            });
        }
    },
    mounted() {
        this.offersList = this.offers.map(item => {
            item.hasDisplay = false;
            return item;
        });
    }
}
</script>