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
                        <span>{{ service.name }}</span>
                    </div>
                    <div class="services-list__moder-info">
                        <span>На модерации</span>
                    </div>
                    <div class="services-list__info">
                        <div class="services-list__info-left">
                            <span class="services-list__ltitle">
                                    Цена
                            </span>
                            <div class="services-list__price">
                                <span>{{ service.price }}</span><span></span> <span> {{ service.price_option.name }} </span></div>
                        </div>
                        <div class="services-list__change-btn">
                            <a href="#" @click.prevent="editing(index)"> {{ service.isEditing?'Закрвть':'Изменить' }}</a>
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
                    <form action="" @submit.prevent="updateService(index)">
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
                                    <span></span>
                                    <select-app
                                        :options="priceOptions"
                                        select-value="id"
                                        select-name="name"
                                        v-model="service.price_option_id"
                                        @input="changePriceOption(index)"
                                        description="Кол-во"
                                        empty-selected="Кол-во"
                                    ></select-app>
                                    <button class="rectangle-btn rectangle-btn-green" type="submit">
                                        <span>Сохранить</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
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
        props:['services','priceOptions'],
        name: "ServicesListApp",
        components: {TextareaApp, SelectApp},
        data() {
            return {
                servicesMap:[]
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
            }
        },
        created() {
            this.servicesMap = this.services.map((item) => {
                this.$set(item, 'isEditing', false);
                return item;
            });

            console.log(this.servicesMap);
        }

    }
</script>

<style scoped>

</style>
