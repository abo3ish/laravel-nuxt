<template>
  <div>
    <loading v-if="!form.title" />
    <header-info
      :name="'examinations'"
      :navigation="[{name:'home', link: 'dashboard'}, {name: 'examinations', link: 'examinations'}, {name: form.title, link: '', trans: false}]"
    />

    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              {{ $t('edit') + " " + $t("examination") }}
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
    CheckBox
  },
  data: () => {
    return {
      image: null,
      form: new Form({
        title: '',
        description: '',
        display_order: '',
        icon: '',
        slug: '',
        accept_multi: Boolean(true),
        status: Boolean(true)
      })
    }
  },
  mounted () {
    this.fetchData()
  },
  methods: {
    async fetchData () {
      await this.$axios.$get('/examinations/' + this.$route.params.id)
        .then((res) => {
          this.form.fill(res)
        })
    },

    update () {
      this.form.put('/examinations/' + this.$route.params.id, this.form).then((res) => {
        if (res.status === 200) {
          this.$notify({
            group: 'feedback',
            title: this.$t('saved_successfully'),
            type: 'success'
          })
          this.form.fill(res.data)
        } else {
          this.$notify({
            group: 'feedback',
            title: this.$t('saved_failed'),
            type: 'error'
          })
        }
      }).catch(() => {
        this.$notify({
          group: 'feedback',
          title: this.$t('saved_failed'),
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
    }
  }
}
</script>

<style>

</style>
