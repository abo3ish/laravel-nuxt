<template>
  <div>
    <loading v-if="loading" />
    <header-info
      :name="'services'"
      :navigation="[{name:'home', link: 'dashboard'}, {name: 'services', link: 'services'}, {name: form.title, link: '', trans: false}]"
    />

    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              {{ $t('create_new_service') }}
            </h3>
          </div>
          <!-- /.card-header -->

          <!-- form start -->
          <form role="form" @submit.prevent="update()">
            <div class="card-body">
              <!-- Title -->
              <label-input-text v-model="form.title" :label="$t('title')" :type="'text'" :placeholder="'Enter Title'" name="title" />

              <!-- Description -->
              <label-input-text v-model="form.description" :label="$t('description')" :type="'text'" :placeholder="'Enter Description'" name="description" />

              <!-- password -->
              <select-box v-model="form.service_provider_type_id" :items="serviceProviderTypes" :label="$t('service_provider_type')" name="service_provider_type_id" />

              <select-box v-model="form.examination_id" :items="examinations" :label="$t('examination_type')" name="examination_id" />

              <!-- Estimation From -->
              <label-input-text v-model="form.estimation_from" :label="$t('estimation_from')" :type="'number'" :placeholder="'Enter Estimation From Price'" name="estimation_from" />

              <!-- Estimation To -->
              <label-input-text v-model="form.estimation_to" :label="$t('estimation_to')" :type="'number'" :placeholder="'Enter Estimation To Price'" name="estimation_to" />

              <!-- Price -->
              <label-input-text v-model="form.price" :label="$t('price')" :type="'number'" :placeholder="'Enter Price'" name="price" />

              <!-- Display Order -->
              <label-input-text v-model="form.display_order" :label="$t('display_order')" :type="'number'" :placeholder="'Enter Display Order'" name="display_order" />

              <!-- Parent -->
              <select-box v-model="form.parent_id" :items="parents" :label="$t('parent')" name="parent_id" />

              <!-- Slug -->
              <label-input-text v-model="form.slug" :label="$t('slug')" :type="'text'" :placeholder="'Enter Slug'" name="slug" />

              <!-- status -->
              <check-box v-model="form.status" :label="$t('activate')" name="status" />

              <!-- Icon -->
              <div class="img-responsive">
                <input type="file" name="icon" accept="image/*" @change="onFileChange">
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
import SelectBox from '~/components/forms/SelectBox'
import CheckBox from '~/components/forms/CheckBox'
export default {
  layout: 'admin',
  middleware: 'auth',
  head () {
    return {
      title: this.form.title
    }
  },
  components: {
    LabelInputText,
    SelectBox,
    CheckBox
  },
  data: () => {
    return {
      loading: false,
      serviceProviderTypes: [],
      parents: [],
      examinations: [],
      file: null,
      image: null,
      form: new Form({
        title: '',
        description: '',
        display_order: '',
        icon: '',
        service_provider_type_id: '',
        estimation_from: '',
        estimation_to: '',
        price: '',
        examination_id: '',
        parent_id: '',
        status: Boolean(true),
        slug: ''
      })
    }
  },
  mounted () {
    this.fetchParents()
    this.fetchServiceProviderTypes()
    this.fetchExaminations()
    this.fetchData()
  },
  methods: {
    async fetchData () {
      this.loading = true
      await this.$axios.$get('/services/' + this.$route.params.id)
        .then((res) => {
          this.form.fill(res)
        })
      this.loading = false
    },

    update () {
      this.loading = true
      this.form.post('/services/' + this.$route.params.id, this.form).then((res) => {
        if (res.status === 200) {
          this.$notify({
            group: 'feedback',
            title: this.$t('service_provider_saved_successfully'),
            type: 'success'
          })
          this.form.fill(res.data)
        } else {
          this.$notify({
            group: 'feedback',
            title: this.$t('service_provider_saved_failed'),
            type: 'error'
          })
        }
      }).catch(() => {
        this.$notify({
          group: 'feedback',
          title: this.$t('service_provider_saved_failed'),
          type: 'error'
        })
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
    },

    async fetchServiceProviderTypes () {
      await this.$axios.$get('service-provider-types/all')
        .then((res) => {
          this.serviceProviderTypes = res
        })
    },

    async fetchExaminations () {
      await this.$axios.$get('examinations/all')
        .then((res) => {
          this.examinations = res
        })
    },

    async fetchParents () {
      await this.$axios.$get('services/all')
        .then((res) => {
          this.parents = res
        })
    }
  }
}
</script>

<style>

</style>
