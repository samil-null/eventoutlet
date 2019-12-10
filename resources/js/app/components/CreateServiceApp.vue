<template>
    <form @submit.prevent="send">
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
                <label>Специальность</label>
                <select class="form-control" v-model="priceOption">
                    <option :value="0">Нет</option>
                    <option v-for="item in priceOptions" :value="item.id" :key="'price-option-' + item.id">{{ item.name }}</option>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-10">
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
</template>

<script>
    export default {
        props:['priceOptions'],
        name: "CreateServiceApp",
        data() {
            return {
                name:null,
                price:null,
                description:null,
                priceOption:0
            }
        },
        methods: {
            send() {
                let payload = {
                    name: this.name,
                    price: this.price,
                    description: this.description,
                    price_option_id: this.priceOption
                }

                this.$emit('create-service', payload);
            }
        }
    }
</script>

<style scoped>

</style>
