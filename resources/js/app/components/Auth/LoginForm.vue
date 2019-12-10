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
                <button type="submit" class="btn btn-primary mb-2">Send</button>
            </div>
        </form>
    </div>
</template>

<script>
    import axios from '../../modules/axios'

    export default {
        name: "LoginForm",
        data() {
            return {
                email:'',
                password:''
            }
        },
        methods: {
            send() {
                let payload = {
                    email: this.email,
                    password: this.password
                }

                axios.post('/auth/login', payload)
                    .then(res => res.data)
                    .then(data => {
                        if (data.success) {
                            location.href = '/'
                        }
                    })
                    .cache(e => {
                        console.log(e);
                    });
            }
        }
    }
</script>

<style scoped>

</style>
