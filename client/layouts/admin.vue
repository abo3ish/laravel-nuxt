<template>
  <div class="layout wrapper">
    <navbar />
    <Sidebar />
    <nuxt class="content-wrapper" />
    <notifications group="feedback" />
  </div>
</template>

<script>
import Navbar from '~/components/admins/Navbar'
import Sidebar from '~/components/admins/Sidebar'

export default {
  components: {
    Navbar,
    Sidebar
  },
  head () {
    return {
      bodyAttrs: {
        class: 'hold-transition sidebar-mini'
      }
    }
  }
}
</script>
