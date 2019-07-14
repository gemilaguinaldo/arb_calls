<template>
    <div class="container">
        <div class="col-md-6 col-lg-6 col-6 col-sm-6 login-wrapper">
            <form method="POST" @submit.prevent="login">
                <h1 class="h3 mb-3 font-weight-normal text-center">Log In</h1>

                <div class="alert alert-danger" role="alert" v-if="status == 'error'">
                    <p class="text-danger" v-html="errors"></p>
                </div>

                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" class="form-control" placeholder="Email address" autofocus="" v-model="email">

                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" class="form-control" placeholder="Password" v-model="password">

                <button class="btn btn-default btn-submit" type="submit" :disabled="status == 'loading'">Sign in</button>
            </form>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        data(){
          return {
            email : "",
            password : ""
          }
        },
        computed: {
            ...mapGetters('auth',[
              'errors',
              'status'
            ])
        },
        methods:{
            login: function(){
                const { email, password } = this;
                this.$store.dispatch('auth/authRequest', { email, password }).then(() => {
                    this.$router.push('/dashboard');
                })
            }
        }
    }
</script>
