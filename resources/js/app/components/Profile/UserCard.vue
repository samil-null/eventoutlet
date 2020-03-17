<template>
    <div class="profile-edit__card-wrapper">
        <div class="profile-edit__card profile-special">
            <a href="/lk/profile" class="profile-edit__card-photo" :style="{'background-image':'url('+ avatar +')'}"></a>
            <a class="profile-edit__name"><a href="/lk/profile">{{ name }}</a></a>
            <div class="profile-edit__prof">
                <span>Статус: {{ status }}</span>
            </div>
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
        props:['name', 'speciality', 'avatar', 'editable', 'link', 'status'],
        name: "UserCard"
    }
</script>
