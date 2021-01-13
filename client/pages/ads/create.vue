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
              {{ $t('add_new') }}
            </h3>
          </div>
          <!-- /.card-header -->

          <!-- form start -->
          <form role="form" @submit.prevent="createAd()">
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
      title: this.$t('add_new')
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
  },
  methods: {
    createAd () {
      this.form.post('/advertisements', this.form)
        .then(() => {
          this.form.reset()

          this.fireSwal('success', this.$t('created_successfully'))
        }).catch(() => {
          this.fireSwal('error', this.$t('something_wrong'))
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
