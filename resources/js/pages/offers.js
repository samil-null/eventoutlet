import Vue from 'vue'

import AuthForm from "../app/components/Auth/AuthForm";
import FilterApp from "../app/components/FilterApp";
import FilterSelect from "../app/components/FilterSelect";
import FilterDatePicker from "../app/components/FilterDatePicker";
import FilterRangeSlider from "../app/components/FilterRangeSlider";
import SpecialOfferCheckBox from "../app/components/SpecialOfferCheckBox";
import AdditionField from "../app/components/AdditionField";
import PerPageApp from "../app/components/PerPageApp";

new Vue({
    el:'#app',
    components: {
        AuthForm,
        FilterApp,
        FilterSelect,
        FilterDatePicker,
        FilterRangeSlider,
        SpecialOfferCheckBox,
        AdditionField,
        PerPageApp,
        //SearchInCategory
    }
});