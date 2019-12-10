<template>
    <div>
        <form action="" @submit.prevent="send">
            <div class="form-group">
                <label for="exampleFormControlInput1">Email</label>
                <input type="text" class="form-control" v-model="email" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Password</label>
                <input type="text" class="form-control" v-model="password" id="exampleFormControlInput2" placeholder="password">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Comfirmed password</label>
                <input type="text" class="form-control" v-model="password_confirmation" id="exampleFormControlInput3" placeholder="password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary mb-2">Send</button>
            </div>
        </form>
    </div>
</template>

<script>
    import axios from '../../modules/axios'

    export default {
        name: "RegisterForm",
        data() {
            return {
                email:'',
                password:'',
                password_confirmation:''
            }
        },
        methods: {
            send() {
                let payload = {
                    email:this.email,
                    password:this.password,
                    password_confirmation:this.password_confirmation
                }

                axios.post('/auth/register', payload)
                    .then(res => {

                    });
            }
        }
    }
</script>

<style scoped>

</style>
