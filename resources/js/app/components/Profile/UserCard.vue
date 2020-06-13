<template>
    <div class="profile-edit__card-wrapper">
        <div class="profile-edit__card profile-special">
            <a href="/lk/profile" class="profile-edit__card-photo" :style="{'background-image':'url('+ avatar +')'}"></a>
            <div class="profile-edit__body-block">
                <span class="profile-edit__name">
                    <a href="/lk/profile">{{ name }}</a>
                </span>
                <div class="profile-edit__prof">
                    <span>Статус: <span class="user-status" :class="{'user-active':activeStatus, 'user-wait':waitStatus}">{{ status }}</span></span>
                </div>
                <div class="pe-block__add-btn" v-if="editable">
                <a href="/lk/profile/edit" class="add-btn">
                    <span>Редактировать профиль</span>
                </a>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props:['name', 'speciality', 'avatar', 'editable', 'link', 'status', 'statusId'],
        name: "UserCard",
        data() {
            return {
                activeStatus:false,
                waitStatus:false
            }
        },
        created() {
            switch (this.statusId) {
                case 1:
                    this.activeStatus = true;
                    break;
                case 2:
                    this.waitStatus = true;
                    break;
            }
        }
    }
</script>

<style>
    .user-status.user-active {
        color: #91b15f;
    }

    .user-status.user-wait {
        color: #e0c87e;
    }
</style>
