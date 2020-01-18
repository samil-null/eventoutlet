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
                            <label class="form__label">
                                <span>Услуга</span>
                                <input type="text" class="form__input" v-model="name" placeholder="Введите название услуги">
                            </label>
                        </div>
                        <div class="col-xl-6">
                            <label class="form__label">
                                <span>Стоимость</span>
                                <div class="form__icon-input-wrapper">
                                    <div class="rub-svg input-svg"></div>
                                    <div class="delimiter"></div>
                                    <input type="text" class="form__icon-input" v-model="price" placeholder="3 000">
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-9">
                            <label class="form__label">
                                <span>Расскажите о себе</span>
                                <textarea-app
                                    limit="500"
                                    placeholder="Начните писать"
                                    v-model="description"
                                ></textarea-app>
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
        <form @submit.prevent="send" v-if="false">
            <div class="row form-group">
                <div class="col-lg-12">
                    <h4>Добавить услугу</h4>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-6">
                    <label>Услуга</label>
                    <input type="text" class="form-control" v-model="name">
                </div>
                <div class="col-lg-4">
                    <label>Цена</label>
                    <input type="text" class="form-control" v-model="price">
                </div>
                <div class="col-lg-2">
                    <label>Кол-во</label>
                    <select v-model="priceOptionId" class="form-control">
                        <option  v-for="option in priceOptions" :value="option.id">{{ option.name}}</option>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-10">
                    <label>Условия</label>
                    <textarea class="form-control"  rows="5" v-model="description"></textarea>
                </div>
            </div>
            <div class="row form-group" v-for="field in additional">
                <div class="col-lg-10">
                    <label>{{ field.name }}</label>
                    <input type="text" v-model="field.value" :name="`additional_fields[${field.key}]`" class="form-control" v-if="field.type == 'text'">
                    <textarea class="form-control" :name="`additional_fields[${field.key}]`" rows="5" v-if="field.type == 'textarea'" ></textarea>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary mb-2">Добавить</button>
                </div>
            </div>
        </form>
    </form>

</template>

<script>
    import TextareaApp from "./TextareaApp";
    import SelectApp from "./SelectApp";

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
                additional:[]
            }
        },
        methods: {
            send() {
                let payload = {
                    name: this.name,
                    price: this.price,
                    description: this.description,
                    price_option_id: this.priceOptionId,
                    additional_fields: this.additional
                }

                this.$emit('create-service', payload);
            }
        },
        async mounted() {
            this.additional = this.additionalFields.map(item => {
                return {...item, value:null}
            });
        }
    }
</script>

<style scoped>

</style>
