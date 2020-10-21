<template>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars" /></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="جستجو" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search" />
          </button>
        </div>
      </div>
    </form> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav mr-auto">
      <li v-if="user" class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-dark"
           href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
        >
          <img :src="user.photo_url" class="rounded-circle profile-photo mr-1">
          {{ user.name }}
        </a>
        <div class="dropdown-menu">
          <router-link :to="{ name: 'settings.profile' }" class="dropdown-item pl-3">
            <fa icon="cog" fixed-width />
            {{ $t('settings') }}
          </router-link>

          <div class="dropdown-divider" />
          <a class="dropdown-item pl-3" href="#" @click.prevent="logout">
            <fa icon="sign-out-alt" fixed-width />
            {{ $t('logout') }}
          </a>
        </div>
      </li>
      <!-- Messages Dropdown Menu -->

      <!-- Notifications Dropdown Menu -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell" />
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
          <span class="dropdown-item dropdown-header">15 نوتیفیکیشن</span>
          <div class="dropdown-divider" />
          <a href="#" class="dropdown-item">
            <i class="fa fa-envelope ml-2" /> 4 پیام جدید
            <span class="float-left text-muted text-sm">3 دقیقه</span>
          </a>
          <div class="dropdown-divider" />
          <a href="#" class="dropdown-item">
            <i class="fa fa-users ml-2" /> 8 درخواست دوستی
            <span class="float-left text-muted text-sm">12 ساعت</span>
          </a>
          <div class="dropdown-divider" />
          <a href="#" class="dropdown-item">
            <i class="fa fa-file ml-2" /> 3 گزارش جدید
            <span class="float-left text-muted text-sm">2 روز</span>
          </a>
          <div class="dropdown-divider" />
          <a href="#" class="dropdown-item dropdown-footer">مشاهده همه نوتیفیکیشن</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fa fa-th-large" />
        </a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->
</template>
<script>
export default {
  computed: {
    user () {
      return this.$auth.user
    }
  },
  methods: {
    async logout () {
      // Log out the user.
      await this.$auth.logout()

      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }
}
</script>
