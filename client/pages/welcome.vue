<template>
  <div>
    <div class="top-right links">
      <template v-if="$auth.loggedIn">
        <router-link :to="{ name: 'home' }">
          {{ $t('home') }}
        </router-link>
      </template>
      <template v-else>
        <router-link :to="{ name: 'login' }">
          {{ $t('login') }}
        </router-link>
        <router-link :to="{ name: 'register' }">
          {{ $t('register') }}
        </router-link>
      </template>
    </div>

    <div class="text-center">
      <div class="title mb-4">
        <span class="laravel">Laravel</span><span class="nuxt">Nuxt</span>
        <!-- {{ title }} -->
      </div>

      <div class="links">
        <a href="https://github.com/cretueusebiu/laravel-nuxt">github.com/cretueusebiu/laravel-nuxt</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  layout: 'simple',

  head () {
    return { title: this.$t('home') }
  },

  data: () => ({
    title: process.env.appName
  })
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
