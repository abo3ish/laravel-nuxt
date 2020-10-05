<template>
  <div>
    <loading v-if="!order.id" />
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $t('service_providers') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item">
                <nuxt-link :to="{name: 'home'}">
                  {{ $t("home") }}
                </nuxt-link>
              </li>
              <li class="breadcrumb-item active">
                <nuxt-link :to="{name: 'orders'}">
                  {{ $t('orders') }}
                </nuxt-link>
              </li>
              <li class="breadcrumb-item active">
                <!-- {{ serviceProvider.name }} -->
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
              <!-- {{ serviceProvider.name + " - " + type }} -->
              <n-link :to="{name: 'create-order' }">
                <button class="btn btn-outline-light float-left">
                  {{ $t('add_new') }}
                </button>
              </n-link>
            </h3>
          </div>
          <!-- /.card-header -->

          <!-- form start -->
          <form role="form" @submit.prevent="update()">
            <div class="card-body">
              <!-- User Name -->
              <div class="form-group">
                <label for="balance">{{ $t('user') }} : </label>
                <code>
                  {{ order.user.name }} <br>
                </code>
              </div>

              <!-- Services -->
              <div class="form-group">
                <label for="balance">{{ $t('type') }} : </label>
                <code>
                  {{ order.type }}
                </code>
              </div>

              <!-- Services -->
              <div class="form-group">
                <label for="balance">{{ $t('services') }} : </label>
                <code v-for="service in order.services" :key="service.id">
                  {{ service.service.title }} |
                </code>
              </div>

              <!-- Status -->
              <div class="form-group">
                <label for="balance">{{ $t('status') }} : </label>
                <code>
                  {{ order.status.string }} <br>
                </code>
              </div>

              <!-- Service Provider -->
              <div class="form-group">
                <label for="balance">{{ $t('service_provider') }} : </label>
                <code>
                  {{ order.service_provider ? order.service_provider.name : $t('not_assigned') }} <br>
                </code>
              </div>

              <!-- Address -->
              <div class="form-group">
                <label for="balance">{{ $t('address') }} : </label>
                <code id="address">
                  {{ order.address }} <br>
                </code>
              </div>

              <!-- Form  -->
              <form @submit.prevent="update()">
                <!-- Service Provider -->
                <div class="form-group">
                  <label id="service-provider">Service Provider</label>
                  <v-select
                    v-model="form.service_provider_id"
                    :options="options"
                    :filterable="false"
                    :reduce="provider => provider.id"
                    @search="fetchOptions"
                  >
                    <template slot="option" slot-scope="option">
                      <div class="d-center">
                        {{ option.name }}
                      </div>
                    </template>
                    <template slot="selected-option" slot-scope="option">
                      <div class="selected d-center">
                        {{ option.name }}
                      </div>
                    </template>
                  </v-select>
                </div>

                <div class="form-group">
                  <LabelInputText v-model="order.prices.price_to_pay" :label="$t('price_to_pay')" :type="'number'" :name="'price_to_pay'" />
                </div>
                <div class="card-footer">
                  <v-button
                    :loading="form.busy"
                    type="success"
                  >
                    {{ $t('save') }}
                  </v-button>
                </div>
              </form>
              <!-- save -->
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
import Loading from '~/components/global/loading'

export default {
  middleware: 'auth',
  layout: 'admin',
  components: {
    LabelInputText,
    SelectBox,
    CheckBox,
    Loading
  },
  data: () => {
    return {
      serviceProviderTypes: [],
      order: {
        id: '',
        user: {},
        status: {},
        address: '',
        type: '',
        service: [],
        service_provider: {},
        prices: {}
      },
      options: [],
      form: new Form({
        service_provider_id: '',
        price_to_pay: ''
      })
    }
  },
  async mounted () {
    // this.fetchServiceProviderTypes()
    await this.fetchData()
  },
  methods: {
    async fetchData () {
      await this.$axios.$get('orders/' + this.$route.params.id)
        .then((res) => {
          // this.form.fill(res)
          this.order = res
        })
    },
    update () {
      this.form.put('/orders/' + this.$route.params.id, this.form)
        .then((res) => {
          console.log(res)
          this.order = res.data
          // this.form.fill(res.data)
          // this.order = res.data
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
        this.$axios.$get('service-providers', { params: { name: search } })
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
