<template>
    <form @submit.prevent="send">

        <!-- Line -->
        <div class="pe-block">
            <div class="pe-block__title">
                <span>Добавить новую услугу</span>
            </div>
            <div class="pe-block__form form">
                <form action="">
                    <div class="row">
                        <div class="col-xl-6">
                            <label class="form__label" :class="{invalid:!!errors.name.length}">
                                <span>Услуга</span>
                                <input type="text" class="form__input" v-model="name" placeholder="Введите название услуги">
                                <span class="validation" v-for="error in errors.name">{{ error }}</span>
                            </label>
                        </div>
                        <div class="col-xl-6">
                            <label class="form__label" :class="{invalid:!!errors.price.length}">
                                <span>Стоимость</span>
                                <div class="form__icon-input-wrapper">
                                    <div class="rub-svg input-svg"></div>
                                    <div class="delimiter"></div>
                                    <input type="text" class="form__icon-input" v-model="price" placeholder="3 000">
                                </div>
                                <span class="validation" v-for="error in errors.price">{{ error }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6" v-for="field in additional">
                            <label class="form__label" :class="getErrorAdditionField(field.key).length">
                                <span>{{ field.name }}</span>
                                <input type="text" class="form__input" v-model="field.value" placeholder="Введите значение">
                                <span class="validation" v-for="error in getErrorAdditionField(field.key)">{{ error }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-9">
                            <label class="form__label" :class="{invalid:!!errors.price.length}">
                                <span>Расскажите о себе</span>
                                <textarea-app
                                    limit="500"
                                    placeholder="Начните писать"
                                    v-model="description"
                                ></textarea-app>
                                <span class="validation" v-for="error in errors.description">{{ error }}</span>
                            </label>
                        </div>
                        <div class="col-xl-3">
                            <span>&nbsp;</span>
                            <select-app
                                :options="priceOptions"
                                select-value="id"
                                select-name="name"
                                v-model="priceOptionId"
                                description="Кол-во"
                                empty-selected="Кол-во"
                            ></select-app>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Line -->
        <div class="pe-block__add-btn">
            <button type="submit" class="add-btn">
                <div class="plus">
                    <span></span>
                    <span></span>
                </div>
                <span>Добавить услугу</span>
            </button>
        </div>
    </form>

</template>

<script>
    import TextareaApp from "./TextareaApp";
    import SelectApp from "./SelectApp";
    import axios from "../modules/axios";

    export default {
        components: {SelectApp, TextareaApp},
        props:['priceOptions','additionalFields'],
        name: "CreateServiceApp",
        data() {
            return {
                name:null,
                price:null,
                description:null,
                priceOptionId:1,
                additional:[],
                errors:{
                    name:[],
                    price:[],
                    description:[],
                    additional_fields:[]
                }
            }
        },
        methods: {
            send() {
                let payload = {
                    name: this.name,
                    price: this.price,
                    description: this.description,
                    price_option_id: this.priceOptionId,
                    additional_fields: this.prepareFields(this.additional)
                }


                axios.post('/app/services', payload)
                    .then(({data}) => {

                    })
                    .catch(({response}) => {
                        if (response.status === 422) {
                            let errors = response.data.errors;
                            this.errors.name = errors.name || [];
                            this.errors.price = errors.price || [];
                            this.errors.description = errors.description || [];
                        }
                    })

                //this.$emit('create-service', payload);
            },
            prepareFields(fields) {
                let result = {};

                if (fields) {
                    fields.forEach((item) => {
                        result[item.key] = item;
                    })

                    return result;
                }
            },
            getErrorAdditionField(key) {
                let errors = this.errors.additional_fields['additional_fields.' + key + '.value'];

                return errors || [];
            }
        },
        async mounted() {
            this.additional = this.additionalFields.map(item => {
                return {
                    name: item.name,
                    key: item.key,
                    value: null
                }
            });
        }
    }
</script>

<style scoped>

</style>
