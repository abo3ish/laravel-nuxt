<template>
  <div>
    <header-info
      :name="'areas'"
      :navigation="[{name:'home', link: 'dashboard'}, {name: 'areas', link: 'areas'}, {name: form.name, link: '', trans: false}]"
    />

    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              {{ form.name }}
              <n-link :to="{name: 'create-area' }">
                <button class="btn btn-outline-light float-left">
                  {{ $t('add_new') }}
                </button>
              </n-link>
            </h3>
          </div>
          <!-- /.card-header -->

          <!-- form start -->
          <form role="form" @submit.prevent="updatead()">
            <div class="card-body">
              <!-- Name -->
              <label-input-text v-model="form.name" :label="$t('name')" :type="'text'" :placeholder="'Enter Name'" name="Name" />

              <!-- status -->
              <check-box v-model="form.status" :label="$t('activate')" name="status" />

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
      title: this.form.name
    }
  },
  components: {
    LabelInputText,
    CheckBox
  },
  data: () => {
    return {
      area: {},
      form: new Form({
        name: '',
        status: Boolean(false)
      })
    }
  },
  methods: {
    updatead () {
      this.form.post('/areas', this.form)
        .then((res) => {
          this.form.reset()

          this.$notify({
            group: 'feedback',
            title: this.$t('area_saved_successfully'),
            type: 'success'
          })
        }).catch((e) => {
          this.$notify({
            group: 'feedback',
            title: this.$t('area_saved_failed'),
            type: 'error'
          })
        })
    }
  }
}
</script>

<style>

</style>
