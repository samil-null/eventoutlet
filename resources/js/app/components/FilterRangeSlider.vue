<template>
    <div class="catalog-select" :class="{show}" @click="show = true" ref="select">
        <div class="catalog-select__intro">
            <div class="catalog-select__title" @click="show = !show">
                <span>{{ title }}</span>
                <div class="arrow-svg"></div>
            </div>
            <div class="catalog-select__result" v-if="displayResult">
                <span>{{ start }}-{{ end }}%</span>
            </div>
        </div>
        <div class="catalog-select__body">
            <div class="catalog-select__body-title">
                <span>Выберете размер скидки</span>
            </div>
                <div class="form__select-wrapper">
                <label class="form__label">
                    <span>От</span>
                    <div class="form__icon-input-wrapper">
                        <input type="number" :name="`${inputName}[from]`" v-model="start" class="form__icon-input" placeholder="10">
                    </div>
                </label>
                <label class="form__label">
                    <span>До</span>
                    <div class="form__icon-input-wrapper">
                        <input type="number" :name="`${inputName}[to]`" v-model="end" class="form__icon-input" placeholder="70">
                    </div>
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
        name: "FilterRangeSlider",
        props:['fromRange', 'toRange', 'form', 'inputName', 'title', 'displayResult', 'valueFrom', 'valueTo'],
        data() {
            return {
                show:false,
                start:0,
                end:70,
            }
        },
        methods:{
            apply() {
                if (window.innerWidth >= 767) {
                    document.querySelector(this.form).submit()
                } else {
                    this.show = false
                }

            },
            documentClick(e){
                let el = this.$refs.select;
                let target = e.target;
                if ( (el !== target) && !el.contains(target)) {
                    this.show = false
                }
            },
        },
        mounted() {
            document.addEventListener('click', this.documentClick);
            this.start = this.valueFrom || this.fromRange;
            this.end = this.valueTo || this.toRange;
        },
        destroyed() {
            document.removeEventListener('click', this.documentClick)
        }
    }
</script>

<style scoped>

</style>
