<template>
    <div>
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

    export default {
        props:['dates'],
        date() {
            return {
                attrs: [
                    {
                        dates:[],
                    },
                ],
            }
        },
        created() {
            console.log(this.dates)
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
