<template>
    <div class="form__textarea-wrapp">
    <textarea :maxlength="limit" @input="writing" v-model="value" id="" :placeholder="placeholder" class="form__textarea">
  	</textarea>
        <span>Еще {{ left }} символов</span>
    </div>
</template>

<script>
    export default {
        props: ['limit', 'placeholder', 'value'],
        name: "TextareaApp",
        computed: {
            left() {
                let count = this.value?this.value.length : 0;
                return this.limit - count;
            }
        },
        methods: {
            writing() {
                this.$emit('input', this.value);
            }
        }

    }
</script>

<style scoped>

</style>
