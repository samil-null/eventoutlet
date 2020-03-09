<template>
    <div class="catalog-select" :class="{show}" @click="show = true" ref="select">
        <div class="catalog-select__intro">
            <div class="catalog-select__title" @click="show = !show">
                <span>Поиск</span>
                <div class="arrow-svg"></div>
            </div>
            <div class="catalog-select__result catalog-select__result_search">
                <span class="fix-width-value">{{ value?value:'Нет' }}</span>
            </div>
        </div>

        <div class="catalog-select__body">
            <div class="catalog-select__body-title">
                <span>Поиск по имени</span>
            </div>
            <div class="form__select-wrapper">
                <label class="form__label">
                    <span>{{ title }}</span>
                    <input type="text" class="form__input" :name="fieldName" v-model="value" placeholder="Введите нужное значение" />
                </label>
            </div>
            <div class="catalog-select__button">
                <a href="#" @click="apply" class="rectangle-btn-border rectangle-btn-border-green">
                    <span>Найти</span>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['fieldName', 'title', 'value', 'search', 'form'],
        data() {
            return {
                show:false
            }
        },
        methods: {
            apply() {
                document.querySelector(this.form).submit()
            },
            documentClick(e){
                let el = this.$refs.select;
                let target = e.target;
                if ( (el !== target) && !el.contains(target)) {
                    this.show = false
                }
            }
        },
        mounted() {
            document.addEventListener('click', this.documentClick)
        },
        destroyed() {
            document.removeEventListener('click', this.documentClick)
        }
    }
</script>

<style>
    .catalog-select__result_search {
        max-width:40px;
    }
    .fix-width-value {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

