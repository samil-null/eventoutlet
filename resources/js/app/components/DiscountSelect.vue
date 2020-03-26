<template>
<div>
    <span>Выберите размер скидки</span>
    <div class="form__discount">
            <label 
                :for="'discount-item-' + index" 
                :key="'discount-value-' + index" 
                class="discount-item__wrapper"
                v-for="(discount, index) in discountList">
                <input
                    :id="'discount-item-' + index"
                    type="radio"
                    name="discount-special-offer"
                    :data-value="discount"
                    :value="discount"
                    v-model="discountValue"
                    @change="changeDiscount"
                />
                <div class="discount-item">
                    <span>{{ discount }}%</span>
                </div>
            </label>
            <div class="discount-item-other">
                <input type="number" @input="inputCustomValue" min="10" max="70" placeholder="Другое" v-model="customValue" />
            </div>
    </div>
</div>


</template>

<script>
    export default {
        name: "DiscountSelect",
        props:['value'],
        data() {
            return {
                discountList: [
                    10, 15, 20, 25, 30, 35, 40, 45, 50
                ],
                discountValue:null,
                customValue:null,

            }
        },
        methods: {
            init(value) {
                if (value) {
                    let index = this.discountList.indexOf(value);
                    if (index !== -1) {
                        this.discountValue = this.discountList[index];
                        this.customValue = null;

                        return this.discountValue;
                    } else {
                        this.discountValue = null;
                        this.customValue = value;

                        return value;
                    }
                }
            },
            inputCustomValue() {
                this.$emit('input', this.init(parseInt(this.customValue)));
            },
            changeDiscount() {
                this.customValue = null;
                this.$emit('input', this.discountValue)
            }
        },
        created() {
            this.init(this.value);
        }
    }
</script>

<style scoped>

</style>
