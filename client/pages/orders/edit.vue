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

              <!-- Order Type -->
              <div class="form-group">
                <label for="balance">{{ $t('type') }} : </label>
                <code>
                  {{ order.type }}
                </code>
              </div>

              <!-- Order Type -->
              <div class="form-group">
                <label for="balance">{{ $t('orders') }} : </label>
                <!-- Serviecs -->
                <b-badge v-for="service in order.services" :key="service.id" pill variant="primary" class="p-2 m-2 w-30">
                  {{ service.title }}
                </b-badge>

                <!-- Drugs -->
                <b-badge v-for="drug in order.drugs" :key="drug.id" pill variant="info">
                  {{ drug.title }}
                </b-badge>
              </div>

              <!-- Status -->
              <div class="form-group">
                <label for="balance">{{ $t('status') }} : </label>
                <code>
                  {{ order.status.string }} <br>
                </code>
              </div>

              <!-- Service Provider Type-->
              <div class="form-group">
                <label for="balance">{{ $t('service_provider_type') }} : </label>
                <code>
                  {{ order.service_provider_type.title }} <br>
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

              <!-- Area -->
              <div class="form-group">
                <label for="balance">{{ $t('area') }} : </label>
                <code id="area">
                  {{ order.area.name }} <br>
                </code>
              </div>

              <!-- Form  -->
              <form @submit.prevent="update()">
                <!-- Service Provider -->
                <div class="form-group">
                  <label id="service-provider">Service Provider</label>
                  <v-select
                    v-model="form.service_provider_id"
                    :options="serviceProviderOptions"
                    :filterable="false"
                    :reduce="provider => provider.id"
                    @search="fetchServiceProviderOptions"
                  >
                    <template #option="{ name }">
                      <div class="d-center">
                        {{ name }}
                        <img src="https://via.placeholder.com/40/40">
                      </div>
                    </template>
                    <template #selected-option="{ name }">
                      <div class="selected d-center">
                        <strong>
                          {{ name }}
                        </strong>
                        <img src="https://via.placeholder.com/40/40">

                        <span />
                      </div>
                    </template>
                  </v-select>
                </div>
                <!-- /.Service Provider -->

                <!-- Order Status -->
                <div class="form-group">
                  <label id="status">{{ $t('status') }}</label>
                  <v-select
                    v-model="form.status"
                    :options="statusOptions"
                    :filterable="false"
                    :reduce="status => status.code"
                  >
                    <template #option="{ string }">
                      <div class="d-center">
                        {{ string }}
                      </div>
                    </template>
                    <template #selected-option="{ string }">
                      <div class="selected d-center">
                        <strong>
                          {{ string }}
                        </strong>
                        <span />
                      </div>
                    </template>
                  </v-select>
                </div>
                <!-- /.Order Status -->

                <div class="form-group">
                  <LabelInputText v-model="form.price_to_pay" :label="$t('price_to_pay')" :type="'number'" :name="'price_to_pay'" />
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
        area: {},
        address: '',
        type: '',
        services: [],
        drugs: [],
        service_provider: {},
        service_provider_type: {},
        prices: {}
      },
      serviceProviderOptions: [],
      statusOptions: [],
      form: new Form({
        service_provider_id: '',
        status: '',
        price_to_pay: ''
      })
    }
  },
  async mounted () {
    // this.fetchServiceProviderTypes()
    await this.fetchData()
    this.fetchOrderStatuses()
  },
  methods: {
    async fetchData () {
      await this.$axios.$get('orders/' + this.$route.params.id)
        .then((res) => {
          this.form.service_provider_id = res.service_provider ? res.service_provider.id : null
          this.form.price_to_pay = res.prices.price_to_pay
          this.form.status = res.status.code
          this.order = res

          this.statusOptions.push(res.status)

          if (res.service_provider) {
            this.serviceProviderOptions.push(res.service_provider)
          } else {
            this.searchForServiceProviders('', this.order.service_provider_type.id, this.order.area.id)
          }
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
    fetchServiceProviderOptions (search, loading) {
      if (search.length === 0) {
        return
      }
      loading(true)
      setTimeout(() => {
        this.searchForServiceProviders(search, this.order.service_provider_type.id, this.order.area.id)
        loading(false)
      }, 300)
    },
    async fetchOrderStatuses () {
      await this.$axios.$get('order-statuses')
        .then((res) => {
          this.statusOptions = res
        })
    },
    async searchForServiceProviders (searchString = '', typeID = null, areaId = null) {
      await this.$axios.$get('service-providers', { params: { name: searchString, type_id: typeID, area_id: areaId } })
        .then((res) => {
          this.serviceProviderOptions = res.data
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
