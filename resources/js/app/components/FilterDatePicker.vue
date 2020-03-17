<template>

<div class="catalog-select" :class="{show}" ref="picker">
    <div class="catalog-select__intro">
        <div class="catalog-select__title" @click="show = true">
            <span>Дата</span>
            <div class="arrow-svg"></div>
        </div>
        <div class="catalog-select__result">
            <input type="hidden" v-if="dateFilterFrom != 'Invalid date'"
                   name="specials_offers[date_from]" :value="dateFilterFrom">
            <input type="hidden"
                   name="specials_offers[date_to]"
                   v-if="dateFilterTo != 'Invalid date'"

                   :value="dateFilterTo">
            <span>{{ dateToText }}</span>
        </div>
    </div>
    <div class="catalog-select__body">
        <div class="catalog-select__body-title">
            <span>Выберете дату</span>
        </div>
        <v-date-picker
            class="calendar"
            mode='range'
            title-position="left"
            v-model='date'
            :available-dates='{ start: minDate, end: maxDate }'
            is-inline
            @input="changed = true"
            @popoverWillHide="apply()"
            :popover="{ placement: 'bottom', visibility: 'click' }">
        </v-date-picker>
        <div class="catalog-select__button">
            <a href="#" @click="apply" class="rectangle-btn-border rectangle-btn-border-green"
            ><span>Применить</span></a
            >
        </div>
    </div>
</div>



</template>

<script>
    import VDatePicker from 'v-calendar/lib/components/date-picker.umd'
    import moment from "moment";

    export default {
        props:['dateFrom', 'dateTo', 'dateToText', 'form', 'minDate','maxDate'],
        name: "FilterDatePicker",
        data() {
            return {
                changed:false,
                date:{
                    start: null,
                    end: null
                },
                show: false
            }
        },
        methods: {
            apply() {
                if (window.innerWidth >= 767) {
                    document.querySelector(this.form).submit()
                } else {
                    this.show = false
                }

            },
            documentClick(e){
                let el = this.$refs.picker;
                let target = e.target;
                if ( (el !== target) && !el.contains(target)) {
                    this.show = false
                }
            },
        },
        computed: {
            dateFilterFrom() {
                return moment(this.date.start).format('YYYY-MM-DD')
            },
            dateFilterTo() {
                //this.apply();
                return moment(this.date.end).format('YYYY-MM-DD');
            }
        },
        components: {
            VDatePicker
        },
        mounted() {
            document.addEventListener('click', this.documentClick)
            this.date.start = new Date(this.dateFrom);
            this.date.end = new Date(this.dateTo);
        },
        destroyed() {
            document.removeEventListener('click', this.documentClick)
        }
    }
</script>

