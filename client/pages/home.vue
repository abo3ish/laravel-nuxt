<template>
  <div>
    <!-- Content Wrapper. Contains page content -->
    <div>
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">
                {{ $t('statistics') }}
              </h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ statistics.users_count }}</h3>

                  <p>{{ $t('users') }}</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag" />
                </div>
                <nuxt-link :to="{name: 'users'}" class="small-box-footer">
                  اضغط للمزيد <fa icon="arrow-circle-left" />
                </nuxt-link>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{ statistics.service_providers_count }}</h3>

                  <p>{{ $t('service_providers') }}</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars" />
                </div>
                <nuxt-link :to="{name: 'service-providers'}" class="small-box-footer">
                  اضغط للمزيد <fa icon="arrow-circle-left" />
                </nuxt-link>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{ statistics.orders_count }}</h3>

                  <p>{{ $t('orders') }}</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add" />
                </div>
                <nuxt-link :to="{name: 'orders'}" class="small-box-footer">
                  اضغط للمزيد <fa icon="arrow-circle-left" />
                </nuxt-link>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{ statistics.services_count }}</h3>

                  <p>{{ $t('services') }}</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph" />
                </div>
                <nuxt-link :to="{name: 'services'}" class="small-box-footer">
                  اضغط للمزيد <fa icon="arrow-circle-left" />
                </nuxt-link>
              </div>
            </div>
          <!-- ./col -->
          </div>
        </div><!-- /.container-fluid -->
      </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- <footer class="main-footer">
      <strong>Copy  &copy; 2020 كشف ودوا</strong>
    </footer> -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    </aside>
  <!-- /.control-sidebar -->
  </div>
</template>

<script>
export default {
  layout: 'admin',
  middleware: 'auth',
  head () {
    return {
      title: this.$t('home')
    }
  },
  data () {
    return {
      statistics: {
        users_count: '',
        Service_providers_count: '',
        orders_count: '',
        services_count: ''
      }
    }
  },
  computed: {
    user () {
      return this.$auth.user
    }
  },
  mounted () {
    this.fetchData()
  },
  methods: {
    async fetchData () {
      await this.$axios.$get('/home')
        .then((res) => {
          this.statistics = res
        })
    }
  }
}
</script>
