<template>
    <form action="/offers">
        <div class="row" v-if="false">
            <div class="col-lg-2">
                <select class="form-control" name="speciality_id" v-model="specialitySelect">
                    <option value="" v-for="speciality in specialities" :value="speciality.id">{{ speciality.name }}</option>
                </select>
            </div>
            <div class="col-lg-2">
                <input type="hidden" v-if="dateFrom != 'Invalid date'" :value="dateFrom" name="specials_offers[date_from]">
                <input type="hidden" v-if="dateTo != 'Invalid date'" :value="dateTo" name="specials_offers[date_to]">
                
                <date-picker
                    v-model="range"
                    mode="range"
                    :masks="{model: 'YYYY-MM-DD'}"
                    :popover="{ placement: 'bottom', visibility: 'click' }">
                    <button type="button" class="btn btn-outline-secondary">select date</button>
                </date-picker>
            </div>
            <div class="col-lg-2">
                <button class="btn btn-danger">find</button>
            </div>
        </div>
        <div class="header-hero__form">
            <div class="main-form__container">
                <div class="header-hero__form">
                  <div class="main-form__container">
                    <div class="main-form__wrapper">
                      <div class="main-form__inputs">
                        <div class="main-form__input catalog-select" :class="{show:showSpeciality}" @click="openSelectSpeciality">
                          <div class="main-form__input-content">
                            <span>{{ selectSpeciality.name }}</span>
                            <div class="arrow-svg"></div>
                          </div>
                          <div class="catalog-select__body ">
                            <div class="catalog-select__body-title"><span>Выберете город</span></div>
                            <div class="form__select-wrapper">
                              <div class="form__select-list">
                                <span 
                                    v-for="(speciality, index) in specialities" 
                                    :key="'speciality-item-id' + speciality.id"
                                    @click="selectedSpeciality(index)"
                                    >{{ speciality.name }}</span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="main-form__input catalog-select catalog-select_datepicker" :class="{show:showDatePick}">
                          <div class="main-form__input-content" @click="showDatePick = true">
                            <span>Выберите даты</span>
                            <div class="arrow-svg"></div>

                          </div>
                          <div class="catalog-select__body catalog-select__body_datepicker">
                            <div class="catalog-select__body-title"><span>Выберете город</span></div>
                            <v-calendar
                            
                              class="calendar main-calendar"
                              mode="range"
                              title-position="left"
                              v-model="range"
                              :masks="{model: 'YYYY-MM-DD'}"
                              is-inline
                            >
                            </v-calendar>
                            <div class="catalog-select__button">
                              <a href="#" class="rectangle-btn-border rectangle-btn-border-green"
                                 @click="showDatePick = false"
                                ><span>Применить</span></a
                              >
                            </div>
                          </div>
                        </div>
                      </div>
                        <input name="speciality_id" type="hidden" :value="selectSpeciality.id" v-if="selectSpeciality.id">
                        <input type="hidden" v-if="dateFrom != 'Invalid date'" :value="dateFrom" name="specials_offers[date_from]">
                        <input type="hidden" v-if="dateTo != 'Invalid date'" :value="dateTo" name="specials_offers[date_to]">
                
                      <button type="submit" class="almost-square-btn almost-square-btn-corral">
                        <span>Поиск</span>
                      </button>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import axios from '../modules/axios'
    import moment from 'moment'

    export default {
        props:['specialities'],
        name: 'Search',
        data() {
            return {
                resp:null,
                range: {
                    start: null,
                    end: null
                },
                selectSpeciality: {
                    id: null,
                    name: 'Выберите специалиста'
                },
                showDatePick:false,
                showSpeciality:false
            }
        },
        methods: {
            openSelectSpeciality() {
                this.showSpeciality = !this.showSpeciality;
            },
            selectedSpeciality(index) {
                this.selectSpeciality = this.specialities[index];
            },

        },
        computed: {
            dateFrom() {
                return moment(this.range.start).format('YYYY-MM-DD')
            },
            dateTo() {
                return moment(this.range.end).format('YYYY-MM-DD');
            }
        },
        mounted() {
            //alert('show');
            // axios.get('/app/specialties')
            //     .then(res => res.data.data)
            //     .then(data => {
            //         this.specialties = data;
            //     })
        },
        components: {
            'v-calendar': () => import('v-calendar/lib/components/date-picker.umd')
        }
    }
</script>
