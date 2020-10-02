<template>
  <div class="layout wrapper">
    <navbar />
    <Sidebar />
    <nuxt class="content-wrapper" />
    <notifications group="feedback" />
    <notifications group="newOrder" position="bottom right" width="300" />
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
  },
  mounted () {
    this.$echo.channel('new-order')
      .listen('NewOrder', (e) => {
        console.log(e)

        this.$notify({
          group: 'newOrder',
          title: this.$t('new_order'),
          text: e.user.name + ' <br> طلب ' + '<b>' + e.services + '</b>',
          type: 'success',
          width: 600
        })
      })
  }
}
</script>
