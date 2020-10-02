<template>
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
    <li class="nav-item has-treeview menu-open">
      <a href="#" class="nav-link active">
        <i class="nav-icon fa fa-dashboard" />
        <p>
          {{ $t('home_page') }}
          <i class="right fa fa-angle-left" />
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <nuxt-link :to="{ name: 'service-providers' }" class="nav-link active">
            <i class="fa fa-circle-o nav-icon" />
            <p>{{ $t('service_providers') }}</p>
          </nuxt-link>
        </li>
        <li class="nav-item">
          <nuxt-link :to="{ name: 'orders' }" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p> {{ $t('orders') }}</p>
          </nuxt-link>
        </li>
        <li class="nav-item">
          <nuxt-link :to="{ name: 'service-provider-types' }" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p> {{ $t('service_provider_types') }}</p>
          </nuxt-link>
        </li>
        <li class="nav-item">
          <nuxt-link :to="{ name: 'services' }" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p> {{ $t('services') }}</p>
          </nuxt-link>
        </li>
      </ul>
    </li>
  </ul>
</template>

<script>
export default {
  name: 'SidebarItems',
  data () {
    return {
      sliderArrow: 'right'
    }
  }
}
</script>

<style>

</style>
