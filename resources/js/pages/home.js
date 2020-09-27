import Vue from 'vue'
import '../scripts/header';
import AuthForm from "../app/components/Auth/AuthForm";
import Search from '../app/components/Search';
import Feedback from '../app/components/Feedback';
import Oferta from '../app/components/Oferta';
import SubscribeModel from "../app/components/SubscribeModel";
import 'simplebar';

import '../common/algo'


new Vue({
    el:'#app',
    components: {
        AuthForm,
        Search,
        Feedback,
        Oferta,
        SubscribeModel
    }
});
