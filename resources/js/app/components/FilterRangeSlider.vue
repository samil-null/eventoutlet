<template>
    <div class="catalog-select" :class="{show}" @click="show = true" ref="select">
        <div class="catalog-select__intro">
            <div class="catalog-select__title">
                <span>Размер скидки</span>
                <div class="arrow-svg"></div>
            </div>
            <div class="catalog-select__result">
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
                    <input type="hidden" name="discount[from]" :value="start">
                    <input type="hidden" name="discount[to]" :value="end">
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
        props:['fromRange', 'toRange', 'form'],
        data() {
            return {
                show:false,
                start:0,
                end:100
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
                let range = [];
                for(let i = start; i < end; i++) {
                    range.push(i);
                }

                return range;
            }

        },
        mounted() {
            let data = this;
            let slider = new rSlider({
                target: this.$refs.filterRange,
                values: Array.from(Array(100).keys()),
                range: true,
                tooltip: false,
                scale: true,
                labels: true,
                set: [parseInt(this.fromRange), parseInt(this.toRange)],
                onChange: function (value) {
                    let values = slider.values;
                    data.start = values.start;
                    data.end = values.end;
                }
            });

            document.addEventListener('click', this.documentClick)
        },
        destroyed() {
            document.removeEventListener('click', this.documentClick)
        }
    }
</script>

<style scoped>

</style>
