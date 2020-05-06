<template>
    <div class="offer-calendar-swiper">
        <v-ccalendar
            class="sidebar-calendar"
            :attributes="attrs"
            title-position="left"
            is-inline
        />
    </div>
</template>
<script>
    import  VCcalendar from 'v-calendar/lib/components/calendar.umd'
    import $ from 'jquery';

    export default {
        props:['dates'],
        data() {
            return {
                attrs: [
                    {
                        dates:[],
                    },
                ],
                cdata:VCcalendar.data()
            }
        },
        mounted() {
            let self = this;
            $('.offer-calendar-swiper').delegate('.vc-day-box-center-center', 'click', function() {
                self.$emit('select-date', this.classList[1].replace('id-', ''));
            });
        },
        created() {
            
            this.attrs = this.dates.map((item) => {
                return {
                    highlight: true,
                    dates: item
                }
            })

        },
        components: {
            VCcalendar
        }
    }
</script>
