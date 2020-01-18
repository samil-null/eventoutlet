<template>
    <div>
        <div class="pe-portfolio__block">
            <div class="pe-portfolio__field">
                <div class="pe-portfolio__added-photo pe-portfolio__field-item"  v-for="image in galleryImage" :style="{'background-image': 'url('+ image +')'}">
                    <div class="pe-portfolio__bg"></div>
                    <div :data-bp="image" class="pe-portfolio__increase-photo zoomer">
                        <div class="increase-svg"></div>
                    </div>
                    <div class="pe-portfolio__delete-photo">
                        <div class="times-svg"></div>
                    </div>
                </div>
                <div class="pe-portfolio__add-photo pe-portfolio__field-item" @click="addImage">
                    <div class="bold-plus-svg"></div>
                </div>
                <input type="file" ref="image" style="display: none;" @change="loadImage">
            </div>
            <span class="pe-portfolio__counter">Еще 15 фото</span>
        </div>
    </div>
</template>

<script>
    import axios from '../modules/axios'

    export default {
        name: "Gallery",
        props:['images'],
        data() {
            return {
                galleryImage:[]
            }
        },
        methods: {
            async loadImage() {
                let input = this.$refs.image;
                let image = input.files[0];

                if (image) {
                    let form = new FormData();
                    form.append('image', image);
                    let response = await axios.post('/app/media/gallery', form);

                    if (response.data.success) {
                        this.galleryImage.push(response.data.data.full_path);
                    }
                }

            },
            addImage() {
                let input = this.$refs.image;
                input.click();
            }
        },
        mounted() {
            console.log(this.$props.images);
            this.galleryImage = this.images;
        }
    }
</script>

<style scoped>
.images-item {
    height: 100px;
    width:100px;
    border: 1px solid #ccc;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
}
.add-image {
    display:flex;
    flex-wrap: wrap;
}
</style>
