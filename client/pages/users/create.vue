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
                <nuxt-link :to="{name: 'service-providers'}">
                  {{ $t('service_providers') }}
                </nuxt-link>
              </li>
              <li class="breadcrumb-item active">
                {{ $t("new_service_provider") }}
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
              {{ $t('create') + " " + $t('new_service_provider') }}
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
              <!-- phone -->
              <label-input-text v-model="form.phone" :label="$t('phone')" :type="'text'" :placeholder="'Enter Phone'" name="phone" />
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
  middleware: 'auth',
  head () {
    return {
      title: this.$t('create_user')
    }
  },
  components: {
    LabelInputText,
    CheckBox
  },
  data: () => {
    return {
      form: new Form({
        name: '',
        email: '',
        password: '',
        phone: '',
        status: Boolean(false)
      })
    }
  },
  created () {

  },
  methods: {
    async create () {
      await this.form.post('/users', this.form)
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
