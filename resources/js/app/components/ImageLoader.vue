<template>
    <div>
        <div class="pe-portfolio__avatar">
            <div class="pe-portfolio__avatar-hasnt" style="
                display: none;
            "><span>Добавить аватар</span>
                <div class="bold-plus-svg"></div>
            </div>
            <div class="pe-portfolio__avatar-has" style="/* display: none; */">
                <div class="pe-portfolio__added-photo" style="background-image: url(&quot;assets/img/person.png&quot;);">
                    <div class="pe-portfolio__bg"></div>
                    <div class="pe-portfolio__increase-photo">
                        <div class="increase-svg"></div>
                    </div>
                    <div class="pe-portfolio__delete-photo">
                        <div class="times-svg"></div>
                    </div>
                </div> <span>Изменить</span></div>
        </div>
        <div v-if="false">
            <div class="image-loader__container" @click="selectImage" :style="{'background-image':'url(' + (image || prevImage)  +')'}">

            </div>
            <input type="file" style="display: none;" ref="imageInput" @change="renderImage">
        </div>
    </div>


</template>

<script>
import axios from '../modules/axios'

export default {
    name: 'ImageLoader',
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
                    this.image = data.path;
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
