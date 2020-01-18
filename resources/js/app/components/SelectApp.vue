<template>
    <div class="form__select"  :class="{show:isShow}" @click="isShow=!isShow">
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
            }
        },
        watch: {
            value(value) {
                this.setSelected();
            }
        },
        mounted() {
            this.setSelected();

        }
    }
</script>

<style scoped>

</style>
