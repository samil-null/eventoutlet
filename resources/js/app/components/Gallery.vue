<template>
    <div>
        <div class="pe-portfolio__block">
            <div class="pe-portfolio__field">
                <div class="pe-portfolio__added-photo pe-portfolio__field-item"  v-for="(image, index) in galleryImage" :style="{'background-image': 'url('+ image.full_path +')'}">
                    <div class="pe-portfolio__bg"></div>
                    <div :data-bp="image.full_path" class="pe-portfolio__increase-photo zoomer">
                        <div class="increase-svg"></div>
                    </div>
                    <div class="pe-portfolio__delete-photo" @click="removeImage(image.image, index)">
                        <div class="times-svg"></div>
                    </div>
                </div>
                <div class="pe-portfolio__add-photo pe-portfolio__field-item" @click="addImage" v-if="balance > 0">
                    <div class="bold-plus-svg"></div>
                </div>
                <input type="file" multiple ref="image" style="display: none;" @change="loadImage">
            </div>
            <span class="pe-portfolio__counter" v-if="balance > 0">Еще {{ balance }} фото</span>
        </div>
    </div>
</template>

<script>
    import axios from '../modules/axios'

    export default {
        name: "Gallery",
        props:['images', 'limit'],
        data() {
            return {
                galleryImage:[],
            }
        },
        computed: {
            balance() {
                return this.limit - this.galleryImage.length;
            }
        },
        methods: {
            loadImage() {
                let images = this.$refs.image.files;

                if (images.length) {

                    for (let i = 0; i < images.length; i++) {
                        let form = new FormData();
                        form.append('image', images[i])
                        axios.post('/app/media/gallery', form)
                            .then(({data}) => {
                                this.galleryImage.push(data.image)
                            })
                            .catch(({response}) => {
                                let errors = [];
                                console.log(response)
                                let responseErrors = response.data.errors.image;

                                for (let key in responseErrors) {
                                    errors.push({
                                        type:'error',
                                        body: responseErrors[key]
                                    });
                                }

                                this.$emit('error', errors)
                            });
                    }
                }
                // console.log(images);
                // if (images.length) {
                //
                //
                //
                //     for (var i = 0; i < images.length; i++) {
                //         form.append('images[' + i + ']', images[i]);
                //     }
                //
                //     try {
                //         let response = axios.post('/app/media/gallery', form, {headers: {'Content-Type': 'multipart/form-data'}});
                //             console.log(response.data.images)
                //
                //             response.data.images.map(image => {
                //                 this.galleryImage.push(image);
                //             })
                //
                //     } catch ({response}) {
                //         if (response.status === 422) {
                //             console.log(response.data);
                //             let errors = [];
                //             let responseErrors = response.data.errors;
                //
                //             for (let key in responseErrors) {
                //                 responseErrors[key].forEach(err => {
                //                     errors.push({
                //                         type:'error',
                //                         body: err
                //                     });
                //                 })
                //             }
                //
                //
                //         }
                //     }

            },
            addImage() {
                let input = this.$refs.image;
                input.click();
            },
            removeImage(image, index) {
                axios.delete('/app/media/gallery',{params: {image:image}})
                .then((data) => {
                    this.galleryImage.splice(index,1);
                })
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
