<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $t('users') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item">
                <nuxt-link :to="{name: 'home'}">
                  {{ $t("home") }}
                </nuxt-link>
              </li>
              <li class="breadcrumb-item active">
                <nuxt-link :to="{name: 'users'}">
                  {{ $t('users') }}
                </nuxt-link>
              </li>
              <li class="breadcrumb-item active">
                <!-- {{ user.name }} -->
              </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

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
              <code>
                {{ user.status ? $t('active') : $t('not_active') }} <br>
              </code>
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
              <code>
                {{ $moment(String(user.last_seen)).format('LLLL') }} <br>
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
                {{ $moment(String(user.created_at)).format('LLLL') }} <br>
              </code>
            </div>
          </div>
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

export default {
  middleware: 'auth',
  layout: 'admin',

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
        'actions'
      ]
    }
  },
  async mounted () {
    await this.fetchData()
  },
  methods: {
    async fetchData () {
      await this.$axios.$get('users/' + this.$route.params.id)
        .then((res) => {
          this.user = res
        })
    }
  }
}
</script>

<style scoped>
  .loader {
    text-align: center;
    color: #bbbbbb;
  }
</style>
