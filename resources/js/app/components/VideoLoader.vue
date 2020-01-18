<template>
    <div>
        <div class="pe-portfolio__block">
            <div class="pe-portfolio__field">
                <div class="pe-portfolio__added-photo pe-portfolio__field-item"
                     v-for="video in videosList"
                     :style="{'background-image':'url(' + video.thumb_path  +')'}"
                >
                    <div class="pe-portfolio__bg"></div>
                    <div class="pe-portfolio__increase-photo zoomer-video" :data-video="'/app/media/video/render?name='+video.video_path">
                        <div class="increase-svg"></div>
                    </div>
                    <div class="pe-portfolio__delete-photo">
                        <div class="times-svg"></div>
                    </div>
                </div>

                <div class="pe-portfolio__add-photo pe-portfolio__field-item" @click="addImage">
                    <div class="bold-plus-svg"></div>
                </div>
            </div>
            <input type="file" ref="image" style="display: none;" @change="loadImage" accept="video/mp4,video/x-m4v,video/*">
            <span class="pe-portfolio__counter">Еще 7 видео</span>
        </div>
    </div>
</template>

<script>
    import axios from '../modules/axios'

    export default {
        name: "VideoLoader",
        props:['videos'],
        data() {
            return {
                videosList:[]
            }
        },
        methods: {
            async loadImage() {
                let input = this.$refs.image;
                let video = input.files[0];

                if (video) {
                    let form = new FormData();
                    form.append('video', video);
                    let response = await axios.post('/app/media/video', form);

                    if (response.data.success) {
                        this.videosList.push(response.data.data);
                    }
                }

            },
            renderPreview(video) {
                console.log(video);
            },
            addImage() {
                let input = this.$refs.image;
                input.click();
            }
        },
        created() {
            this.videosList = this.videos;
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
