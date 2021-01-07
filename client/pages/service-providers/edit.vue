<template>
  <div>
    <loading v-if="!serviceProvider.name" />
    <header-info
      :name="'service_providers'"
      :navigation="[{name:'home', link: 'dashboard'}, {name: 'service_providers', link: 'service_providers', trans: true}, {name: serviceProvider.name, link: '', trans: false}]"
    />

    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              {{ serviceProvider.name + " - " + serviceProvider.type.title }}
              <n-link :to="{name: 'create-service-provider' }">
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
  middleware: 'auth',
  head () {
    return {
      title: this.serviceProvider.name
    }
  },
  components: {
    LabelInputText,
    SelectBox,
    CheckBox
  },
  data: () => {
    return {
      serviceProviderTypes: [],
      serviceProvider: {
        type: {
          id: '',
          title: ''
        }
      },
      form: new Form({
        name: '',
        email: '',
        phone: '',
        age: '',
        address: '',
        password: '',
        status: Boolean(false),
        type_id: ''
      })
    }
  },
  created () {
    this.fetchServiceProviderTypes()
    this.fetchData()
  },
  methods: {
    async fetchServiceProviderTypes () {
      await this.$axios.$get('service-provider-types/all')
        .then((res) => {
          this.serviceProviderTypes = res
        })
    },
    fetchData () {
      this.$axios.$get('service-providers/' + this.$route.params.id)
        .then((res) => {
          this.form.fill(res)
          this.form.type_id = res.type.id
          this.serviceProvider = res
        })
    },
    async update () {
      await this.form.post('/service-providers/' + this.$route.params.id, this.form)
        .then((res) => {
          this.form.fill(res.data)
          this.serviceProvider = res.data
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
