<template>
  <div class="sidebar">
  <div class="sidebar-sticky">
    <ul class="nav flex-column">
      <li v-if="profile">
        <div class="username-wrapper row">
          <div class="user-image-wrapper col-3">
            <div class="user-image">
              <span>{{ profile.name.charAt(0).toUpperCase() }}</span>
            </div>
          </div>
          <div class="user-details-wrapper col-7">
            <h4>{{ profile.name || '' }}</h4>
            <p>{{ profile.role.name || '' }}</p>
          </div>
        </div>
      </li>
      
      <li class="nav-item">
        <ul class="nav-wrapper">
          <router-link tag="li" class="dashboard" to="/dashboard" :class="[$route.name == 'dashboard' ? 'active' : '']"><h5>DASHBOARD</h5></router-link>
        </ul>
      </li>

      <li class="nav-item" v-if="profile.role.name == 'Administrator'">
        <ul class="nav-wrapper">
          <li class="title"><h5>USER MANAGEMENT</h5></li>
          <router-link tag="li" to="/roles" :class="[$route.name == 'roles' ? 'active' : '']">Roles</router-link>
          <router-link tag="li" to="/users" :class="[$route.name == 'users' ? 'active' : '']">Users</router-link>
        </ul>
      </li>
      <li class="nav-item">
        <ul class="nav-wrapper">
          <li class="title"><h5>EXPENSE MANAGEMENT</h5></li>
          <router-link tag="li" to="/expense-categories" v-if="profile.role.name == 'Administrator'" :class="[$route.name == 'expense-categories' ? 'active' : '']">Expense Categories</router-link>
          <router-link tag="li" to="/expenses" :class="[$route.name == 'expenses' ? 'active' : '']">Expense</router-link>
        </ul>
      </li>
    </ul>
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
        computed: {
            ...mapGetters('user',[
              'profile'
            ])
        }
    }
</script>