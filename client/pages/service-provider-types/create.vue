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
                  {{ $t('service_providers') }}
                </nuxt-link>
              </li>
              <li class="breadcrumb-item active">
                {{ $t("new_service_provider_type") }}
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
              {{ $t('create_new_service_provider_type') }}
            </h3>
          </div>
          <!-- /.card-header -->

          <!-- form start -->
          <form role="form" @submit.prevent="create()">
            <div class="card-body">
              <!-- Name -->
              <label-input-text v-model="form.title" :label="$t('title')" :type="'text'" :placeholder="'Enter Title'" name="title" />
              <!-- Description -->
              <label-input-text v-model="form.description" :label="$t('description')" :type="'text'" :placeholder="'Enter Description'" name="description" />
              <!-- Name -->
              <label-input-text v-model="form.slug" :label="$t('slug')" :type="'text'" :placeholder="'Enter Slug'" name="slug" />

              <!-- /.card-body -->

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
  components: {
    LabelInputText
  },
  data: () => {
    return {
      serviceProviderTypes: [],
      form: new Form({
        title: '',
        description: '',
        slug: ''
      })
    }
  },

  methods: {
    async create () {
      await this.form.post('/service-provider-types', this.form)

      this.form.reset()
      this.$notify({
        group: 'feedback',
        title: this.$t('service_provider_type_created_sucessfully'),
        type: 'success'
      })
    }
  }
}
</script>

<style>

</style>
