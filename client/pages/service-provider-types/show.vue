<template>
  <div>
    <loading v-if="!serviceProviderType.title" />
    <header-info
      :name="'service_provider_types'"
      :navigation="[{name:'home', link: 'dashboard'}, {name: 'service_provider_types', link: 'service_provider_types', trans: true}, {name: serviceProviderType.title, link: '', trans: false}]"
    />

    <div class="row">
      <div class="col-md-12">
        <!-- card -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              {{ serviceProviderType.title }}
              <n-link :to="{name: 'edit-service-provider-type' }">
                <button class="btn btn-outline-light float-left">
                  {{ $t('edit') }}
                </button>
              </n-link>
            </h3>
          </div>
          <!-- /.card-header -->

          <!-- form start -->
          <div class="card-body">
            <!-- Slug -->
            <div class="form-group">
              <label for="name">{{ $t('slug') }} : </label>
              <code>
                {{ serviceProviderType.title }} <br>
              </code>
            </div>

            <!-- Description -->
            <div class="form-group">
              <label for="description">{{ $t('description') }} : </label>
              <code>
                {{ serviceProviderType.description }} <br>
              </code>
            </div>

            <!-- Slug -->
            <div class="form-group">
              <label for="slug">{{ $t('slug') }} : </label>
              <code>
                {{ serviceProviderType.slug }} <br>
              </code>
            </div>

            <!-- Profit -->
            <div class="form-group">
              <label for="profit_percentage">{{ $t('profit_percentage') }} : </label>
              <code>
                {{ serviceProviderType.profit_percentage }} <br>
              </code>
            </div>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</template>

<script>
import Loading from '~/components/global/loading'
export default {
  layout: 'admin',
  middleware: 'auth',
  head () {
    return {
      title: this.serviceProviderType.title
    }
  },
  components: {
    Loading
  },

  data: () => {
    return {
      serviceProviderType: {}
    }
  },
  mounted () {
    this.fetchData()
  },
  methods: {
    async fetchData () {
      await this.$axios.$get('service-provider-types/' + this.$route.params.id)
        .then((res) => {
          this.serviceProviderType = res
        })
    }
  }
}
</script>

<style scoped>
  /* .loader {
    text-align: center;
    color: #bbbbbb;
  } */
</style>
