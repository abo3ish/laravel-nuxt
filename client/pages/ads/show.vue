<template>
  <div>
    <loading v-if="!ad.id" />
    <header-info
      :name="'users'"
      :navigation="[{name:'home', link: 'dashboard'}, {name: 'users', link: 'users'}, {name: user.name, link: '', trans: false}]"
    />

    <div class="row">
      <div class="col-md-12">
        <!-- card -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              {{ ad.name }}
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
            <!-- Slug -->
            <div class="form-group">
              <label for="name">{{ $t('slug') }} : </label>
              <code>
                {{ ad.slug }} <br>
              </code>
            </div>

            <!-- Position -->
            <div class="form-group">
              <label for="position">{{ $t('position') }} : </label>
              <code>
                {{ ad.position }} <br>
              </code>
            </div>

            <!-- Status -->
            <div class="form-group">
              <label for="status">{{ $t('status') }} : </label>
              <b-badge v-if="ad.status" variant="success">
                {{ $t('activated') }}
              </b-badge>
              <b-badge v-else variant="danger">
                {{ $t('not_activated') }}
              </b-badge>
            </div>
            <!-- Image -->
            <div class="form-group">
              <label for="image">{{ $t('image') }} : </label>
              <b-img fluid :src="ad.image" />
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
      title: this.ad.slug
    }
  },
  components: {
    Loading
  },

  data: () => {
    return {
      ad: {}
    }
  },
  mounted () {
    this.fetchData()
  },
  methods: {
    async fetchData () {
      await this.$axios.$get('advertisements/' + this.$route.params.id)
        .then((res) => {
          console.log(res)
          this.ad = res
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
