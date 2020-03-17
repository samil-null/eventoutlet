import Vue from 'vue'
import '../scripts/header';
import AuthForm from "../app/components/Auth/AuthForm";
import Search from '../app/components/Search';

new Vue({
    el:'#app',
    components: {
        AuthForm,
        Search,
    }
});
