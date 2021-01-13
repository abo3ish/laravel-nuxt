<template>
  <div>
    <loading v-if="!form.name" />
    <header-info
      :name="'users'"
      :navigation="[{name:'home', link: 'dashboard'}, {name: 'users', link: 'users'}, {name: form.name, link: '', trans: false}]"
    />

    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              {{ user.name }}
              <n-link :to="{name: 'create-user' }">
                <button class="btn btn-outline-light float-left">
                  {{ $t('add_new') }}
                </button>
              </n-link>
              <n-link :to="{name: 'show-user' }">
                <button class="btn btn-outline-light float-left">
                  {{ $t('show') }}
                </button>
              </n-link>
            </h3>
          </div>
          <!-- /.card-header -->

          <!-- form start -->
          <form role="form" @submit.prevent="updateUser()">
            <div class="card-body">
              <!-- Name -->
              <label-input-text v-model="form.name" :label="$t('name')" :type="'text'" :placeholder="'Enter Name'" name="name" />

              <!-- email -->
              <label-input-text v-model="form.email" :label="$t('email')" :type="'email'" :placeholder="'Enter Email Address'" name="email" />

              <!-- phone -->
              <label-input-text v-model="form.phone" :label="$t('phone')" :type="'text'" :placeholder="'Enter Phone'" name="phone" />

              <!-- channel -->
              <label-input-text v-model="form.channel" :label="$t('channel')" :type="'text'" :placeholder="'Enter channel'" name="channel" />

              <!-- Push Token Type -->
              <label-input-text v-model="form.push_token_type" :label="$t('push_token_type')" :type="'text'" :placeholder="'Enter Phone'" name="push_token_type" />

              <!-- Push Token -->
              <label-input-text v-model="form.push_token" :label="$t('push_token')" :type="'text'" :placeholder="'Enter Push Token'" name="push_token" />

              <!-- Social Provider -->
              <label-input-text v-model="form.social_provider" :label="$t('social_provider')" :type="'text'" :placeholder="'Enter Push Token'" name="social_provider" />

              <!-- Social Id -->
              <label-input-text v-model="form.social_id" :label="$t('social_id')" :type="'text'" :placeholder="'Enter Push Token'" name="social_id" />

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

        <!-- Addresses -->
        <div class="card card-primary">
          <div class="card card-header">
            Addresses
          </div>
          <div class="card card-body">
            <b-table :items="user.addresses" :fields="addressFields">
              <template v-slot:cell(area)="data">
                <span v-if="data.item.area">{{ data.item.area.name }}</span>
              </template>
              <template v-slot:cell(actions)="data">
                <!-- Show -->
                <b-button
                  :to="{ name: 'show-address', params: { id: data.item.id }}"
                  variant="info"
                  size="sm"
                >
                  Show
                </b-button>
                <!-- Edit -->
                <b-button
                  :to="{ name: 'edit-address', params: { id: data.item.id }}"
                  variant="secondary"
                  size="sm"
                >
                  Edit
                </b-button>
                <!-- Delete -->
                <b-button
                  variant="danger"
                  size="sm"
                  @click.stop.prevent="deleteItem(data.item.id, $event)"
                >
                  Delete
                </b-button>
              </template>
            </b-table>
          </div>
        </div>
        <!-- ./Addresses -->
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
      title: this.user.name
    }
  },
  components: {
    LabelInputText,
    CheckBox
  },
  data: () => {
    return {
      user: {},
      form: new Form({
        name: '',
        email: '',
        phone: '',
        channel: '',
        push_token: '',
        push_token_type: '',
        social_id: '',
        social_provider: '',
        status: Boolean(true)
      }),
      addressFields: [
        'id',
        'area',
        'street',
        'building_number',
        'floor_number',
        'flat_number',
        'actions'
      ]
    }
  },
  created () {
    this.fetchData()
  },
  methods: {
    fetchData () {
      this.$axios.$get('users/' + this.$route.params.id + '/edit')
        .then((res) => {
          this.form.fill(res)
          this.user = res
        })
    },
    updateUser () {
      this.form.post('/users/' + this.$route.params.id, this.form)
        .then((res) => {
          this.form.fill(res.data)
          this.user = res.data
          this.fireSwal('success', this.$t('updated_successfully'))
        }).catch((e) => {
          this.fireSwal('error', this.$t('something_wrong'))
        })
    }
  }
}
</script>

<style>

</style>
