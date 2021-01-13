<template>
  <div>
    <header-info
      :name="'service_provider_types'"
      :navigation="[{name:'home', link: 'dashboard'}, {name: 'service_provider_types', link: 'service-provider-types'}, {name: form.title, link: ''}]"
    />

    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              {{ $t('create') + " " + $t("service_provider_type") + " " + $t('new') }}
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
              <!-- Slig -->
              <label-input-text v-model="form.slug" :label="$t('slug')" :type="'text'" :placeholder="'Enter Slug'" name="slug" />

              <!-- Profit Percentage -->
              <label-input-text v-model="form.profit_percentage" :label="$t('profit_percentage') + '%'" :type="'number'" :placeholder="'Enter profit percentage'" name="profit_percentage" />
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
  middleware: 'auth',
  head () {
    return {
      title: this.$t('create') + ' ' + this.$t('service_provider_type') + ' ' + this.$t('new')
    }
  },
  components: {
    LabelInputText
  },
  data: () => {
    return {
      serviceProviderTypes: [],
      form: new Form({
        title: '',
        description: '',
        slug: '',
        profit_percentage: ''
      })
    }
  },

  methods: {
    async create () {
      await this.form.post('/service-provider-types', this.form)
        .then(() => {
          this.form.reset()
          this.fireSwal('success', this.$t('created_successfully'))
        }).catch((e) => {
          this.fireSwal('error', this.$t('something_wrong'))
        })
    }
  }
}
</script>

<style>

</style>
