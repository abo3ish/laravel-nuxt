<template>
  <div>
    <div class="text-center">
      <div class="title mb-4">
        <span class="laravel">كشف </span><span class="nuxt">ودوا</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  head () {
    return { title: this.$t('home') }
  },
  data: () => ({
    title: process.env.appName
  }),
  mounted () {
    //
  }
}
</script>

<style scoped>
.top-right {
  position: absolute;
  right: 10px;
  top: 18px;
}

.title {
  font-size: 85px;
}

.laravel {
  color: #2e495e;
}

.nuxt {
  color: #00c48d;
}
</style>
