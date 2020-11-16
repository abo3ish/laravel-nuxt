<template>
  <div class="text-center wrapper">
    <img src="~/assets/images/logo.jpeg" height="500" class="mt-5">
    <h1 class="mt-5">
      كشف ودوا<br>
      قريبا...
    </h1>
  </div>
</template>

<script>
export default {
  layout: 'default',
  head () {
    return {
      title: this.$t('home')
    }
  }
}
</script>
<style scoped>
.wrapper {
  overflow-x: hidden !important;
  overflow-y: hidden !important;
}
</style>
