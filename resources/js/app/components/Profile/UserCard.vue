<template>
    <div class="profile-edit__card-wrapper">
        <div class="profile-edit__card profile-special">
            <div class="profile-edit__card-photo" :style="{'background-image':'url('+ avatar +')'}"></div>
            <div class="profile-edit__name"><span>{{ name }}</span></div>
            <div class="profile-edit__prof"><span>{{ speciality }}</span></div>
            <div class="pe-block__add-btn" v-if="editable">
                <a href="/lk/profile/edit" class="add-btn">
                    <span>Редактировать профиль</span>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['name', 'speciality', 'avatar', 'editable', 'link'],
        name: "UserCard"
    }
</script>
