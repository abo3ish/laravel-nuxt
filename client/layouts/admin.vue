<template>
  <div class="layout">
    <navbar />
    <Sidebar />
    <nuxt class="content-wrapper" />
  </div>
</template>

<script>
import Navbar from '~/components/admins/Navbar'
import Sidebar from '~/components/admins/Sidebar'

export default {
  components: {
    Navbar,
    Sidebar
  }
}
</script>
