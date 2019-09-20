<template>
  <div id="app">
    
    <app-header></app-header>
    
    <div class="wrapper">
      <transition name="fade">
        <router-view></router-view>
      </transition>
    </div>
    
    <widget-item-edit-modal></widget-item-edit-modal>
  </div>

</template>

<script>
import AppHeader from './header.vue'
import WidgetItemEditModal from '../admin/components/WidgetItemEditModal'
// import AppFooter from './Footer.vue'

export default {
  name: 'AppLayout',
  components: {
    AppHeader,
    WidgetItemEditModal
  }
}
</script>