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
                <div class="form__range">
                    <div class="range-result">
                    <span class="rent-value">
                        {{ start }}-{{ end }}%
                    </span>
                    </div>
                    <input type="hidden" :name="`${inputName}[from]`" :value="start">
                    <input type="hidden" :name="`${inputName}[to]`" :value="end">
                    <input type="text"  ref="filterRange"/>
                </div>
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
    import '../../libs/rslider';

    export default {
        name: "FilterRangeSlider",
        props:['fromRange', 'toRange', 'form', 'inputName', 'title', 'displayResult', 'valueFrom', 'valueTo'],
        data() {
            return {
                show:false,
                start:0,
                end:100,
            }
        },
        methods:{
            apply() {
                document.querySelector(this.form).submit()
            },
            documentClick(e){
                let el = this.$refs.select;
                let target = e.target;
                if ( (el !== target) && !el.contains(target)) {
                    this.show = false
                }
            },
            createValues(start, end) {
                start = parseInt(start);
                end = parseInt(end);
                let range = [];
                for(let i = start; i <= end; i++) {
                    range.push(i);
                }

                return range;
            }

        },
        mounted() {
            let range = this.createValues(this.fromRange, this.toRange);
            this.start = parseInt(this.fromRange);
            this.end = parseInt(this.toRange);
            console.log([parseInt(this.fromRange), parseInt(this.toRange)],);
            let slider = new rSlider({
                target: this.$refs.filterRange,
                values: range,
                range: true,
                tooltip: false,
                scale: true,
                labels: true,
                set: [parseInt(this.valueFrom), parseInt(this.valueTo)],
                onChange: (value) => {
                    let values = value.split(',');
                    ///console.log(values);
                    this.start = parseInt(values[0]);
                    this.end = parseInt(values[1]);
                }
            });

            if (this.displayResult === undefined) {
                this.displayResult = true;
            }



            document.addEventListener('click', this.documentClick)
        },
        destroyed() {
            document.removeEventListener('click', this.documentClick)
        }
    }
</script>

<style scoped>

</style>
