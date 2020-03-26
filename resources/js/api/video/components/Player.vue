<template>
    <video-player  class="video-player-box"
                   ref="videoPlayer"
                   :options="playerOptions"
                   :playsinline="true"
                   customEventName="customstatechangedeventname"
                   :controls="true"
                   @play="onPlayerPlay($event)"
                   @pause="onPlayerPause($event)"
                   @ended="onPlayerEnded($event)"
                   @waiting="onPlayerWaiting($event)"
                   @playing="onPlayerPlaying($event)"
                   @loadeddata="onPlayerLoadeddata($event)"
                   @timeupdate="onPlayerTimeupdate($event)"
                   @canplay="onPlayerCanplay($event)"
                   @canplaythrough="onPlayerCanplaythrough($event)"

                   @statechanged="playerStateChanged($event)"
                   @ready="playerReadied">
    </video-player>
</template>

<script>
    // Similarly, you can also introduce the plugin resource pack you want to use within the component
    // import 'some-videojs-plugin'
    export default {
        props: ['videoSrc'],
        data() {
            return {
                playerOptions: {
                    // videojs options
                    muted: true,
                    language: 'ru',
                    controls:true,
                   // playbackRates: [0.7, 1.0, 1.5, 2.0],
                    sources: [{
                        type: "video/mp4",
                        src: this.videoSrc
                    }],
                    poster: "/static/images/author.jpg",
                }
            }
        },
        mounted() {

            console.log('this is current player instance object', this.player)
        },
        computed: {
            player() {
                return this.$refs.videoPlayer.player
            }
        },
        methods: {
            // listen event
            onPlayerPlay(player) {
                // console.log('player play!', player)
            },
            onPlayerPause(player) {
                // console.log('player pause!', player)
            },
            // ...player event

            // or listen state event
            playerStateChanged(playerCurrentState) {
                // console.log('player current update state', playerCurrentState)
            },

            // player is ready
            playerReadied(player) {
                console.log('the player is readied', player)
                // you can use it to do something...
                // player.[methods]
            }
        }
    }
</script>

<style>
    .vjs-big-play-button {
        left: 50% !important;
        top: 50% !important;
        transform: translate(-50%, -50%);
    }
    .video-js .vjs-big-play-button {
        height: 62px !important;
        width: 62px !important;
        border-radius: 50% !important;
        background-color: #ffffff !important;
        background-image: url(./play-video.svg);
        background-repeat: no-repeat;
        background-size: 26px 23px;
        background-position: center;
    }
    .vjs-icon-placeholder:before {
        display: none !important;
    }
</style>
