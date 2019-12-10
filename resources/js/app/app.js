import Vue from 'vue'

import AuthForm from "./components/Auth/AuthForm";
import Profile from './pages/Profile'
import CreateOffer from "./pages/CreateOffer";
import EditProfile from "./pages/EditProfile";

import store from './store/index'


new Vue({
    el:'#app',
    store,
    components: {
        AuthForm,
        Profile,
        CreateOffer,
        EditProfile
    }
})
