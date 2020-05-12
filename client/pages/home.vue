<template>
  <card :title="$t('home')">
    {{ $t('you_are_logged_in') + " + " + user.name }}
  </card>
</template>

<script>
export default {
  layout: 'admin',
  middleware: 'auth',
  head () {
    return { title: this.$t('home') }
  },
  computed: {
    user () {
      return this.$auth.user
    }
  }
}
</script>
