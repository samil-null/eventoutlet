<template>
    <div>
        <div class="image-loader__container" @click="selectImage" :style="{'background-image':'url(' + (image || prevImage)  +')'}">

        </div>
        <input type="file" style="display: none;" ref="imageInput" @change="renderImage">
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
