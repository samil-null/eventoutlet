<template>
    <div class="row">
        <div class="col-lg-3">
            <select v-model="filter.specialities.selected" name="speciality_id">
                <option v-for="speciality in filter.specialities.payload" :value="speciality.id">{{ speciality.name }}</option>
            </select>
        </div>
    </div>
</template>

<script>
    import axios from '../modules/axios'

    export default {
        name: "FilterApp",
        data() {
            return {
                filter: {

                }
            }
        },
        mounted() {
            axios.post('app/filter')
                .then(({data}) => {
                    if (data.success) {
                        this.filter = data.data.filter;
                    }
                })
        }
    }
</script>

<style scoped>

</style>
