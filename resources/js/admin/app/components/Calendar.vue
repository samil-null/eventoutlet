<template>
    <div>
        <v-ccalendar :attributes="attrs" class="w-100 border-0" ></v-ccalendar>
    </div>
</template>

<script>
    import Cl from 'v-calendar/lib/components/calendar.umd'
    export default {
        props:['rawDates'],
        name: "Calendar",
        data() {
            return {
                attrs: [
                    {
                        dates:[],
                    },
                ],
            }
        },
        components: {
            VCcalendar: () => import('v-calendar/lib/components/calendar.umd')
        },

        mounted() {
            let dates = JSON.parse(this.rawDates);

            this.attrs = dates.map((item) => {
                return {
                    highlight: true,
                    dates: new Date(item.date)
                }
            })
        }
    }
</script>

<style scoped>

</style>
