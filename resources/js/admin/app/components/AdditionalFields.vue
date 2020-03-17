<template>
    <div class="div">
        <div class="row mt-3" v-for="(field, fieldId) in additionalFieldsList" v-if="additionalFieldsList.length">
            <div class="col-lg-4">
                <input type="text" placeholder="Название" :name="createName(field.id)" class="form-control form-control-alternative" v-model="field.name">
            </div>
            <div class="col-lg-4">
                <button class="btn btn-icon btn-2 btn-danger" type="button" @click="deleteField(fieldId)">
                    <span class="btn-inner--icon"><i class="ni ni-fat-remove remove-icon"></i></span>
                </button>
            </div>
        </div>
        <div v-else>
            <h3>Нет свойтс</h3>
        </div>
        <div class="row">
            <div class="col-lg-4 mt-4">
                <button type="button" class="btn btn-primary" @click="addField">Добавить</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "additionalFields",
        props:['options', 'additionFields'],
        data() {
            return {
                additionalFieldsList: [],
                optionsList: []
            }
        },
        methods: {
            addField() {
                this.additionalFieldsList.push({
                    name:null,
                    type:null,
                    key:null
                })
            },
            deleteField(id) {
                this.additionalFieldsList.splice(id, 1);
            },
            createName(id) {
                if (id) {
                    return `addition_fields[exist][${id}]`
                }

                return `addition_fields[new][]`;
            }
        },
        created() {
            this.optionsList = JSON.parse(this.options);
            this.additionalFieldsList = JSON.parse(this.additionFields);
            console.log(this.additionFields);
        }
    }
</script>

<style scoped>
.remove-icon {
    font-size: 22px;
}
</style>
