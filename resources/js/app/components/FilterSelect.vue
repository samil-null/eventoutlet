<template>
    <div class="catalog-select" :class="{show}" ref="select">
        <div class="catalog-select__intro" @click="show = !show">
            <div class="catalog-select__title">
                <span>{{ selectName }}</span>
                <div class="arrow-svg"></div>
            </div>
            <div class="catalog-select__result">
                <span>{{ selected.name }}</span>
            </div>
        </div>
        <div class="catalog-select__body">
            <div class="catalog-select__body-title">
                <span>{{ selectTitle }}</span>
            </div>
            <div class="form__select-wrapper">
                <input type="hidden" v-if="selected.id" :name="inputName" :value="selected.id">
                <div class="form__select-list mscroll" data-simplebar data-simplebar-auto-hide="false">
                    <span v-for="(option, index) in options"
                        @click="select(index)"
                    >{{ option.name }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {find} from 'lodash';

    export default {
        props:['options', 'selectName', 'selectTitle', 'inputName', 'form', 'active', 'removeAdditionalFields'],
        name: "FilterSelect",
        data() {
            return {
                show:false,
                selected:{
                    id:null,
                    name:'Нет'
                }
            }
        },
        methods: {
            select(index) {
                this.selected = this.options[index];
                if (this.removeAdditionalFields) {
                    document.querySelectorAll('.addition-field-entity').forEach((item) => {
                        item.remove()
                    });
                }
                if (window.innerWidth >= 767) {
                    setTimeout(() => {
                        document.querySelector(this.form).submit();
                    }, 0)
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
            }

        },
        mounted() {
            let selected = find(this.options, {id:parseInt(this.active)});
            if (selected) {
                this.selected = selected;
            }

            document.addEventListener('click', this.documentClick)
        },

        destroyed() {
            document.removeEventListener('click', this.documentClick)
        }
    }
</script>

