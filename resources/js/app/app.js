import Vue from 'vue'

import AuthForm from "./components/Auth/AuthForm";
import Profile from './pages/Profile'
import CreateOffer from "./pages/CreateOffer";
import EditProfile from "./pages/EditProfile";
import Search from './components/Search';
import store from './store/index'
import FilterApp from "./components/FilterApp";
import FilterSelect from "./components/FilterSelect";
import FilterDatePicker from "./components/FilterDatePicker";
import FilterRangeSlider from "./components/FilterRangeSlider";
import EditOffer from "./pages/EditOffer";
import SpecialOfferCheckBox from "./components/SpecialOfferCheckBox";
import AdditionField from "./components/AdditionField";
import UserCalendar from "./components/Datepickers/UserCalendar";
import PerPageApp from "./components/PerPageApp";
import SearchInCategory from "./components/SearchInCategory";
import Oferta from "./components/Oferta";
import 'simplebar';

new Vue({
    el:'#app',
    store,
    components: {
        AuthForm,
        Profile,
        CreateOffer,
        EditProfile,
        Search,
        FilterApp,
        FilterSelect,
        FilterDatePicker,
        FilterRangeSlider,
        EditOffer,
        SpecialOfferCheckBox,
        AdditionField,
        UserCalendar,
        PerPageApp,
        SearchInCategory,
        Oferta
    }
});
