<template>
    <div class="roles-wrapper">
      <div class="row">
        <div class="col-6"><h1>Roles</h1></div>
        <div class="col-6"><button class="btn btn-default pull-right" @click="openModal('add-edit','add')">Add New</button></div>
      </div>

      <b-modal id="modal-form" hide-footer :title="modal_action == 'add' ? 'Add Role' : 'Edit Role'" ref="add-edit">
        <form method="POST" @submit.prevent="submitData">
            <div class="alert alert-danger" role="alert" v-if="status == 'error'">
                <p class="text-danger" v-html="errors"></p>
            </div>

            <label class="sr-only">Display Name</label>
            <input type="text" class="form-control" placeholder="Display Name" autofocus="" v-model="role.name">

            <label class="sr-only">Description</label>
            <input type="text" class="form-control" placeholder="Description" autofocus="" v-model="role.description">

            <footer class="modal-footer">
              <b-button class="mt-3 btn btn-default" block type="submit" :disabled="status == 'loading'">Submit</b-button>
              <b-button class="mt-3 btn btn-white" block @click="$bvModal.hide('modal-form')">Cancel</b-button>
            </footer>
        </form>
      </b-modal>

      <b-modal id="modal-delete" ref="delete" hide-footer title="Delete Role">
        <form method="POST" @submit.prevent="deleteRole">
            <p>Are you sure you want to delete this item?</p>
            <footer class="modal-footer">
              <b-button class="mt-3 btn btn-default" block type="submit" :disabled="status == 'loading'">Yes</b-button>
              <b-button class="mt-3 btn btn-default" block @click="$bvModal.hide('modal-delete')">No</b-button>
            </footer>
        </form>
      </b-modal>

      <div class="row" v-if="roles.length">
        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Display Name</th>
                  <th>Description</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody v-if="roles">
                <tr v-for="role in roles">
                  <td>{{ role.name }}</td>
                  <td>{{ role.description }}</td>
                  <td>{{ role.created_at }}</td>
                  <td>
                    <button class="btn" @click="setRole(role.id, 'update')"><span class="fa fa-pencil"></span></button>
                    <button class="btn" @click="setRole(role.id, 'delete')"><span class="fa fa-trash"></span></button>
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
            current_role: null
          }
        },
        mounted(){
          this.getData();
        },
        watch:{
          status: function(val){
            if(val == 'success'){
              this.$refs['delete'].hide();
              this.$refs['add-edit'].hide();
            }
          }
        },
        computed: {
            ...mapGetters('role',[
              'roles',
              'role',
              'status',
              'errors'
            ])
        },
        methods:{
          getData: function(){
            this.$store.dispatch('role/getRoles');
          },
          setRole: function(id, action){
            this.current_role = id;
            if(action == 'delete'){
              this.$refs['delete'].show();
            } else if(action == 'update'){
              this.modal_action = 'update';
              this.$store.dispatch('role/getRole',id);
              this.$refs['add-edit'].show();
            }
          },
          openModal: function(refs, action){
            this.modal_action = action;
            this.$refs[refs].show();
            this.$store.dispatch('role/clearState');
          },
          submitData: function(){
            const { id, name, description } = this.role;
            if(this.modal_action == 'add'){
              this.$store.dispatch('role/addRole', { name, description });
            } else if(this.modal_action == 'update'){
              this.$store.dispatch('role/updateRole', { id, name, description });
            }
          },
          deleteRole: function(){
            const { current_role } = this;
            this.$store.dispatch('role/deleteRole', current_role );
          }
        }
    }
</script>