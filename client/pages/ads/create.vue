<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $t('ads') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item">
                <nuxt-link :to="{name: 'home'}">
                  {{ $t("home") }}
                </nuxt-link>
              </li>
              <li class="breadcrumb-item active">
                <nuxt-link :to="{name: 'ads'}">
                  {{ $t('ads') }}
                </nuxt-link>
              </li>
              <li class="breadcrumb-item active">
                {{ form.slug }}
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
              {{ ad.name }}
              <n-link :to="{name: 'create-ad' }">
                <button class="btn btn-outline-light float-left">
                  {{ $t('add_new') }}
                </button>
              </n-link>
              <n-link :to="{name: 'show-ad' }">
                <button class="btn btn-outline-light float-left">
                  {{ $t('show') }}
                </button>
              </n-link>
            </h3>
          </div>
          <!-- /.card-header -->

          <!-- form start -->
          <form role="form" @submit.prevent="updatead()">
            <div class="card-body">
              <!-- Slug -->
              <label-input-text v-model="form.slug" :label="$t('slug')" :type="'text'" :placeholder="'Enter Slug'" name="slug" />

              <!-- Position -->
              <select-box v-model="form.position" :items="positions" :label="$t('position')" name="position" />

              <!-- status -->
              <check-box v-model="form.status" :label="$t('activate')" name="status" />

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
import SelectBox from '~/components/forms/SelectBox'
import CheckBox from '~/components/forms/CheckBox'

export default {
  layout: 'admin',
  middleware: 'auth',
  head () {
    return {
      title: this.$t('create_ad')
    }
  },
  components: {
    LabelInputText,
    SelectBox,
    CheckBox
  },
  data: () => {
    return {
      ad: {},
      positions: [
        'full',
        'top',
        'bottom'
      ],
      form: new Form({
        slug: '',
        image: '',
        status: Boolean(false)
      })
    }
  },
  created () {
    this.fetchData()
  },
  methods: {
    updatead () {
      this.form.post('/advertisements', this.form)
        .then((res) => {
          this.form.reset()

          this.$notify({
            group: 'feedback',
            title: this.$t('ad_saved_successfully'),
            type: 'success'
          })
        }).catch((e) => {
          this.$notify({
            group: 'feedback',
            title: this.$t('ad_saved_failed'),
            type: 'error'
          })
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
