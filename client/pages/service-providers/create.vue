<template>
  <div>
    <header-info
      :name="'service_providers'"
      :navigation="[{name:'home', link: 'dashboard'}, {name: 'service_providers', link: 'service-providers', trans: true}, {name: form.name, link: '', trans: false}]"
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
              <div class="form-group">
                <label>{{ $t('service_provider_type') }}</label>
                <v-select
                  v-model="form.type_id"
                  dir="rtl"
                  :options="serviceProviderTypes"
                  :reduce="serviceProviderType => serviceProviderType.id"
                  label="title"
                  :placeholder="$t('select') + ' ' + $t('service_provider_type')"
                >
                  <template #selected-option="{ title }">
                    <div class="d-center">
                      {{ title }}
                    </div>
                  </template>
                </v-select>
              </div>
              <!-- Area -->
              <div class="form-group">
                <label>{{ $t('area') }}</label>
                <v-select
                  v-model="form.area_id"
                  dir="rtl"
                  :options="areas"
                  :reduce="area => area.id"
                  label="name"
                  :placeholder="$t('select') + ' ' + $t('area')"
                >
                  <template #selected-option="{ name }">
                    <div class="d-center">
                      {{
                        areas.find(area => area.id == form.area_id) ?
                          areas.find(area => area.id == form.area_id).name
                          : name
                      }}
                    </div>
                  </template>
                </v-select>
              </div>
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
import CheckBox from '~/components/forms/CheckBox'

export default {
  layout: 'admin',
  components: {
    LabelInputText,
    CheckBox
  },
  head () {
    return {
      title: this.$t('add_new')
    }
  },
  data: () => {
    return {
      serviceProviderTypes: [],
      areas: [],
      form: new Form({
        name: '',
        email: '',
        phone: '',
        age: '',
        address: '',
        password: '',
        status: Boolean(false),
        type_id: '',
        area_id: ''
      })
    }
  },
  created () {
    this.fetchServiceProviderTypes()
    this.fetchAreas()
  },
  methods: {
    async fetchServiceProviderTypes () {
      await this.$axios.$get('service-provider-types/all')
        .then((res) => {
          this.serviceProviderTypes = res
        })
    },
    async fetchAreas () {
      await this.$axios.$get('areas/all')
        .then((res) => {
          this.areas = res
        })
    },
    async create () {
      await this.form.post('/service-providers', this.form)
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
