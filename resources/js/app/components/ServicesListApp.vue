<template>
    <div>
        <div class="pe-block__services-list-wrapper">
            <div class="services-list"
                    v-for="(service, index) in servicesMap"
                    :class="{show:service.isEditing}"
                    :key="'user-service-' + service.id"
                >
                <div class="services-list__head">
                    <div class="services-list__title">
                        <span class="services-list__ltitle">
                            Услуга
                        </span>
                        <span v-if="false">{{ service.name }}</span>
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
                                <label class="form__label"><span>Услуга</span>
                                    <input type="text" v-model="service.name" placeholder="Введите название услуги" class="form__input">
                                </label>
                            </div>
                            <div class="col-xl-6">
                                <label class="form__label"><span>Стоимость</span>
                                    <div class="form__icon-input-wrapper">
                                        <div class="rub-svg input-svg"></div>
                                        <div class="delimiter"></div>
                                        <input type="text" v-model="service.price" placeholder="3 000" class="form__icon-input">
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6" v-for="field in service.fields">
                                <label class="form__label">
                                    <span>{{ field.meta_field.name }}</span>
                                    <input type="text"
                                           class="form__input"
                                           v-model="field.value"
                                           placeholder="Введите значение">
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-9">
                                <label class="form__label"><span>Расскажите о себе</span>
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
                                    <button class="rectangle-btn rectangle-btn-green" @click="updateService(index)">
                                        <span>Сохранить</span>
                                    </button>
                                    <button class="rectangle-btn rectangle-btn-green" @click="deleteService(index, service.id)">
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
    export default {
        props:['services','priceOptions', 'additionalFields'],
        name: "ServicesListApp",
        components: {TextareaApp, SelectApp},
        data() {
            return {
                servicesMap:[],
                test:''
            }
        },
        methods: {
            editing(index) {
                this.servicesMap[index].isEditing = !this.servicesMap[index].isEditing;
            },
            changePriceOption(index) {
                let id = this.servicesMap[index].price_option_id;

                let active = find(this.priceOptions, {id});
                this.servicesMap[index].price_option = active;
            },
            updateService(index) {
                this.$emit('update-service', this.servicesMap[index]);
            },
            deleteService(index, id) {
                this.servicesMap[index].isEditing = false;
                setTimeout(() => {
                    this.servicesMap.splice(index, 1);
                    this.$emit('delete-service', id);
                }, 1000)

            }
        },
        mounted() {
            this.servicesMap = this.services.map((item) => {
                this.$set(item, 'isEditing', false);
                //let additions = [];

                // for (let index in this.additionalFields) {
                //     let aField = this.additionalFields[index];
                    // let res = find(item.fields, {speciality_field_id:aField.id});
                    // console.log(item.fields);
                    // if (res) {
                    //     additions.push({
                    //         aId: aField.id,
                    //         fId:res.id,
                    //         title: aField.name,
                    //         value: res.value
                    //     })
                    // } else {
                    //     additions.push({
                    //         aId: aField.id,
                    //         fId:null,
                    //         title: aField.name,
                    //         value: null
                    //     })
                    // }
                //}

                //this.$set(item, 'additions', additions);
                return item;
            });
        }

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
