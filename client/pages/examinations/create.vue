<template>
  <div>
    <loading v-if="loading" />
    <header-info
      :name="'examinations'"
      :navigation="[{name:'home', link: 'dashboard'}, {name: 'examinations', link: 'examinations', trans: true}, {name: form.title, trans: false}]"
    />

    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              {{ $t('create') + " " + $t("examination") + " " + $t("new") }}
            </h3>
          </div>
          <!-- /.card-header -->

          <!-- form start -->
          <form role="form" @submit.prevent="create()">
            <div class="card-body">
              <!-- Title -->
              <label-input-text v-model="form.title" :label="$t('title')" :type="'text'" :placeholder="'Enter Title'" name="title" />

              <!-- Description -->
              <label-input-text v-model="form.description" :label="$t('description')" :type="'text'" :placeholder="'Enter Description'" name="description" />

              <!-- Display Order -->
              <label-input-text v-model="form.display_order" :label="$t('display_order')" :type="'number'" :placeholder="'Enter Price'" name="display_order" />

              <!-- Slug -->
              <label-input-text v-model="form.slug" :label="$t('slug')" :type="'text'" :placeholder="'Enter Slug'" name="slug" />

              <!-- Accept Multi -->
              <check-box v-model="form.accept_multi" :label="$t('accept_multi')" name="accept_multi" />

              <!-- status -->
              <check-box v-model="form.status" :label="$t('activate')" name="status" />

              <!-- Icon -->
              <div class="img-responsive">
                <b-form-file ref="icon-file" class="mt-4" accept="image/*" name="icon" @change="onFileChange" />
                <img class="img-fluid" :src="form.icon">
              </div>
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
      title: this.$t('add_new')
    }
  },
  components: {
    LabelInputText,
    CheckBox
  },
  data: () => {
    return {
      loading: false,
      serviceProviderTypes: [],
      parents: [],
      examinations: [],
      form: new Form({
        title: '',
        description: '',
        display_order: '',
        icon: '',
        slug: '',
        accept_multi: Boolean(false),
        status: Boolean(false)
      })
    }
  },
  methods: {
    async create () {
      this.loading = true
      await this.form.post('/examinations', this.form).then((res) => {
        this.fireSwal('success', this.$t('created_successfully'))
        this.form.reset()
        this.$refs['icon-file'].reset()
      }).catch((e) => {
        this.fireSwal('error', this.$t('something_wrong'))
      })
      this.loading = false
    },

    onFileChange (e) {
      const selectedImage = e.target.files[0]
      this.createBase64Image(selectedImage)
    },

    createBase64Image (fileObject) {
      const reader = new FileReader()
      reader.onload = (e) => {
        this.form.icon = reader.result
      }
      reader.readAsDataURL(fileObject)
    }
  }
}
</script>

<style>

</style>
