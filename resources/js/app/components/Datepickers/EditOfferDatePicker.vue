<template>
    <div class="profile-special__calendar-wrapper">
        <v-datepicker
            mode="multiple"
            title-position="left"
            v-model="dates"
            :available-dates='{ start: minDate, end: maxDate }'
            is-inline
        >
        </v-datepicker>
    </div>
</template>

<script>
    import DatePicker from 'v-calendar/lib/components/date-picker.umd'
    import { uniq } from "lodash";
    import dayjs from 'dayjs';

    export default {
        props:['rawDates', 'minDate', 'maxDate'],
        name: "EditOfferDatePicker",
        data() {
            return {
                dates: [],
            }
        },
        methods:{

        },
        watch: {
            dates(value) {
                this.$emit('input', value);

                return value;
            }
        },
        created() {
            this.dates = this.rawDates.map((item) => {
                let date = dayjs(item.date);
                return new Date(date.year(), date.month(), date.date());
            });
        },

        components: {
            'v-datepicker': DatePicker
        }
    }
</script>

<style scoped>

</style>
