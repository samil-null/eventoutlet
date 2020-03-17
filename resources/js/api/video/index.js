import Vue from 'vue'
import VideoPlayer from 'vue-video-player'
import 'video.js/dist/video-js.css'
Vue.use(VideoPlayer)

import Player from "./components/Player";
new Vue({
    el:'#app',
    components: {
        Player,

    }
});
