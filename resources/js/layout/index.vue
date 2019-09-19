<template>
  <div id="app">
    
    <app-header></app-header>
    
    <div class="wrapper">
      <transition name="fade">
        <router-view></router-view>
      </transition>
    </div>
    
  </div>

</template>

<script>
import AppHeader from './header.vue'
// import AppFooter from './Footer.vue'

export default {
  name: 'AppLayout',
  components: {
    AppHeader,
    // AppFooter
  }
}
</script>