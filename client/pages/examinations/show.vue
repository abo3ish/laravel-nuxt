<template>
  <div>
    <loading v-if="!examination.title" />
    <header-info
      :name="'examinations'"
      :navigation="[{name:'home', link: 'dashboard'}, {name: 'examinations', link: 'examinations'}, {name: examination.title, link: '', trans: false}]"
    />

    <div class="row">
      <div class="col-md-12">
        <!-- card -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              {{ examination.title }}
              <n-link :to="{name: 'edit-examination' }">
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
              <label for="icon">{{ $t('icon') }} : </label>
              <b-img fluid :src="examination.icon" />
            </div>

            <!-- Title -->
            <div class="form-group">
              <label for="name">{{ $t('name') }} : </label>
              <code>
                {{ examination.title }} <br>
              </code>
            </div>

            <!-- description -->
            <div class="form-group">
              <label for="description">{{ $t('description') }} : </label>
              <code>
                {{ examination.description }} <br>
              </code>
            </div>

            <!-- slug -->
            <div class="form-group">
              <label for="slug">{{ $t('slug') }} : </label>
              <code>
                {{ examination.slug }} <br>
              </code>
            </div>

            <!-- slug -->
            <div class="form-group">
              <label for="accept_multi">{{ $t('accept_multi') }} : </label>
              <b-badge v-if="examination.accept_multi" variant="success">
                {{ $t('active') }}
              </b-badge>
              <b-badge v-else variant="success">
                {{ $t('active') }}
              </b-badge>
            </div>

            <!-- display Order -->
            <div class="form-group">
              <label for="display_order">{{ $t('display_order') }} : </label>
              <code>
                {{ examination.display_order }} <br>
              </code>
            </div>

            <!-- slug -->
            <div class="form-group">
              <label for="slug">{{ $t('slug') }} : </label>
              <code>
                {{ examination.slug }}
              </code>
            </div>

            <!-- Status -->
            <div class="form-group">
              <label for="balance">{{ $t('status') }} : </label>
              <b-badge v-if="examination.status" variant="success">
                {{ $t('active') }}
              </b-badge>
              <b-badge v-else variant="success">
                {{ $t('active') }}
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
      title: this.examination.name
    }
  },
  components: {
    Loading
  },

  data: () => {
    return {
      examination: {}
    }
  },
  mounted () {
    this.fetchData()
  },
  methods: {
    fetchData () {
      this.$axios.$get('examinations/' + this.$route.params.id)
        .then((res) => {
          this.examination = res
        })
    }
  }
}
</script>

<style scoped>

</style>
