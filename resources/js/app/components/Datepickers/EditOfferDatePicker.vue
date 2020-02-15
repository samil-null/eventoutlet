<template>
    <div class="profile-special__calendar-wrapper">
        <v-datepicker
            v-if="showPicker"
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
    export default {
        props:['rawDates', 'minDate', 'maxDate'],
        name: "EditOfferDatePicker",
        data() {
            return {
                //dates:[]
                dates: [],
                showPicker:false
            }
        },
        watch: {
            dates(value) {
                console.log(uniq(value));
                return uniq(value);
            }
        },
        methods:{

        },
        mounted() {
             this.rawDates.forEach((item) => {
                 this.dates.push(new Date(item.date));
            });
        },

        components: {
            'v-datepicker': DatePicker
        }
    }
</script>

<style scoped>

</style>
