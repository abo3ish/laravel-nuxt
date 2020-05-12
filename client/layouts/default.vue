<template>
  <div class="layout">
    <navbar />

    <div class="container mt-4">
      <nuxt />
    </div>
  </div>
</template>

<script>
import Navbar from '~/components/users/Navbar'
export default {
  components: {
    Navbar
  }
}
</script>
