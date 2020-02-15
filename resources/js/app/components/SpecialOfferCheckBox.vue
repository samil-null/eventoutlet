<template>
    <div class="additional_filters__checkbox">
        <label class="filter-checkbox">
            Спецпредложения
            <input type="checkbox" @change="changeSpecial" v-model="checked">
            <span class="checkmark"></span>
        </label>
        <template v-if="!checked">
            <input type="hidden" name="specials_offers[date_from]" :value="dateFrom">
            <input type="hidden" name="specials_offers[date_to]" :value="dateTo">
        </template>
    </div>
</template>

<script>
    export default {
        props:['hasSpecial', 'dateFrom', 'dateTo'],
        name: "SpecialOfferCheckBox",
        data() {
            return {
                checked:false
            }
        },
        watch: {

        },
        methods: {
            changeSpecial() {
                if (this.checked === false) {
                    document.querySelectorAll('.addition-field').forEach(item => {
                        item.remove()
                    });

                }

                this.submitForm();
            },
            submitForm() {

                setTimeout(() => {
                    document.querySelector('#offers-filter').submit()
                }, 0)
            }
        },
         created() {
            if (this.hasSpecial) {
                this.checked = true;
            }
         }
    }
</script>

<style scoped>

</style>
