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
              {{ user.name + " - " + user.type.title }}
              <n-link :to="{name: 'edit-service-provider' }">
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

            <!-- Age -->
            <div class="form-group">
              <label for="balance">{{ $t('age') }} : </label>
              <code>
                {{ user.age }}
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

            <!-- Type -->
            <div class="form-group">
              <label for="balance">{{ $t('service_provider_type') }} : </label>
              <code>
                {{ user.type.title }} <br>
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
                <nuxt-link :to="{name: 'orders', query: {service_provider_id: user.id}}">{{ $t('orders') }}</nuxt-link> |
              </code>
              <!-- Orders Count -->
              <label for="balance">{{ $t('orders_count') }} : </label>
              <code>
                {{ user.orders.length }}
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
      </div>
    </div>
  </div>
</template>

<script>

import Form from 'vform'

export default {
  layout: 'admin',
  middleware: 'auth',
  head () {
    return {
      // title: this.address.name
    }
  },
  data: () => {
    return {
      user: {
        id: '',
        name: '',
        phone: '',
        email: '',
        age: '',
        address: '',
        status: '',
        orders: [],
        type: {
          id: '',
          title: ''
        },
        last_seen: '',
        created_at: ''
      },
      orders: [],
      options: [],
      form: new Form({
        service_provider_id: '',
        price_to_pay: ''
      })
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
    },
    update () {
      this.form.put('/orders/' + this.$route.params.id, this.form)
        .then((res) => {
          this.order = res.data
        })

      this.$notify({
        group: 'feedback',
        title: this.$t('service_provider_updated_sucessfully'),
        type: 'success'
      })
    },
    fetchOptions (search, loading) {
      loading(true)
      setTimeout(() => {
        this.$axios.$get('users', { params: { name: search } })
          .then((res) => {
            this.options = res.data
            console.log(res.data)
            loading(false)
          })
      }, 300)
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
