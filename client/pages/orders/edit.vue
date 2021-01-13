<template>
  <div>
    <loading v-if="!order.id" />
    <header-info
      :name="'orders'"
      :navigation="[{name:'home', link: 'dashboard'}, {name: 'orders', link: 'orders'}, {name: '#' + order.uuid, link: '', trans: false}]"
    />

    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              <!-- {{ serviceProvider.name + " - " + type }} -->
              <n-link :to="{name: 'show-order' }">
                <button class="btn btn-outline-light float-left">
                  {{ $t('show') }}
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

              <!-- Order Items -->
              <div class="form-group">
                <label for="orders">{{ $t('orders') }} : </label>
                <!-- Serviecs -->
                <b-badge v-for="service in order.services" :key="service.id" pill variant="primary" class="p-2 m-2 w-30">
                  {{ service.title }}
                </b-badge>

                <!-- Drugs -->
                <b-badge v-for="drug in order.drugs" :key="drug.id" pill variant="info">
                  {{ drug.name }}
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
                <label for="area">{{ $t('area') }} : </label>
                <code id="area">
                  {{ order.address.area }}
                </code>
                ||
                <label for="street">{{ $t('street') }} : </label>
                <code id="street" dir="rtl">
                  {{ order.address.street }}
                </code>
                ||
                <label for="building_number">{{ $t('building_number') }} : </label>
                <code id="building_number">
                  {{ order.address.building_number }}
                </code>
                ||
                <label for="floor_number">{{ $t('floor_number') }} : </label>
                <code id="floor_number">
                  {{ order.address.floor_number }}
                </code>
                ||
                <label for="flat_number">{{ $t('flat_number') }} : </label>
                <code id="flat_number">
                  {{ order.address.flat_number }}
                </code>
                ||
                <a
                  :href="`https://www.google.com/maps/search/?api=1&query=${order.address.lat},${order.address.lat}`"
                  target="_blank"
                >
                  افتح علي الخريطة
                </a>
              </div>

              <!-- Form  -->
              <form @submit.prevent="update()">
                <!-- Service Provider -->
                <div class="form-group">
                  <label id="service-provider">{{ $t('service_provider') }}</label>
                  <v-select
                    v-model="form.service_provider_id"
                    :options="serviceProviderOptions"
                    :filterable="false"
                    :reduce="provider => provider.id"
                    label="name"
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
                    label="code"
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

                <!-- <div class="form-group">
                  <LabelInputText v-model="form.price_to_pay" :label="$t('price_to_pay')" :type="'number'" :name="'price_to_pay'" />
                </div> -->
                <div class="card-footer">
                  <v-button
                    :loading="form.busy"
                    type="success"
                  >
                    {{ $t('save') }}
                  </v-button>
                </div>
              </form>
              <!-- /.Form -->
            </div>
          </form>
        </div>

        <!-- Drugs -->
        <div v-if="order.type == 'pharmacy'" class="card card-primary">
          <div class="card card-header">
            <div class="card-title">
              Drugs
              <b-button
                v-b-modal.modal-center
                variant="primary"
                class="btn btn-outline-light float-left"
              >
                {{ $t('add_new') }}
              </b-button>
              <b-modal
                id="modal-center"
                ref="drug-order"
                size="lg"
                centered
                :state="nameState"
                title="منتج جديد"
                @hidden="resetModal"
              >
                <form ref="form" @submit.stop.prevent="handleDrugOrder(drugOrder.id)">
                  <!-- Drug-->
                  <div class="form-group">
                    <label id="drug">{{ $t('drug') }}</label>
                    <v-select
                      v-model="drugOrder.drug_id"
                      :options="drugOptions"
                      :filterable="false"
                      :reduce="drug => drug.id"
                      label="name"

                      @search="fetchDrugOptions"
                    >
                      <template #search="{attributes, events}">
                        <input
                          class="vs__search"
                          :required="!drugOrder.drug_id"
                          v-bind="attributes"
                          v-on="events"
                        >
                      </template>
                      <template #option="{ name, image, price }">
                        <div class="d-center">
                          {{ name }}
                          <img :src="image" height="70" width="70">
                          <strong>
                            / {{ price }} L.E
                          </strong>
                        </div>
                      </template>
                      <template #selected-option="{ name, image, price }">
                        <div class="selected d-center">
                          <strong>
                            {{ name }}
                          </strong>
                          <img :src="image" height="70" width="70">
                          <strong>
                            / {{ price }} L.E
                          </strong>
                        </div>
                      </template>
                    </v-select>
                  </div>
                  <!-- /.Drug -->

                  <!-- Quantity -->
                  <div class="form-group">
                    <LabelInputText
                      v-model="drugOrder.quantity"
                      :label="$t('quantity')"
                      :type="'number'"
                      :name="'quantity'"
                      :required="true"
                    />
                  </div>
                  <!-- /.Quantity -->
                </form>
                <template #modal-footer="{ cancel }">
                  <!-- Emulate built in modal footer ok and cancel button actions -->
                  <b-button v-if="!drugOrder.id" size="sm" variant="success" @click="handleDrugOrder()">
                    اضف
                  </b-button>
                  <b-button v-else size="sm" variant="success" @click="handleDrugOrder(drugOrder.id)">
                    عدل
                  </b-button>
                  <b-button size="sm" variant="danger" @click="cancel()">
                    اغلق
                  </b-button>
                </template>
              </b-modal>
            </div>
          </div>
          <div class="card card-body">
            <b-table :items="order.drugs" :fields="drugsFields" show-empty>
              <!-- Actions -->
              <template v-slot:cell(actions)="data">
                <!-- Show -->
                <b-button
                  v-b-modal.modal-center
                  variant="info"
                  size="sm"
                  @click="showDrugOrder(data.item.id)"
                >
                  {{ $t('edit') }}
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
        <!-- ./Drugs -->
      <!-- /.card -->
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import Form from 'vform'
import LabelInputText from '~/components/forms/LabelInputText'
import { deleteItem } from '~/utils'

