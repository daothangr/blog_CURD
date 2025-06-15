<template>
  <div id="app" class="container-fluid">
    <TheHeader />

    <div class="row">
      <div class="col-12 col-md-3">
        <Category v-if="!excludeCategoryPages.includes(route.path)" />
      </div>

    <div :class="excludeCategoryPages.includes(route.path) ? 'col-12' : 'col-12 col-md-9'">
      <router-view />
    </div>
    </div>
  </div>
</template>

<script>
import { useRoute } from 'vue-router'
import Category from './components/Category.vue'
import TheHeader from './components/TheHeader.vue'

export default {
  components: {
    TheHeader,
    Category
  },
  setup() {
    const route = useRoute()
    const excludeCategoryPages = ['/edit', '/create']

    return {
      route,
      excludeCategoryPages
    }
  }
}
</script>

<style>
body {
  font-family: 'Montserrat', sans-serif;
}
</style>
