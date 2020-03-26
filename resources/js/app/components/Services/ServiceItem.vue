<template>
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
                    <div class="col-xl-6" v-for="field in service.additions">
                        <label class="form__label">
                            <span>{{ field.title }}</span>
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
</template>

<script>
    export default {
        props: ['services'],
        name: "ServiceItem"
    }
</script>

<style scoped>

</style>
