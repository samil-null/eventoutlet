<template>
<div>
    <span>Выберите размер скидки</span>
    <div class="form__discount">

        <div class="discount-item" v-for="(discount, index) in discountList">
            <label :for="'discount-item-' + index">
                <input
                    :id="'discount-item-' + index"
                    type="radio"
                    name="discount-special-offer"
                    :data-value="discount"
                    :value="discount"
                    v-model="discountValue"
                />
                <span>{{ discount }}%</span>
            </label>
        </div>

        <div class="discount-item discount-item-other">
            <input type="number" placeholder="Другое" v-model="customValue"/>
        </div>
    </div>
</div>


</template>

<script>
    export default {
        name: "DiscountSelect",
        props:['input'],
        data() {
            return {
                discountList: [
                    10, 15, 20, 25, 30, 35, 40, 45, 50
                ],
                discountValue:0,
                customValue:null,
                resultValue:0,

            }
        },
        watch: {
            customValue(value) {
                console.log(value);
                this.resultValue = value;
                return value;
            },
            discountValue(value) {
                this.customValue = null;
                this.resultValue = value;
                return value;
            },
            resultValue(value) {
                this.$emit('input', value);
                return value;
            }
        },
        created() {
            //this.resultValue = this.discountValue = this.input;
        }
    }
</script>

<style scoped>

</style>
