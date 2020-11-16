<template>
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
      <!-- Home -->
      <li v-for="item in items" :key="item.title" class="nav-item" :class="item.toName == $route.name ? 'menu-open' : ''">
        <nuxt-link :to="{ name: item.toName }" class="nav-link">
          <i class="nav-icon fa fa-dashboard" />
          <p>
            {{ $t(item.title) }}
          </p>
        </nuxt-link>
      </li>
    </ul>
  </ul>
</template>

<script>
export default {
  name: 'SidebarItems',
  data () {
    return {
      sliderArrow: 'right',
      items: [
        { toName: 'dashboard', title: 'home' },
        { toName: 'users', title: 'users' },
        { toName: 'orders', title: 'orders' },
        { toName: 'service-provider-types', title: 'service_provider_types' },
        { toName: 'service-providers', title: 'service_providers' },
        { toName: 'services', title: 'services' },
        { toName: 'drugs', title: 'drugs' },
        { toName: 'ads', title: 'ads' }
      ]
    }
  }
}
</script>

<style>

</style>
