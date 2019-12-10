<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Profile</h1>
            </div>
        </div>
        <form @submit.prevent="send">
            <div class="row form-group">
                <div class="col-lg-6">
                    <label>Специальность</label>
                    <select class="form-control" v-model="form.specialty">
                        <option :value="0">Нет</option>
                        <option v-for="item in specialties" :value="item.id" :key="'spcl-' + item.id">{{ item.name }}</option>
                    </select>
                </div>
                <div class="col-lg-6">
                    <label>Имя</label>
                    <input type="text" class="form-control" v-model="form.name">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-12">
                    <label>О себе</label>
                    <textarea class="form-control"  rows="5" v-model="form.about_me"></textarea>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary mb-2">Send</button>
                </div>
            </div>
        </form>
        <services-list-app
            :services="services"
        ></services-list-app>
        <create-service-app
            v-if="priceOptions"
            :price-options="priceOptions"
            @create-service="createService"
        ></create-service-app>
    </div>
</template>

<script>
    import axios from '../modules/axios'
    import CreateServiceApp from "../components/CreateServiceApp";
    import ServicesListApp from "../components/ServicesListApp";

    export default {
        name: 'Profile',
        props:['userId'],
        data() {
            return {
                specialties:[],
                priceOptions:[],
                services:[],
                form: {
                    name:null,
                    about_me: null,
                    specialty:0
                },
            }
        },
        methods: {
            send() {
                axios.put(`/app/profiles/${this.userId}`, this.form)
            },

            createService(data) {
                axios.post('/app/services', data)
                    .then(res => res.data)
                    .then(data => {
                        if (data.success) {
                            this.services = data.data;
                        }
                    })
            }
        },
        computed: {

        },
        mounted() {
            let form = this.form;

            axios.get(`/app/profiles/${this.userId}/edit`)
                .then(res => res.data.data)
                .then(data =>  {
                    this.specialties  = data.specialties;
                    this.priceOptions = data.price_options;
                    this.services = data.services
                    return data.user
                })
                .then(user => {
                    console.log(user);
                    form.name = user.name;
                    form.about_me = user.about_me;
                    form.specialty = user.specialty;
                })
                .catch(e => console.log(e))
        },
        components: {
            CreateServiceApp,
            ServicesListApp
        }
    }
</script>
