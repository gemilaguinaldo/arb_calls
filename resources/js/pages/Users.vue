<template>
    <div class="roles-wrapper">
      <div class="row">
        <div class="col-6"><h1>Users</h1></div>
        <div class="col-6"><button class="btn btn-default pull-right" @click="openModal('add-edit','add')">Add New</button></div>
      </div>

      <b-modal id="modal-form" hide-footer :title="[modal_action == 'add' ? 'Add New' : 'Edit User']" ref="add-edit">
        <form method="POST" @submit.prevent="submitData">
            <div class="alert alert-danger" role="alert" v-if="status == 'error'">
                <p class="text-danger" v-html="errors"></p>
            </div>

            <div class="alert alert-info" role="alert" v-if="modal_action == 'add'">
              <span class="text-info">Please note that the default password is set to <strong>password</strong>. You may change this via Change password.</span>
            </div>

            <label class="sr-only">Name</label>
            <input type="text" class="form-control" placeholder="Name" autofocus="" v-model="user.name">

            <label class="sr-only">Email Address</label>
            <input type="text" class="form-control" placeholder="Email Address" autofocus="" v-model="user.email">

            <label class="sr-only">Role</label>
            <select class="form-control" v-model="user.role_id">
              <option value="">Select Role</option>
              <option v-for="role in roles" :value="role.id">{{ role.name }}</option>
            </select>
            

            <footer class="modal-footer">
              <b-button class="mt-3 btn btn-default" block type="submit" :disabled="status == 'loading'">Submit</b-button>
              <b-button class="mt-3 btn btn-default" block @click="$bvModal.hide('modal-form')">Cancel</b-button>
            </footer>
        </form>
      </b-modal>

      <b-modal id="modal-delete" ref="delete" hide-footer title="Delete User">
        <form method="POST" @submit.prevent="deleteUser">
            <p>Are you sure you want to delete this item?</p>
            <footer class="modal-footer">
              <b-button class="mt-3 btn btn-default" block type="submit" :disabled="status == 'loading'">Yes</b-button>
              <b-button class="mt-3 btn btn-default" block @click="$bvModal.hide('modal-delete')">No</b-button>
            </footer>
        </form>
      </b-modal>

      <div class="row"  v-if="users.length">
        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email Address</th>
                  <th>Role</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody v-if="users">
                <tr v-for="user in users">
                  <td>{{ user.name }}</td>
                  <td>{{ user.email }}</td>
                  <td>{{ user.role.name }}</td>
                  <td>{{ user.created_at }}</td>
                  <td>
                    <div v-if="profile.id != user.id">
                      <button class="btn" @click="setUser(user.id, 'update')"><span class="fa fa-pencil"></span></button>
                      <button class="btn" @click="setUser(user.id, 'delete')"><span class="fa fa-trash"></span></button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div v-else>
        <p>No available data.</p>
      </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    
    export default {
        data(){
          return {
            modal_action: 'add',
            current_user: null
          }
        },
        watch:{
          status: function(val){
            if(val == 'success'){
              this.$refs['delete'].hide();
              this.$refs['add-edit'].hide();
            }
          }
        },
        mounted(){
          this.getData();
        },
        computed: {
            ...mapGetters('user',[
                'users',
                'user',
                'status',
                'errors',
                'profile'
            ]),
            ...mapGetters('role',[
                'roles'
            ])
        },
        methods:{
          getData: function(){
            this.$store.dispatch('user/getUsers');
            this.$store.dispatch('role/getRoles');
          },
          setUser: function(id, action){
            this.current_user = id;
            if(action == 'delete'){
              this.$refs['delete'].show();
            } else if(action == 'update'){
              this.modal_action = 'update';
              this.$store.dispatch('user/getUser',id);
              this.$refs['add-edit'].show();
            }
          },
          openModal: function(refs, action){
            this.modal_action = action;
            this.$refs[refs].show();
            this.$store.dispatch('user/clearState');
          },
          submitData: function(){
            const { id, name, email, role_id } = this.user;
            if(this.modal_action == 'add'){
              this.$store.dispatch('user/addUser', { name, email, role_id });
            } else if(this.modal_action == 'update'){
              this.$store.dispatch('user/updateUser', { id, name, email, role_id });
            }
          },
          deleteUser: function(){
            const { current_user } = this;
            this.$store.dispatch('user/deleteUser', current_user );
          }
        }
    }
</script>