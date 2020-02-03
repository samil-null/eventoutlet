<template>
    <v-date-picker
        class="calendar"
        mode='range'
        title-position="left"
        v-model='date'
        :available-dates='{ start: minDate, end: maxDate }'
        :is-inline="false"
        @input="changed = true"
        @popoverWillHide="apply()"
        :popover="{ placement: 'bottom', visibility: 'click' }">
        <div class="catalog-select__intro">
            <div class="catalog-select__title">
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
    </v-date-picker>
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
                }
            }
        },
        methods: {
            apply() {
                document.querySelector(this.form).submit()
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
        created() {
            console.log( new Date(this.minDate), new Date(this.maxDate))
            this.date.start = new Date(this.dateFrom);
            this.date.end = new Date(this.dateTo);
        }
    }
</script>

