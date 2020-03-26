<template>
    <div class="form__select" ref="select"  :class="{show:isShow}" @click="isShow=!isShow">
        <div class="form__select-intro">
            <span>{{ select[selectName] || emptySelected }}</span>
            <span class="arrow-svg"></span>
        </div>
        <div class="form__select-body">
            <div class="form__select-title">
                <span>{{ description }}</span>
            </div>
            <div class="form__select-wrapper">
                <div class="form__select-list">
                    <span v-for="(option, index) in options" @click="selected(index, option[selectValue])">{{ option[selectName] }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['options', 'value', 'selectValue', 'selectName', 'emptySelected', 'description'],
        name: "SelectApp",
        data() {
            return {
                isShow:false,
                select: {}
            }
        },

        methods: {
            selected(key, value) {
                this.select = this.options[key];
                this.$emit('input', value);
            },
            setSelected() {
                this.options.forEach(item => {
                    if (item[this.selectValue] == this.value) {
                        this.select = item;
                    }
                });
            },
            documentClick(e){
                let el = this.$refs.select;
                let target = e.target;
                if ( (el !== target) && !el.contains(target)) {
                    this.isShow = false
                }
            },
        },
        watch: {
            value(value) {
                this.setSelected();
            }
        },
        mounted() {
            document.addEventListener('click', this.documentClick)
            this.setSelected();
        },
        destroyed() {
            document.removeEventListener('click', this.documentClick)
        }
    }
</script>

<style scoped>

</style>
