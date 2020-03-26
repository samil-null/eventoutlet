<template>
    <div class="catalog-select" :class="{show}" ref="select">
        <div class="catalog-select__intro" @click="show = !show">
            <div class="catalog-select__title">
            <span>{{ title }}</span>
            <div class="arrow-svg"></div>
            </div>
        </div>
        <div class="catalog-select__body">
            <div class="catalog-select__body-title">
                <span>Выберете {{ title }}</span>
            </div>
            <div class="form__select-wrapper">
                <label class="form__label">
                    <span>{{ title }}</span> 
                    <input type="text" class="form__input" :name="fieldName" v-model="value" placeholder="Введите нужное значение" />
                </label>
            </div>
            <div class="catalog-select__button">
                <a href="#" @click="apply" class="rectangle-btn-border rectangle-btn-border-green">
                    <span>Применить</span>
                </a>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props:['fieldName', 'title', 'value', 'form'],
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