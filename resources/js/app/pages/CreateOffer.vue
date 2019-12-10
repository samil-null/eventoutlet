<template>
    <div class="container">
        <form action="" @submit.prevent="createOffer">
            <div class="row form-group">
                <div class="col-lg-6">
                    <label>Услуга</label>
                    <select class="form-control" v-model="service">
                        <option :value="0">Нет</option>
                        <option v-for="item in services" :value="item.id" :key="'spcl-' + item.id">{{ item.name }}</option>
                    </select>
                </div>
                <div class="col-lg-6">
                    <label>Скидка</label>
                    <input type="text" class="form-control" v-model="discount">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-6">
                    <date-picker
                        v-model="dates"
                        mode="multiple"
                        is-inline
                    />
                </div>
                <div class="col-lg-6">
                    <label>Условия</label>
                    <textarea class="form-control"  rows="5" v-model="description"></textarea>
                </div>

            </div>
            <div class="row form-group">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary mb-2">Добавить</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import axios from '../modules/axios'
    import DatePicker from 'v-calendar/lib/components/date-picker.umd'

    export default {
        name: "CreateOffer",
        data() {
            return {
                services:[],
                offers:[],
                discount:0,
                service:0,
                description:null,
                dates:null
            }
        },
        methods: {
            createOffer() {
                let payload = {
                    service: this.service,
                    dates: this.dates,
                    discount: this.discount,
                    description: this.description,
                }

                axios.post('/app/offers', payload)
            }
        },
        mounted() {
            axios.get('/app/offers/create')
                .then(res => res.data.data)
                .then(data => {
                    console.log(data);
                    this.services = data.services;
                })
        },
        components: {
            DatePicker
        }
    }
</script>

<style scoped>

</style>
