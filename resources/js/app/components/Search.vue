<template>
    <form action="/offers">
        <div class="row">
            <div class="col-lg-2">
                <select class="form-control" name="speciality_id" v-model="specialitySelect">
                    <option value="" v-for="speciality in specialties" :value="speciality.id">{{ speciality.name }}</option>
                </select>
            </div>
            <div class="col-lg-2">
                <input type="hidden" :value="dateFrom" name="specials_offers[date_from]">
                <input type="hidden" :value="dateTo" name="specials_offers[date_to]">
                <date-picker
                    v-model="range"
                    mode="range"
                    :masks="{model: 'YYYY-MM-DD'}"
                    :popover="{ placement: 'bottom', visibility: 'click' }">
                    <button type="button" class="btn btn-outline-secondary">select date</button>
                </date-picker>
            </div>
            <div class="col-lg-2">
                <button class="btn btn-danger">find</button>
            </div>
        </div>
    </form>
</template>

<script>
    import axios from '../modules/axios'
    import moment from 'moment'

    export default {
        name: 'Search',
        data() {
            return {
                resp:null,
                range: {
                    start: null,
                    end: null
                },
                specialitySelect:0,
                specialties: []
            }
        },
        computed: {
            dateFrom() {
                return moment(this.range.start).format('YYYY-MM-DD')
            },
            dateTo() {
                return moment(this.range.end).format('YYYY-MM-DD');
            }
        },
        mounted() {
            axios.get('/app/specialties')
                .then(res => res.data.data)
                .then(data => {
                    this.specialties = data;
                })
        },
        components: {
            DatePicker: () => import('v-calendar/lib/components/date-picker.umd')
        }
    }
</script>
