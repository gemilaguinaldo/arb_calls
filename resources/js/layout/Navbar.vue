<template>
	<div class="navbar-main-wrapper">
	  <div class="header-label">
	  	<a class="nav-link" href="#" @click.prevent="logout"><span class="fa fa-sign-out"></span>Sign out</a>
        <a class="nav-link" href="#" @click.prevent="change_password_modal('change-password')"><span class="fa fa-key"></span>Change Password</a>
	  </div>

      <b-modal id="change-pass-form" hide-footer title="Change Password" ref="change-password">
        <form method="POST" @submit.prevent="change_password">
            <div class="alert alert-danger" role="alert" v-if="status == 'error'">
                <p class="text-danger" v-html="errors"></p>
            </div>

            <label class="sr-only">Current Password</label>
            <input type="password" class="form-control" placeholder="Current Password" autofocus="" v-model="current_password">

            <label class="sr-only">New Password</label>
            <input type="password" class="form-control" placeholder="New Password" autofocus="" v-model="new_password">

            <label class="sr-only">Confirm Password</label>
            <input type="password" class="form-control" placeholder="Confirm Password" autofocus="" v-model="confirm_password">            

            <footer class="modal-footer">
              <b-button class="mt-3 btn btn-default" block type="submit" :disabled="status == 'loading'">Submit</b-button>
              <b-button class="mt-3 btn btn-default" block @click="$bvModal.hide('modal-form')">Cancel</b-button>
            </footer>
        </form>
      </b-modal>
	</div>
</template>
<script>
    import { mapGetters } from 'vuex'

    export default {
        data(){
          return {
            current_password: '',
            new_password: '',
            confirm_password: ''
          }
        },
        computed: {
            ...mapGetters('user',[
                'status',
                'errors'
            ])
        },
        methods:{
            logout: function(){
                this.$store.dispatch('auth/authLogout').then(() => {
                    this.$router.push('/login');
                })
            },
            change_password_modal: function(refs){
                this.$refs[refs].show();
            },
            change_password: function(){
                const { current_password, new_password, confirm_password } = this;
                this.$store.dispatch('user/changePassword', {current_password, new_password, confirm_password});
            }
        }
    }
</script>