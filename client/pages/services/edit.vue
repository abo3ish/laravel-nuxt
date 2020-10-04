<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $t('services') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item">
                <nuxt-link :to="{name: 'home'}">
                  {{ $t("home") }}
                </nuxt-link>
              </li>
              <li class="breadcrumb-item active">
                <nuxt-link :to="{name: 'services'}">
                  {{ $t('services') }}
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

              <!-- Purchase Price -->
              <label-input-text v-model="form.purchase_price" :label="$t('purchase_price')" :type="'number'" :placeholder="'Enter purchase Price'" name="purchase_price" />

              <!-- Sell Price -->
              <label-input-text v-model="form.sell_price" :label="$t('sell_price')" :type="'number'" :placeholder="'Enter sell Price'" name="sell_price" />

              <!-- Parent -->
              <select-box v-model="form.parent_id" :items="parents" :label="$t('parents')" name="parent_id" />

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
  components: {
    LabelInputText,
    SelectBox,
    CheckBox
  },
  data: () => {
    return {
      serviceProviderTypes: [],
      parents: [],
      examinations: [],
      file: null,
      image: null,
      form: new Form({
        title: '',
        description: '',
        icon: '',
        service_provider_type_id: '',
        estimation_from: '',
        estimation_to: '',
        purchase_price: '',
        sell_price: '',
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
    fetchData () {
      this.$axios.$get('/services/' + this.$route.params.id)
        .then((res) => {
          console.log(res)
          this.form.fill(res)
        })
    },

    update () {
      this.form.put('/services/' + this.$route.params.id, this.form).then((res) => {
        if (res.status === 200) {
          this.$notify({
            group: 'feedback',
            title: this.$t('service_provider_saved_sucessfully'),
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

      this.form.reset()
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
