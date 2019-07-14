<template>
    <div class="dashboard-wrapper">
      <h1>My Expenses</h1>
      <div class="row" v-if="expenses.length">
        <div class="col-md-6 col-lg-6 col-6">
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Expense Category</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody v-if="expenses">
                <tr v-for="expense in expenses">
                  <td>{{ expense.category_name }}</td>
                  <td>{{ expense.total }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-6 col-lg-6 col-6">
          <vc-donut :sections="graph" hasLegend>Expense Category</vc-donut>
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

          }
        },
        mounted(){
          this.getData();
        },
        computed: {
            ...mapGetters('dashboard',[
              'expenses',
              'graph'
            ])
        },
        methods:{
          getData: function(){
            this.$store.dispatch('dashboard/getExpenses');
          }
        }
        
    }
</script>