<template>
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12">
                <h1>Редактирование анкеты</h1>
            </div>
        </div>
        <form @submit.prevent="send" class="mt-5">
            <div class="row form-group">
                <div class="col-lg-6">
                    <label>Специальность</label>
                    <select class="form-control" v-model="form.speciality_id">
                        <option :selected="form.speciality_id == item.id" v-for="item in specialities" :value="item.id" :key="'spcl-' + item.id">{{ item.name }}</option>
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
                <div class="col-lg-6">
                    <label>Телефон</label>
                    <input type="text" class="form-control" v-model="form.phone">
                </div>
                <div class="col-lg-6">
                    <label>Сайт</label>
                    <input type="text" class="form-control" v-model="form.site">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-6">
                    <label>Email</label>
                    <input type="text" class="form-control" v-model="form.email">
                </div>
                <div class="col-lg-6">
                    <label>Instagram</label>
                    <input type="text" class="form-control" v-model="form.instagram">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-6">
                    <label>Vk</label>
                    <input type="text" class="form-control" v-model="form.vk">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-3">
                    <label>Аватар</label><br>
                    <image-loader
                    :prev-image="avatar"
                    ></image-loader>
                </div>
                <div class="col-lg-3">
                    <gallery
                        v-if="gallery"
                        :images="gallery"
                    ></gallery>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary mb-2">Save</button>
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
    import Gallery from "../components/Gallery";
    import ImageLoader from "../components/ImageLoader";

    export default {
        name: 'Profile',
        props:['userId'],
        data() {
            return {
                specialities:[],
                priceOptions:[],
                services:[],
                avatar:null,
                email:null,
                gallery:null,
                form: {
                    name:null,
                    email:null,
                    about_me: null,
                    phone: null,
                    site: null,
                    instagram: null,
                    vk: null,
                    speciality_id:0
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
                    this.specialities  = data.specialties;
                    this.priceOptions = data.price_options;
                    this.avatar = data.avatar;
                    this.gallery = data.gallery;
                    return data.user
                })
                .then(user => {
                    this.services = user.services;
                    form.name = user.name;
                    return user.info;
                })
                .then(info => {
                    form.about_me = info.about_me;
                    form.specialty = info.specialty;
                    form.phone = info.phone;
                    form.site = info.site;
                    form.instagram = info.instagram;
                    form.vk = info.vk;
                    form.email = info.email;
                })
                .catch(e => console.log(e))
        },
        components: {
            ImageLoader,
            CreateServiceApp,
            ServicesListApp,
            Gallery
        }
    }
</script>
