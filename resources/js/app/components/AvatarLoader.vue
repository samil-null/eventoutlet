<template>
        <div class="pe-portfolio__avatar">
            <div class="pe-portfolio__avatar-hasnt"  @click="selectImage" v-if="!prevImage && !image">
                <span>Добавить аватар</span>
                <div class="bold-plus-svg"></div>
            </div>
            <div class="pe-portfolio__avatar-has" v-else>
                <div
                    data-caption=""
                   class="pe-portfolio__added-photo avatar-zoomer-trigger"
                   :style="{'background-image':'url(' + (image || prevImage)  +')'}"
                   :data-bp="image || prevImage"
                    @click="zoom($event)"
                >
                    <div class="pe-portfolio__bg"></div>
                    <div class="pe-portfolio__increase-photo">
                        <div class="increase-svg"></div>
                    </div>
                    <div class="pe-portfolio__delete-photo">
                        <div class="times-svg"></div>
                    </div>
                </div>
                <span @click="selectImage">Изменить</span>
            </div>
            <input type="file" style="display: none;" ref="imageInput" @change="renderImage">
        </div>
</template>

<script>
    import axios from '../modules/axios'
    import BigPicture from 'bigpicture'

    export default {
        name: 'AvatarLoader',
        props: ['prevImage'],
        data() {
            return {
                image:null
            }
        },
        methods: {
            zoom(e) {
                BigPicture({
                    el: e.target.closest('div[data-bp]')
                })
            },
            selectImage() {
                this.$refs.imageInput.click();
            },
            renderImage() {
                let avatar = this.$refs.imageInput.files[0];
                let self = this;
                let form = new FormData();
                form.append('avatar', avatar);
                axios.post('/app/media/avatar', form)
                    .then(res => res.data.data)
                    .then(data => {
                        self.image = data.path;
                        this.$set(this, 'image', data.path);
                        document.querySelectorAll('.navbar-general__profile-photo, .profile-edit__card-photo').forEach( item => {
                            item.style.backgroundImage = `url(${data.path})`;
                        })
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
