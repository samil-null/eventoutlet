<template>
    <div>
        <div class="">

            <div class="add-image" >
                <div class="images-item" v-for="image in galleryImage" :style="{'background-image': 'url('+ image +')'}">

                </div>
                <button @click="addImage">
                    add image
                </button>
                <input type="file" ref="image" style="display: none;">
            </div>
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
            addImage() {
                let input = this.$refs.image;
                input.click();

                let image = input.files[0];

                if (image) {
                    let form = new FormData();
                    form.append('image', image);

                    let response = axios.post('/app/media/gallery', form);

                    if (response.data.success) {
                        this.galleryImage.push(response.data.data.full_path);
                    }

                }
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
