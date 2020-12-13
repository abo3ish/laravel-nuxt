<template>
  <div>
    <header-info
      :name="'service_providers'"
      :navigation="[{name:'home', link: 'dashboard'}, {name: 'service_providers', link: 'service_providers', trans: true}, {name: form.name, link: '', trans: false}]"
    />
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              {{ $t('create') + " " + $t("service_provider") + " " + $t("new") }}
            </h3>
          </div>
          <!-- /.card-header -->

          <!-- form start -->
          <form role="form" @submit.prevent="create()">
            <div class="card-body">
              <!-- Name -->
              <label-input-text v-model="form.name" :label="$t('name')" :type="'text'" :placeholder="'Enter Name'" name="name" />
              <!-- email -->
              <label-input-text v-model="form.email" :label="$t('email')" :type="'email'" :placeholder="'Enter Email Address'" name="email" />
              <!-- password -->
              <label-input-text v-model="form.password" :label="$t('password')" :type="'password'" :placeholder="'Enter Password'" name="password" />
              <!-- address -->
              <label-input-text v-model="form.address" :label="$t('address')" :type="'text'" :placeholder="'Enter Address'" name="address" />
              <!-- phone -->
              <label-input-text v-model="form.phone" :label="$t('phone')" :type="'text'" :placeholder="'Enter Phone'" name="phone" />
              <!-- age -->
              <label-input-text v-model="form.age" :label="$t('age')" :type="'number'" :placeholder="'Enter Age'" name="age" />
              <!-- service_provider_type -->
              <select-box v-model="form.type_id" :items="serviceProviderTypes" :label="$t('service_provider_type')" name="type_id" />
              <!-- status -->
              <check-box v-model="form.status" :label="$t('activate')" name="status" />
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
import SelectBox from '~/components/forms/SelectBox'
import CheckBox from '~/components/forms/CheckBox'

export default {
  layout: 'admin',
  components: {
    LabelInputText,
    SelectBox,
    CheckBox
  },
  data: () => {
    return {
      serviceProviderTypes: [],
      form: new Form({
        name: '',
        email: '',
        phone: '',
        age: '',
        address: '',
        password: '',
        status: Boolean(true),
        type_id: ''
      })
    }
  },
  created () {
    this.$axios.$get('service-provider-types')
      .then((res) => {
        this.serviceProviderTypes = res
      })
  },
  methods: {
    async create () {
      await this.form.post('/service-providers', this.form)

      this.form.reset()
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
