<template>
        <div class="pe-portfolio__avatar">
            <div class="pe-portfolio__avatar-hasnt"  @click="selectImage" v-if="!prevImage">
                <span>Добавить аватар</span>
                <div class="bold-plus-svg"></div>
            </div>
            <div class="pe-portfolio__avatar-has" v-else>
                <a :href="image || prevImage" class="pe-portfolio__added-photo zoomer" :style="{'background-image':'url(' + (image || prevImage)  +')'}">
                    <div class="pe-portfolio__bg"></div>
                    <div class="pe-portfolio__increase-photo">
                        <div class="increase-svg"></div>
                    </div>
                    <div class="pe-portfolio__delete-photo">
                        <div class="times-svg"></div>
                    </div>
                </a>
                <span @click="selectImage">Изменить</span>
            </div>
            <input type="file" style="display: none;" ref="imageInput" @change="renderImage">
        </div>
</template>

<script>
    import axios from '../modules/axios'

    export default {
        name: 'AvatarLoader',
        props: ['prevImage'],
        data() {
            return {
                image:null
            }
        },
        methods: {
            selectImage() {
                this.$refs.imageInput.click();
            },
            renderImage() {
                let avatar = this.$refs.imageInput.files[0];

                let form = new FormData();
                form.append('avatar', avatar);
                axios.post('/app/media/avatar', form)
                    .then(res => res.data.data)
                    .then(data => {
                        //alert(data.path);
                        this.$set(this, 'image', data.path);
                        //this.image = data.path;
                    })

            }
        },
        mounted() {

        }
    }
</script>
<style>
    .image-loader__container {
        border:1px solid #ccc;
        height: 140px;
        width: 140px;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>
