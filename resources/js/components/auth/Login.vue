<template>
    <div class="vertical-align-wrap">
        <div class="vertical-align-middle">
            <div class="auth-box ">
                <div class="left">
                    <div class="content text-left">
                        <div class="header">
                            <p class="lead">Login to your account</p>
                        </div>
                        <form method="POST" @submit.prevent="authentication">
                            <div class="form-group text-left">
                                <label for="email" class="control-label sr-only">E-mail Address</label>
                                <input name="email" type="email" class="form-control" v-model="login.email" placeholder="Email">
                                    <span v-if="errors.length > 0" class="invalid-feedback">
                                        <strong>{{ errors }}</strong>
                                    </span>
                            </div>
                            <div class="form-group text-left">
                                <label for="password" class="control-label sr-only">Password</label>
                                <input name="password" class="form-control" v-model="login.password" type="password" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-primary btn-0lg btn-block">
                                Login
                            </button>
                        </form>
                    </div>
                </div>
                <div class="right">
                    <div class="overlay"></div>
                    <div class="content text not-mid">
                        <div class="logo text-center login-logo" style="margin-bottom: 50px;"><img src="img/logo.png" alt="LBA Logo"></div>
                        <h1 class="heading text-center">Welcome to Launch Business Automation System</h1>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    import { mapActions } from 'vuex';
    export default {

        data() {
            return {
                errors: [],
                checked: false,
                login: {
                    email: '',
                    password: ''
                }
            }
        },

        computed: {
            /*...mapGetters({
                getUser: 'getUser'
            })*/
        },

        methods: {
           /* ...mapActions({
                auth: 'authentication'
            }),*/

            authentication() {
                // console.log('DREW')

                let data = {
                    email: this.login.email,
                    password: this.login.password
                }

                this.$store.dispatch('login', data)
                    .then(() => {
                        console.log('success');
                        this.$router.go('/')
                    })
                    .catch(err => {
                        this.errors.push(err);
                    });
                
            },

        }
    }
</script>
