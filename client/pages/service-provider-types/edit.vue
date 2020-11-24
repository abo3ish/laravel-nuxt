<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $t('service_providers') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item">
                <nuxt-link :to="{name: 'home'}">
                  {{ $t("home") }}
                </nuxt-link>
              </li>
              <li class="breadcrumb-item active">
                <nuxt-link :to="{name: 'service-provider-types'}">
                  {{ $t('service_provider_types') }}
                </nuxt-link>
              </li>
              <li class="breadcrumb-item active">
                {{ serviceProviderType.title }}
              </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              {{ serviceProviderType.title }}
              <n-link :to="{name: 'create-service-provider-type' }">
                <button class="btn btn-outline-light float-left">
                  {{ $t('add_new') }}
                </button>
              </n-link>
            </h3>
          </div>
          <!-- /.card-header -->

          <!-- form start -->
          <form role="form" @submit.prevent="update()">
            <div class="card-body">
              <!-- Name -->
              <label-input-text v-model="form.title" :label="$t('title')" :type="'text'" :placeholder="'Enter Title'" name="title" />
              <!-- Description -->
              <label-input-text v-model="form.description" :label="$t('description')" :type="'text'" :placeholder="'Enter Description'" name="description" />
              <!-- Slug -->
              <label-input-text v-model="form.slug" :label="$t('slug')" :type="'text'" :placeholder="'Enter Slug'" name="slug" />
              <!-- profit Percentage -->
              <label-input-text v-model="form.profit_percentage" :label="$t('profit_percentage')" :type="'number'" :placeholder="'Enter profit Percentage'" name="profit_percentage" />

              <div class="card-footer">
                <v-button
                  :loading="form.busy"
                  type="success"
                >
                  {{ $t('save') }}
                </v-button>
              </div>
            </div>
          </form>
        </div>
      <!-- /.card -->
      </div>
    </div>
  </div>
</template>

<script>

import Form from 'vform'
import LabelInputText from '~/components/forms/LabelInputText'

export default {
  layout: 'admin',
  middleware: 'auth',
  head () {
    return {
      title: this.serviceProviderType.title
    }
  },
  components: {
    LabelInputText
  },
  data: () => {
    return {
      serviceProviderType: {},
      form: new Form({
        title: '',
        description: '',
        slug: '',
        profit_percentage: ''
      }),
      type: ''
    }
  },
  created () {
    this.fetchData()
  },
  methods: {
    fetchData () {
      this.$axios.$get('service-provider-types/' + this.$route.params.id)
        .then((res) => {
          this.form.fill(res)
          this.serviceProviderType = res
        })
    },
    update () {
      this.form.put('/service-provider-types/' + this.$route.params.id, this.form)
        .then((res) => {
          this.form.fill(res.data)
          this.serviceProviderType = res.data
        })

      this.$notify({
        group: 'feedback',
        title: this.$t('saved_successfully'),
        type: 'success'
      }).catch((e) => {
        this.$notify({
          group: 'feedback',
          title: this.$t('saved_failed'),
          type: 'error'
        })
      })
    }
  }
}
</script>

<style>

</style>
