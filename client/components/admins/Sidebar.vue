<template>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 366.667px;">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="https://via.placeholder.com/300/300" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="direction: ltr">
      <div style="direction: rtl">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="https://www.gravatar.com/avatar/52f0fbcbedee04a121cba8dad1174462?s=200&amp;d=mm&amp;r=g" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">حسام موسوی</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <sidebar-items />
        </nav>
        <!-- /.sidebar-menu -->
      </div>
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- /.sidebar -->
</template>

<script>
import SidebarItems from '~/components/admins/SidebarItems'
export default ({
  name: 'AdminSidebar',
  components: {
    'sidebar-items': SidebarItems
  },
  computed: {
    user () {
      return this.$auth.user
    }
  },
  methods: {
    logout () {
      this.$auth.logout()
      // this.user().logout()
    }
  }

})
</script>

<style lang="scss">
  .nav {
    padding-inline-start: 0px !important;
  }
</style>
