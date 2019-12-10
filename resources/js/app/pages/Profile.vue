<template>
    <div class="container">
        <div class="col-lg-3"></div>
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Зравствуйте, {{ user.name }}</h1>
                </div>
            </div>
            <div class="row">

            </div>
            <div class="row">
                <div class="col-lg-4">
                    <a :href="editProfileLink" class="btn btn-outline-success">Редактировать</a>
                </div>
                <div class="col-lg-8">
                    <a :href="createOfferLink" class="btn btn-outline-danger">Добавить спецпредложение</a>

                    <ul>
                        <li v-for="offer in offers"></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from "../modules/axios";

    export default {
        props:['createOfferLink', 'editProfileLink', 'userId'],
        name:'Profile',
        data() {
            return {
                user: {},
                offers:[]
            }
        },
        computed: {

        },
        mounted() {
            let self = this;
            axios.get('/app/profiles/' + this.userId)
               .then(res => res.data.data)
               .then(data => {

                   self.user = data.user
               })
                .catch( e => {
                    console.log(e);
                })
        }
    }
</script>
