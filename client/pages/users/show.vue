<template>
  <div>
    <loading v-if="!user.id" />
    <header-info
      :name="'users'"
      :navigation="[{name:'home', link: 'dashboard'}, {name: 'users', link: 'users'}, {name: user.name, link: '', trans: false}]"
    />

    <div class="row">
      <div class="col-md-12">
        <!-- card -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              {{ user.name }}
              <n-link :to="{name: 'edit-user' }">
                <button class="btn btn-outline-light float-left">
                  {{ $t('edit') }}
                </button>
              </n-link>
            </h3>
          </div>
          <!-- /.card-header -->

          <!-- form start -->
          <div class="card-body">
            <!-- Name -->
            <div class="form-group">
              <label for="balance">{{ $t('name') }} : </label>
              <code>
                {{ user.name }} <br>
              </code>
            </div>

            <!-- Email -->
            <div class="form-group">
              <label for="balance">{{ $t('email') }} : </label>
              <code>
                {{ user.email }}
              </code>
            </div>

            <!-- Status -->
            <div class="form-group">
              <label for="balance">{{ $t('status') }} : </label>
              <b-badge v-if="user.status" variant="success">
                {{ $t('active') }}
              </b-badge>
              <b-badge v-else variant="success">
                {{ $t('active') }}
              </b-badge>
            </div>

            <!-- Address -->
            <div class="form-group">
              <label for="balance">{{ $t('address') }} : </label>
              <code id="address">
                {{ user.address }} <br>
              </code>
            </div>

            <!-- Last Seen -->
            <div class="form-group">
              <label>{{ $t('last_seen') }} : </label>
              <code v-if="user.last_seen">
                {{ $moment(String(user.last_seen), "YYYY-MM-DD").format('LLLL') }} <br>
              </code>
            </div>

            <!-- orders -->
            <div class="form-group">
              <!-- Orders link -->
              <label for="balance">{{ $t('orders') }} : </label>
              <code>
                <nuxt-link :to="{name: 'orders', query: {user_id: user.id}}">{{ $t('orders') }}</nuxt-link> |
              </code>

              <!-- Orders Count -->
              <label for="balance">{{ $t('orders_count') }} : </label>
              <code>
                {{ user.orders_count }}
              </code>
            </div>

            <!-- Created At -->
            <div class="form-group">
              <label>{{ $t('created_at') }} : </label>
              <code>
                {{ $moment(String(user.created_at), "YYYY-MM-DD H:I").format('LLLL') }} <br>
              </code>
            </div>
          </div>
        </div>
        <!-- /.card -->
        <!-- Addresses -->
        <div class="card card-primary">
          <div class="card card-header">
            Notification
          </div>
          <div class="card card-body">
            <form role="form" @submit.prevent="sendFCM()">
              <!-- Title -->
              <label-input-text v-model="form.title" :label="$t('fcm_title')" :type="'text'" :placeholder="'Enter Notification Title'" name="title" />

              <!-- Bdody -->
              <label-input-text v-model="form.body" :label="$t('fcm_body')" :type="'text'" :placeholder="'Enter Notification Body'" name="body" />

              <div class="card-footer">
                <v-button
                  :loading="form.busy"
                  type="success"
                >
                  <b-spinner v-if="form.busy" small type="grow" />
                  {{ $t('send') }}
                </v-button>
              </div>
            </form>
          </div>
        </div>
        <!-- ./Addresses -->

        <!-- Addresses -->
        <div class="card card-primary">
          <div class="card card-header">
            Addresses
          </div>
          <div class="card card-body">
            <b-table :items="user.addresses" :fields="addressFields" show-empty>
              <!-- Area -->
              <template v-slot:cell(area)="data">
                <span>{{ data.item.area.name }}</span>
              </template>
              <template v-slot:cell(map)="data">
                <span><a
                  :href="`https://www.google.com/maps/search/?api=1&query=${data.item.lat},${data.item.lat}`"
                  target="_blank"
                >
                  افتح علي الخريطة
                </a></span>
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
import Loading from '~/components/global/loading'

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
    Loading
  },

  data: () => {
    return {
      user: {
        id: '',
        name: '',
        email: '',
        phone: '',
        channel: '',
        push_token: '',
        push_token_type: '',
        social_id: '',
        social_provider: '',
        status: ''
      },
      addressFields: [
        'id',
        'area',
        'street',
        'building_number',
        'floor_number',
        'flat_number',
        'map',
        'actions'
      ],
      form: new Form({
        title: 'كشف ودوا',
        body: '',
        // data: [],
        user_id: ''
      })
    }
  },
  mounted () {
    this.fetchData()
  },
  methods: {
    fetchData () {
      this.$axios.$get('users/' + this.$route.params.id)
        .then((res) => {
          this.user = res
        })
    },
    async sendFCM () {
      this.form.user_id = this.user.id
      await this.form.post('/fcm', this.form)
        .then((res) => {
          if (res.data > 0) {
            this.fireSwal('success', this.$t('notification_sent_successfully'))
          } else {
            this.fireSwal('error', this.$t('notification_failed'))
          }
        })
    }
  }
}
</script>

<style scoped>
  /* .loader {
    text-align: center;
    color: #bbbbbb;
  } */
</style>
