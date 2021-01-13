<template>
  <div>
    <loading v-if="loading" />
    <header-info
      :name="'drugs'"
      :navigation="[{name:'home', link: 'dashboard'}, {name: 'drugs', link: 'drugs'}, {name: drug.name, link: '', trans: false}]"
    />

    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              {{ $t('edit') + " " + drug.name }}
            </h3>
          </div>
          <!-- /.card-header -->

          <!-- form start -->
          <form role="form" @submit.prevent="updatedrug()">
            <div class="card-body">
              <!-- Name -->
              <label-input-text v-model="form.name" :label="$t('name')" :type="'text'" :placeholder="'Enter Name'" name="name" />

              <!-- Scientific Name -->
              <label-input-text v-model="form.scientific_name" :label="$t('scientific_name')" :type="'text'" :placeholder="'Enter Scientific Name'" name="scientific_name" />

              <!-- Price -->
              <label-input-text v-model="form.price" :label="$t('price')" :type="'text'" :placeholder="'Enter price'" name="price" />

              <!-- description -->
              <label-text-area v-model="form.description" :label="$t('description')" :placeholder="'Enter description'" name="name" />

              <!-- Name -->
              <select-box v-model="form.category_id" :label="$t('category')" :items="categories" name="category_id" />

              <!-- Image -->
              <div class="img-responsive">
                <input type="file" name="icon" accept="image/*" @change="onFileChange">
                <img class="img-fluid" :src="form.image">
              </div>

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
import LabelTextArea from '~/components/forms/LabelTextArea'
import SelectBox from '~/components/forms/SelectBox'

export default {
  layout: 'admin',
  middleware: 'auth',
  head () {
    return {
      title: this.drug.name
    }
  },
  components: {
    LabelInputText,
    LabelTextArea,
    SelectBox
  },
  data: () => {
    return {
      loading: true,
      categories: [],
      drug: {},
      form: new Form({
        id: '',
        name: '',
        scientific_name: '',
        image: '',
        description: '',
        category_id: '',
        price: ''
      })
    }
  },
  created () {
    this.loading = true
    this.fetchCategories()
    this.fetchData()
  },
  methods: {
    async fetchData () {
      await this.$axios.$get('drugs/' + this.$route.params.id + '/edit')
        .then((res) => {
          this.form.fill(res)
          this.form.category_id = res.category.id
          this.drug = res
        })
      this.loading = false
    },
    async updatedrug () {
      this.loading = true
      await this.form.post('/drugs/' + this.$route.params.id, this.form)
        .then((res) => {
          this.form.fill(res.data)
          this.form.category_id = res.data.category.id

          this.fireSwal('success', this.$t('updated_successfully'))
        }).catch((e) => {
          this.fireSwal('error', this.$t('something_wrong'))
        })
      this.loading = false
    },
    async fetchCategories () {
      await this.$axios.$get('/pharmacy-categories')
        .then((res) => {
          this.categories = res
        })
    },
    onFileChange (e) {
      const selectedImage = e.target.files[0]
      this.createBase64Image(selectedImage)
    },

    createBase64Image (fileObject) {
      const reader = new FileReader()
      reader.readAsDataURL(fileObject)
      reader.onload = (e) => {
        this.form.image = reader.result
      }
    }
  }
}
</script>

<style>
</style>
