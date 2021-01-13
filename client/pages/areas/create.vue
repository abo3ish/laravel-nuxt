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
              {{ $t('add_new') }}
            </h3>
          </div>
          <!-- /.card-header -->

          <!-- form start -->
          <form role="form" @submit.prevent="createArea()">
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
      title: this.$t('add_new')
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
    createArea () {
      this.form.post('/areas', this.form)
        .then(() => {
          this.form.reset()
          this.fireSwal('success', this.$t('created_successfully'))
        }).catch(() => {
          this.fireSwal('error', this.$t('something_wrong'))
        })
    }
  }
}
</script>

<style>

</style>
