<template>
    <div class="how-much-filters__wrapper">
        <div class="how-much-filters__main">
            <ul>
                <li v-for="item in list">
                    <label :for="'per-page-'+ item">
                        <input
                            :id="'per-page-'+ item"
                            class="how-much__input"
                            type="radio"
                            name="per_page"
                            :value="item"
                            v-model="selected"
                            @change="changePerPage"
                        />
                        <span>{{ item }} предложений</span>
                    </label>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PerPageApp",
        props:['perPage'],
        data() {
            return {
                list:[10,20,30],
                selected:10
            }
        },
        methods: {
            changePerPage() {
                setTimeout(() => document.querySelector('#offers-filter').submit(), 0);
            }
        },
        created() {
            if (this.perPage) {
                this.selected = this.perPage;
            }
        }
    }
</script>

<style scoped>

</style>
