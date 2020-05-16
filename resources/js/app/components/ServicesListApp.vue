<template>
    <div>
        <div class="pe-block__title" v-if="!!servicesMap.lenght"> 
            <span>Стоимость и наименование ваших услуг</span>
        </div>
        <div class="pe-block__services-list-wrapper">
            <div class="services-list"
                    v-for="(service, index) in servicesMap"
                    :class="{show:service.isEditing}"
                    :key="'user-service-' + service.id"
                >
                <div class="services-list__head">
                    <div class="services-list__title">
                        <span class="services-list__ltitle">
                            {{ service.name }}
                        </span>
                    </div>
                    <div class="services-list__moder-info">
                        <span v-if="service.status == 0">На модерации</span>
                        <span v-if="service.status == 1" style="color: #91b15f">Активен</span>
                    </div>
                    <div class="services-list__info">
                        <div class="services-list__info-left">
                            <span class="services-list__ltitle">
                                Цена
                            </span>
                            <div class="services-list__price">
                                <span>{{ service.price }}</span>
                                <span></span>
                                <span> {{ service.price_option.name }} </span>
                            </div>
                        </div>
                        <div class="services-list__change-btn">
                            <a href="#" @click.prevent="editing(index)">
                                {{ service.isEditing?'Закрыть':'Изменить' }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="services-list__description">
                    <span class="services-list__ltitle">
                        Описание
                    </span>
                    <p>{{ service.description }}</p>
                </div>
                <div class="pe-block__form form">
                    <div>
                        <div class="row">
                            <div class="col-xl-6">
                                <label class="form__label" :class="{invalid:!!(service.name_errors.length)}"
                                ><span>Услуга</span>
                                    <input type="text" maxlength="40" v-model="service.name" placeholder="Введите название услуги" class="form__input">
                                    <span class="validation" v-for="error in service.name_errors">{{ error }}</span>
                                </label>
                               
                            </div>
                            <div class="col-xl-6">
                                <label class="form__label" :class="{invalid:!!(service.price_errors.length)}">
                                    <span>Стоимость</span>
                                    <div class="form__icon-input-wrapper">
                                        <div class="rub-svg input-svg"></div>
                                        <div class="delimiter"></div>
                                        <input type="text" v-model="service.price" placeholder="3 000" class="form__icon-input">
                                    </div>
                                    <span class="validation" v-for="error in service.price_errors">{{ error }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6" v-for="field in service.fields">
                                <label class="form__label" :class="{invalid:!!(service.additional_errors[field.meta_field.id])}">
                                    <span>{{ field.meta_field.name }}</span>
                                    <input type="text"
                                           class="form__input"
                                           :data-field-id="field.meta_field.id"
                                           v-model="field.value"
                                           placeholder="Введите значение">
                                    <span class="validation" v-for="error in service.additional_errors[field.meta_field.id]">{{ error }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-9">
                                <label class="form__label"><span>Условия работы</span>
                                    <div class="form__textarea-wrapp">
                                        <textarea-app
                                            placeholder="Начните писать"
                                            limit="1000"
                                            v-model="service.description"
                                        ></textarea-app>
                                    </div>
                                </label>
                            </div>
                            <div class="col-xl-3">
                                <div class="save-list">
                                    <span>&nbsp;</span>
                                    <select-app
                                        :options="priceOptions"
                                        select-value="id"
                                        select-name="name"
                                        v-model="service.price_option_id"
                                        @input="changePriceOption(index)"
                                        description="Кол-во"
                                        empty-selected="Кол-во"
                                    ></select-app>
                                    <button class="rectangle-btn rectangle-btn-green rectangle-btn_save-service" @click.prevent.stop="updateService(index)">
                                        <span>Сохранить</span>
                                    </button>
                                    <button class="rectangle-btn rectangle-btn-green rectangle-btn_delete-service" @click="deleteService(index, service.id)">
                                        <span>Удалить</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import TextareaApp from "./TextareaApp";
    import SelectApp from "./SelectApp";
    import { find } from 'lodash';
    import axios from "../modules/axios";
    export default {
        props:['services','priceOptions', 'additionalFields'],
        name: "ServicesListApp",
        components: {TextareaApp, SelectApp},
        data() {
            return {
                servicesMap:[],
                test:'',
                errors: {
                    additional_fields:{}
                }
            }
        },
        methods: {
            editing(index) {
                this.servicesMap[index].isEditing = !this.servicesMap[index].isEditing;
            },
            changePriceOption(index) {
                let id = this.servicesMap[index].price_option_id;

                this.servicesMap[index].price_option = find(this.priceOptions, {id});
            },
            updateService(index) {
                let service = this.servicesMap[index];

                let payload = {
                    name: service.name,
                    description:service.description,
                    price:service.price,
                    price_option_id: service.price_option_id,
                    additional_fields: this.prepareSendAdditionalFields(service.fields)
                };
                let serviceObj = this.servicesMap[index];
                axios.put('/app/services/' + service.id, payload)
                    .then(res => res.data)
                    .then(data => {
                        if (data.success) {
                            this.servicesMap[index].additional_errors = [];
                            this.servicesMap[index].status = 0;

                            serviceObj.price_errors = [];
                            serviceObj.name_errors = [];

                            this.$emit('update-service', [{
                                body:'Предложение успешно обновлено',
                                type:'success'
                            }]);

                        }
                    })
                    .catch(({ response }) => {
                        if (response.status === 422) {
                            let serviceObj = this.servicesMap[index];
                            let errors = response.data.errors;

                            if (errors.additional_fields) {
                                serviceObj.additional_errors =  errors.additional_fields[0];
                            }

                            serviceObj.price_errors = errors.price || [];
                            serviceObj.name_errors = errors.name || [];
                            console.log(errors)
                        }
                    });
                console.log(this.servicesMap[index]);
            },
            deleteService(index, id) {
                this.servicesMap[index].isEditing = false;
                this.$emit('delete-service', {index, id});
            },
            getAdditionFieldErrors(serviceId, fieldId) {

                let serviceError = this.errors.additional_fields['_' + serviceId];
                console.log(serviceError);
                if (serviceError) {
                    let fieldErrors = serviceError[fieldId];

                    return (fieldErrors)?fieldErrors:[];
                }
                return [];
            },
            prepareSendAdditionalFields(fields) {
                return fields.map(field => {
                    return {
                        id:field.meta_field.id,
                        value: field.value,
                        fId:field.id
                    }
                })
            },
            createServicesMap(services) {
                return services.map((item) => {
                    this.$set(item, 'isEditing', false);
                    this.$set(item, 'additional_errors', {});
                    this.$set(item, 'name_errors', [])
                    this.$set(item, 'price_errors', [])
                    return item;
                });
            }
        },
        watch: {
            services(services) {
                this.servicesMap = this.createServicesMap(services);
            }
        },
        mounted() {
            this.servicesMap = this.createServicesMap(this.services);
        },

    }
</script>

<style scoped>
    .list-item {
        display: inline-block;
        margin-right: 10px;
    }
    .list-leave-active {
        transition: margin-top .7s;
    }
    .list-enter, .list-leave-to {
        opacity: 0;
        margin-top: -100%;
    }
</style>
