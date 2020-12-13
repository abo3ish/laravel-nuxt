<template>
  <div>
    <loading v-if="!area.id" />
    <header-info
      :name="'areas'"
      :navigation="[{name:'home', link: 'dashboard'}, {name: 'areas', link: 'areas'}, {name: area.name, link: '', trans: false}]"
    />

    <div class="row">
      <div class="col-md-12">
        <!-- card -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              {{ area.name }}
              <n-link :to="{name: 'edit-ad' }">
                <button class="btn btn-outline-light float-left">
                  {{ $t('edit') }}
                </button>
              </n-link>
            </h3>
          </div>
          <!-- /.card-header -->

          <!-- form start -->
          <div class="card-body">
            <!-- Name -->
            <div class="form-group">
              <label for="name">{{ $t('name') }} : </label>
              <b-badge variant="info">
                {{ area.name }}
              </b-badge>
            </div>
            <!-- Status -->
            <div class="form-group">
              <label for="status">{{ $t('status') }} : </label>
              <b-badge v-if="area.status" variant="success">
                {{ $t('activated') }}
              </b-badge>
              <b-badge v-else variant="danger">
                {{ $t('not_activated') }}
              </b-badge>
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
      title: this.area.slug
    }
  },
  components: {
    Loading
  },

  data: () => {
    return {
      area: {}
    }
  },
  mounted () {
    this.fetchData()
  },
  methods: {
    async fetchData () {
      await this.$axios.$get('areas/' + this.$route.params.id)
        .then((res) => {
          this.area = res
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
