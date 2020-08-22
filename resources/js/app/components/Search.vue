<template>
    <form :action="actionUrl" >
        <div class="header-hero__form">
            <div class="main-form__container">
                <div class="header-hero__form">
                  <div class="main-form__container">
                    <div class="main-form__wrapper">
                      <div class="main-form__inputs">
                        <div class="main-form__input catalog-select" ref="select" :class="{show:showSpeciality}" @click="openSelectSpeciality">
                          <div class="main-form__input-content">
                            <span>{{ selectSpeciality.name }}</span>
                            <div class="arrow-svg"></div>
                          </div>
                          <div class="catalog-select__body ">
                            <div class="catalog-select__body-title">
                                <span>Выберете специальность</span>
                            </div>
                            <div class="form__select-wrapper">
                              <div class="form__select-list mscroll" data-simplebar data-simplebar-auto-hide="false">
                                <span
                                    v-for="(speciality, index) in specialities"
                                    :key="'speciality-item-id' + speciality.id"
                                    @click="selectedSpeciality(index)"
                                    >{{ speciality.name }}</span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="main-form__input catalog-select catalog-select_datepicker" ref="calendar" :class="{show:showDatePick}">
                          <div class="main-form__input-content" @click="showDatePick = true">
                            <span>
                                <template v-if="rawValues.from === rawValues.to">
                                  {{ displayToDate }}
                                </template>
                                <template v-else-if="displayFromDate && displayToDate">
                                    {{ displayFromDate }} - {{ displayToDate }}
                                </template>
                                <template v-else>
                                    Выберите даты
                                </template>
                            </span>
                            <div class="arrow-svg"></div>
                          </div>
                          <div class="catalog-select__body catalog-select__body_datepicker">
                            <div class="catalog-select__body-title">
                                <span>Выберите даты</span>
                            </div>
                            <v-calendar

                              class="calendar main-calendar"
                              mode="range"
                              title-position="left"
                              v-model="range"
                              :available-dates='{ start: startDate, end: endDate }'
                              :masks="{model: 'YYYY-MM-DD'}"
                              is-inline
                            >
                            </v-calendar>
                            <div class="catalog-select__button">
                              <a href="#" class="rectangle-btn-border rectangle-btn-border-green"
                                 @click.prevent="showDatePick = false"
                                ><span>Применить</span></a
                              >
                            </div>
                          </div>
                        </div>
                      </div>
                        <input type="hidden" v-if="dateFrom" :value="dateFrom" name="specials_offers[date_from]">
                        <input type="hidden" v-if="dateTo" :value="dateTo" name="specials_offers[date_to]">
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

    import dayjs from 'dayjs';
    export default {
        props:['specialities', 'startDate', 'endDate'],
        name: 'Search',
        data() {
            return {
                actionUrl:'/offers',
                resp:null,
                range: {
                    start: null,
                    end: null
                },
                selectSpeciality: {
                    id: null,
                    name: 'Выберите специалиста'
                },
                displayFromDate:null,
                displayToDate:null,
                showDatePick:false,
                showSpeciality:false,
                rawValues: {
                  to:NaN,
                  from:NaN
                }
            }
        },
        methods: {
            closePiker() {
                this.showDatePick = false
            },
            openSelectSpeciality() {
                this.showSpeciality = !this.showSpeciality;
            },
            selectedSpeciality(index) {
                this.selectSpeciality = this.specialities[index];
                this.actionUrl =  this.selectSpeciality.slug;
            },
            documentClickCalendar(e){
                let el = this.$refs.calendar;
                let target = e.target;
                if ( (el !== target) && !el.contains(target)) {
                    this.showDatePick = false
                }
            },
            documentClickSelect(e){
                let el = this.$refs.select;
                let target = e.target;
                if ( (el !== target) && !el.contains(target)) {
                    this.showSpeciality= false
                }
            }
        },

        computed: {
            dateFrom() {
                let data = dayjs(this.range.start);
                if (data.$y) {
                    this.rawValues.from = data.format('YYYY-MM-DD');
                    this.displayFromDate = data.format('DD.MM');
                    return data.format('YYYY-MM-DD')
                }
                this.displayFromDate = null;
                return false;
            },
            dateTo() {
                let data = dayjs(this.range.end);
                if (data.$y) {
                    this.rawValues.to = data.format('YYYY-MM-DD');
                    this.displayToDate = data.format('DD.MM.YY');
                    return data.format('YYYY-MM-DD')
                }
                this.displayToDate = null;
                return false;
            },
            hasDuplicate() {

            }
        },
        components: {
            'v-calendar': () => import('v-calendar/lib/components/date-picker.umd')
        },
        mounted() {
            console.log(this.specialities);
            document.addEventListener('click', this.documentClickCalendar)
            document.addEventListener('click', this.documentClickSelect)
        },

        destroyed() {
            document.removeEventListener('click', this.documentClickCalendar)
            document.removeEventListener('click', this.documentClickSelect)
        }
    }
</script>