export default {
  layout: 'admin',
  middleware: 'auth',
  head () {
    return {
      title: this.order.uuid
    }
  },
  components: {
    LabelInputText
  },
  data: () => {
    return {
      nameState: null,
      serviceProviderTypes: [],
      order: {
        id: '',
        uuid: '',
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
      drugOptions: [],
      statusOptions: [],
      form: new Form({
        service_provider_id: '',
        status: '',
        price_to_pay: ''
      }),
      drugsFields: [
        'name',
        'price_to_pay',
        'quantity',
        'actions'
      ],
      drugOrder: {
        id: '',
        name: '',
        price_to_pay: '',
        drug_id: '',
        quantity: ''
      }
    }
  },
  async mounted () {
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
      this.form.post('/orders/' + this.$route.params.id, this.form)
        .then((res) => {
          this.order = res.data
          this.fireSwal('success', this.$t('updated_successfully'))
        }).catch(() => {
          this.fireSwal('error', this.$t('something_wrong'))
        })
    },
    async fetchOrderStatuses () {
      await this.$axios.$get('order-statuses')
        .then((res) => {
          this.statusOptions = res
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
    async searchForServiceProviders (searchString = '', typeID = null, areaId = null) {
      await this.$axios.$get('service-providers', { params: { name: searchString } })
        .then((res) => {
          this.serviceProviderOptions = res.data
        })
    },

    fetchDrugOptions (search, loading) {
      if (search.length === 0) {
        return
      }
      loading(true)
      setTimeout(() => {
        this.searchForDrugs(search)
        loading(false)
      }, 300)
    },
    async searchForDrugs (searchString = '') {
      await this.$axios.$get('drugs', { params: { name: searchString } })
        .then((res) => {
          this.drugOptions = res.drugs
        })
    },

    resetModal () {
      this.drugOrder = {}
    },

    async StoreDrugOrder (el) {
      // el.preventDefault()

      this.drugOrder.order_id = this.order.id
      await this.$axios.$post('drug-order', this.drugOrder)
        .then((res) => {
          this.order.drugs.push(res)
        })
      this.fireSwal('success', this.$t('added_successfully'))
    },
    showDrugOrder (id) {
      const res = this.order.drugs.find(drugOrder => drugOrder.id === id)
      this.drugOrder = res
      this.$axios.$get(`drugs/${this.drugOrder.drug_id}`)
        .then((res) => {
          this.drugOptions.push(res)
        })
    },
    async updateDrugOrder (id) {
      await this.$axios.$post(`drug-order/${id}`, this.drugOrder)
        .then((res) => {
          Vue.set(this.order.drugs, this.order.drugs.findIndex(drugOrder => drugOrder.id === id), res)
        })
      this.fireSwal('success', this.$t('updated_successfully'))
    },
    handleDrugOrder (id = null) {
      if (!this.$refs.form.checkValidity()) {
        return
      }
      if (id) {
        this.updateDrugOrder(id)
      } else {
        this.StoreDrugOrder()
      }
      this.$refs['drug-order'].hide()
    },
    async deleteItem (id, event) {
      const endpoint = `drug-order/${id}/delete`
      const res = await deleteItem(endpoint)

      if (res === true) {
        const index = this.order.drugs.findIndex(element => element.id === id)
        this.order.drugs.splice(index, 1)
        this.fireSwal('success', this.$t('deleted_successfully'))
      }

      // await this.$axios.$delete(`drug-order/${id}`)
      //   .then((res) => {
      //     if (res) {
      //       Vue.delete(this.order.drugs, this.order.drugs.findIndex(drugOrder => drugOrder.id === id))
      //     }
      //   })
      // this.$notify({
      //   group: 'feedback',
      //   title: this.$t('drug_deleted_successfully'),
      //   type: 'success'
      // })
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
