<template>
    <div class="expenses-wrapper">
      <div class="row">
        <div class="col-6"><h1>Expenses</h1></div>
        <div class="col-6"><button class="btn btn-default pull-right" @click="openModal('add-edit','add')">Add New</button></div>
      </div>

      <b-modal id="modal-form" hide-footer :title="modal_action == 'add' ? 'Add Expense' : 'Edit Expense'" ref="add-edit">
        <form method="POST" @submit.prevent="submitData">
            <div class="alert alert-danger" role="alert" v-if="status == 'error'">
                <p class="text-danger" v-html="errors"></p>
            </div>

            <label class="sr-only">Amount</label>
            <input type="text" class="form-control" placeholder="Amount" autofocus="" v-model="expense.amount">

            
            <label class="sr-only">Expense Category</label>
            <select class="form-control" v-model="expense.expense_category_id">
              <option value="">Select Expense Category</option>
              <option v-for="category in expense_categories" :value="category.id">{{ category.name }}</option>
            </select>

            <label class="sr-only">Date Entry</label>
            <Datepicker v-model="expense.entry_date" format="dd-MMM-yyyy" placeholder="Date Entry"></Datepicker>

            <footer class="modal-footer">
              <b-button class="mt-3 btn btn-default" block type="submit" :disabled="status == 'loading'">Submit</b-button>
              <b-button class="mt-3 btn btn-default" block @click="$bvModal.hide('modal-form')">Cancel</b-button>
            </footer>
        </form>
      </b-modal>

      <b-modal id="modal-delete" ref="delete" hide-footer title="Delete Expense">
        <form method="POST" @submit.prevent="deleteExpense">
            <p>Are you sure you want to delete this item?</p>
            <footer class="modal-footer">
              <b-button class="mt-3 btn btn-default" block type="submit" :disabled="status == 'loading'">Yes</b-button>
              <b-button class="mt-3 btn btn-default" block @click="$bvModal.hide('modal-delete')">No</b-button>
            </footer>
        </form>
      </b-modal>

      <div class="row" v-if="expenses.length">
        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Expense Category</th>
                  <th>Amount</th>
                  <th>Entry Date</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody v-if="expenses">
                <tr v-for="expense in expenses">
                  <td>{{ expense.category.name }}</td>
                  <td>{{ expense.amount }}</td>
                  <td>{{ expense.entry_date }}</td>
                  <td>{{ expense.created_at }}</td>
                  <td>
                    <button class="btn" @click="setExpense(expense.id, 'update')"><span class="fa fa-pencil"></span></button>
                    <button class="btn" @click="setExpense(expense.id, 'delete')"><span class="fa fa-trash"></span></button>
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
    import Datepicker from 'vuejs-datepicker';

    export default {
        data(){
          return {
            modal_action: 'add',
            current_expense: null
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
        components:{
          Datepicker
        },
        computed: {
            ...mapGetters('expense',[
              'expenses',
              'expense',
              'status',
              'errors'
            ]),
            ...mapGetters('expense_category',[
              'expense_categories',
            ])
        },
        methods:{
          getData: function(){
            this.$store.dispatch('expense/getExpenses');
            this.$store.dispatch('expense_category/getExpenseCategories');
          },
          setExpense: function(id, action){
            this.current_expense = id;
            if(action == 'delete'){
              this.$refs['delete'].show();
            } else if(action == 'update'){
              this.modal_action = 'update';
              this.$store.dispatch('expense/getExpense',id);
              this.$refs['add-edit'].show();
            }
          },
          openModal: function(refs, action){
            this.$store.dispatch('expense/clearState');
            this.modal_action = action;
            this.$refs[refs].show();
          },
          submitData: function(){
            const { id, amount, expense_category_id, entry_date } = this.expense;
            if(this.modal_action == 'add'){
              this.$store.dispatch('expense/addExpense', { amount, expense_category_id, entry_date });
            } else if(this.modal_action == 'update'){
              this.$store.dispatch('expense/updateExpense', { id, expense_category_id, amount, entry_date });
            }
          },
          deleteExpense: function(){
            const { current_expense } = this;
            this.$store.dispatch('expense/deleteExpense', current_expense );
          }
        }
    }
</script>