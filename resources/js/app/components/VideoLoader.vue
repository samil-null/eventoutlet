<template>
    <div>
        <div class="pe-portfolio__block">
            <div class="pe-portfolio__field">
                <div class="pe-portfolio__added-photo pe-portfolio__field-item"
                     v-for="(video,index) in videosList"
                     :style="{'background-image':'url(' + video.thumb  +')'}"
                >
                    <div class="pe-portfolio__bg"></div>
                    <div class="pe-portfolio__increase-photo zoomer-video" :data-video="video.render">
                        <div class="increase-svg"></div>
                    </div>
                    <div class="pe-portfolio__delete-photo" @click="removeImage(video.name, index)">
                        <div class="times-svg"></div>
                    </div>
                </div>

                <div class="pe-portfolio__add-photo pe-portfolio__field-item" @click="addImage">
                    <div class="bold-plus-svg"></div>
                </div>
            </div>
            <input type="file" ref="image" style="display: none;" @change="loadImage" accept="video/mp4,video/x-m4v,video/*">
            <span class="pe-portfolio__counter" v-if="balance > 0" >Еще {{ balance }} видео</span>
        </div>
    </div>
</template>

<script>
    import axios from '../modules/axios'

    export default {
        name: "VideoLoader",
        props:['limit'],
        data() {
            return {
                videosList:[]
            }
        },
        computed: {
            balance() {
                return this.limit - this.videosList.length;
            }
        },
        methods: {
            loadImage() {
                let input = this.$refs.image;
                let video = input.files[0];

                if (video) {
                    let form = new FormData();
                    form.append('video', video);
                    axios.post('/app/media/videos', form)
                        .then(({data}) => {
                            this.videosList.push(data.video);
                        });
                }

            },
            addImage() {
                let input = this.$refs.image;
                input.click();
            },
            removeImage(video, index) {
                axios.delete('/app/media/videos?video=' + video)
                    .then(({data}) => {
                        this.videosList.splice(index, 1)
                    })
            }
        },
        created() {
            axios.get('/app/media/videos')
                .then(({data}) => {
                    this.videosList = data.videos;
                })
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
