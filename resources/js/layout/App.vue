<template>
    <div class="panel panel-default">
        <Sidebar></Sidebar>
        <div role="main" class="main-content-wrapper">
            <Navbar></Navbar>
            <div class="content-main-wrapper">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
	
import Sidebar from '@/js/layout/Sidebar'
import Navbar from '@/js/layout/Navbar'

export default {
		components: {Sidebar, Navbar},
        data(){
          return {
            
          }
        },
    }
</script>