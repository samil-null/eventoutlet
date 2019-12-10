<template>
    <ul>
        <li v-for="service in services">
            {{ service.name }}
        </li>
    </ul>
</template>

<script>
    export default {
        props:['services'],
        name: "ServicesListApp"
    }
</script>

<style scoped>

</style>
