<template>
  <div>
    <header-info
      :name="'orders'"
      :navigation="[{name:'home', link: 'dashboard'}, {name: 'orders', link: ''}]"
    />

    <!-- Filter -->
    <section class="filter content">
      <form role="form" @submit.prevent="searchFilter()">
        <div class="row">
          <div class="col-2">
            <label-input-text v-model="filter.uuid" :label="$t('order_uuid')" :type="'number'" :placeholder="'Enter UUID'" name="uuid" />
          </div>

          <!-- Users -->
          <div class="col-2">
            <label id="users">{{ $t('user') }}</label>
            <v-select
              v-model="filter.user_id"
              dir="rtl"
              :options="userOptions"
              :filterable="false"
              :reduce="user => user.id"
              label="name"
              :placeholder="'ابحث باسم المستخدم او رقم الهاتف'"
              @search="fetchUserOptions"
            >
              <template #option="{ name }">
                <div class="d-center">
                  {{ name }}
                </div>
              </template>
              <template #selected-option="{ name }">
                <div class="selected d-center">
                  <strong>
                    {{
                      userOptions.find(user => user.id == filter.user_id) ?
                        userOptions.find(user => user.id == filter.user_id).name
                        : name
                    }}
                  </strong>
                </div>
              </template>
            </v-select>
          </div>
          <!-- Service Provider Type -->
          <div class="col-2">
            <label>{{ $t('service_provider_type') }}</label>
            <v-select
              v-model="filter.service_provider_type_id"
              dir="rtl"
              :options="serviceProviderTypes"
              :reduce="serviceProviderType => serviceProviderType.id"
              label="title"
              :placeholder="$t('select') + ' ' + $t('service_provider')"
            >
              <template #selected-option="{ title }">
                <div class="d-center">
                  {{
                    serviceProviderTypes.find(serviceProviderType => serviceProviderType.id == filter.service_provider_type_id) ?
                      serviceProviderTypes.find(serviceProviderType => serviceProviderType.id == filter.service_provider_type_id).title
                      : title
                  }}
                </div>
              </template>
            </v-select>
          </div>

          <!-- Area -->
          <div class="col-2">
            <label>{{ $t('area') }}</label>

            <!-- <b-form-select
              v-model="filter.area_id"
              :options="areas"
              value-field="id"
              text-field="name"
              class="form-select"
            >
              <b-form-select-option :value="''">
                Please select an option
              </b-form-select-option>
            </b-form-select> -->

            <v-select
              v-model="filter.area_id"
              dir="rtl"
              :options="areas"
              :reduce="area => area.id"
              label="name"
              :placeholder="$t('select') + ' ' + $t('area')"
            >
              <template #selected-option="{ name }">
                <div class="d-center">
                  {{
                    areas.find(area => area.id == filter.area_id) ?
                      areas.find(area => area.id == filter.area_id).name
                      : name
                  }}
                </div>
              </template>
            </v-select>
          </div>

          <!-- Status -->
          <div class="col-2">
            <label>{{ $t('status') }}</label>
            <v-select
              v-model="filter.status"
              dir="rtl"
              :options="orderStatuses"
              :reduce="status => status.id"
              label="title"
              :placeholder="$t('select') + ' ' + $t('status')"
            />
          </div>
        </div>
        <submit-button />
      </form>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div class="card card-primary">
              <div class="card-header">
                <n-link :to="{name: 'create-service-provider' }">
                  <button class="btn btn-outline-light float-left">
                    {{ $t('add_new') }}
                  </button>
                </n-link>
              </div>
              <div class="card card-body">
                <b-table
                  :items="orders"
                  :busy.sync="isBusy"
                  :fields="fields"
                  :sort-by.sync="sortBy"
                  :sort-desc.sync="sortDesc"
                  per-page="0"
                  :current-page="currentPage"
                  responsive="sm"
                  hover
                  striped
                  show-empty
                  stacked="md"
                >
                  <template v-slot:table-busy>
                    <div class="text-center text-primary my-2">
                      <b-spinner variant="primary" class="align-middle" />
                      <strong>تحميل...</strong>
                    </div>
                  </template>
                  <!-- user -->
                  <template v-slot:cell(user)="data">
                    <span>{{ data.item.user.name }}</span>
                  </template>

                  <!-- Type -->
                  <template v-slot:cell(type)="data">
                    <span>{{ data.item.type }}</span>
                  </template>

                  <!-- Order items -->
                  <template v-slot:cell(services)="data">
                    <span>{{ data.item.items }}</span>
                  </template>

                  <!-- Service Provider -->
                  <template v-slot:cell(service_provider)="data">
                    <span v-if="data.item.service_provider">{{ data.item.service_provider.name }}</span>
                  </template>

                  <!-- Status -->
                  <template v-slot:cell(status)="data">
                    <b-badge v-if="data.item.status.code == 1" variant="warning">
                      {{ data.item.status.string }}
                    </b-badge>
                    <b-badge v-if="data.item.status.code == 2" variant="primary">
                      {{ data.item.status.string }}
                    </b-badge>
                    <b-badge v-else-if="data.item.status.code == 3" variant="secondary">
                      {{ data.item.status.string }}
                    </b-badge>
                    <b-badge v-else-if="data.item.status.code == 4" variant="success">
                      {{ data.item.status.string }}
                    </b-badge>
                  </template>

                  <!-- Created At -->
                  <template v-slot:cell(created_at)="data">
                    <span v-if="data.item.created_at">
                      {{ $moment(String(data.item.created_at), "YYYY-MM-DD hh:mm:ss").format('LLLL') }}
                    </span>
                  </template>

                  <!-- Actions -->
                  <template v-slot:cell(actions)="data">
                    <!-- Show -->
                    <b-button
                      :to="{ name: 'show-order', params: { id: data.item.id }}"
                      variant="info"
                      size="sm"
                    >
                      Show
                    </b-button>
                    <!-- Edit -->
                    <b-button
                      :to="{ name: 'edit-order', params: { id: data.item.id }}"
                      variant="secondary"
                      size="sm"
                    >
                      Edit
                    </b-button>
                    <!-- Delete -->
                    <!-- <b-button
                      variant="danger"
                      size="sm"
                      @click.stop.prevent="deleteItem(data.item.id, $event)"
                    >
                      Delete
                    </b-button> -->
                  </template>
                </b-table>
              </div>
            </div>

            <b-pagination
              v-model="currentPage"
              :total-rows="rows"
              :per-page="perPage"
            />
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
</template>

<script>
import LabelInputText from '~/components/forms/LabelInputText'
import SubmitButton from '~/components/forms/SubmitButton'

export default {
  name: 'Orders',
  layout: 'admin',
  middleware: 'auth',
  head () {
    return {
      title: this.$t('orders')
    }
  },
  components: {
    LabelInputText,
    SubmitButton
  },
  data () {
    return {
      isBusy: false,
      sortBy: 'id',
      rows: 1,
      perPage: 0,
      currentPage: 1,
      sortDesc: true,
      fields: [
        { key: 'uuid', sortable: true },
        { key: 'user', sortable: true },
        { key: 'area', sortable: true },
        { key: 'type', sortable: true },
        { key: 'items', sortable: true },
        { key: 'service_provider_type', sortable: true },
        { key: 'service_provider', sortable: true },
        { key: 'status', sortable: true },
        { key: 'created_at', sortable: true },
        { key: 'actions', sortable: false }
      ],

      query: {},
      filter: {
        uuid: '',
        service_provider_type_id: '',
        area_id: '',
        status: '',
        service_provider_id: '',
        user_id: ''
      },
      orders: [],
      serviceProviderTypes: [],
      areas: [],
      userOptions: [],
      orderStatuses: [
        { id: '1', title: 'تحت المراجعة' },
        { id: '2', title: 'تم الموافقة' },
        { id: '3', title: 'الطلب في الطريق' },
        { id: '4', title: 'تم التوصيل' }
      ],
      selectedArea: {
        id: '2',
        name: 'Matrouh'
      }

    }
  },
  watch: {
    currentPage: {
      handler (value) {
        this.query.page = this.currentPage
        this.fetchData()
      }
    }
  },
  created () {
    this.fetchAreas()
    this.fetchServiceProviderTypes()
    this.fetchData()
  },
  mounted () {
  },
  methods: {
    async fetchData () {
      if (!this.query.page) {
        if (!this.$route.query.page) {
          this.query.page = this.currentPage
        } else {
          this.query.page = this.$route.query.page
        }
      }
      await this.serializeRouterQuery()
      if (this.filter.user_id) {
        this.searchForUsers({ user_id: this.filter.user_id })
        // await this.searchForUsers(this.filter.user_id, 'user_id')
      }
      this.callApi()
    },
    async callApi () {
      this.isBusy = true
      await this.$axios.$get('orders', {
        params: this.query
      })
        .then((res) => {
          this.rows = res.pagination.total
          this.perPage = res.pagination.per_page
          this.currentPage = res.pagination.current_page
          this.orders = res.orders
        })
      this.isBusy = false

      this.$router.push({
        name: 'orders',
        query: this.query
      }).catch(() => {})
    },
    getStatuses () {
      this.$axios.$get('order-statuses').then((res) => {
        // this.orderStatuses = res
      })
    },
    fetchServiceProviderTypes () {
      this.$axios.$get('service-provider-types/all')
        .then((res) => {
          this.serviceProviderTypes = res
        })
    },
    async fetchAreas () {
      await this.$axios.$get('areas/all')
        .then((res) => {
          this.areas = res
        })
    },
    deleteItem (id, event) {
      event.preventDefault()
      alert(id)
    },
    async searchFilter () {
      this.currentPage = 1
      await this.serializeFilter()
      this.callApi()
    },
    serializeFilter () {
      for (const key in this.filter) {
        this.query[key] = this.filter[key]
      }
    },
    serializeRouterQuery () {
      for (const key in this.$route.query) {
        if (this.filter.hasOwnProperty(key) && this.$route.query[key]) {
          this.query[key] = this.filter[key] = this.$route.query[key]
        }
      }
    },
    listenToNewOrder () {
      this.$echo.channel('new-order')
        .listen('NewOrder', (e) => {
          this.orders.push(e)
        })
    },
    fetchUserOptions (search, loading) {
      if (search.length === 0) {
        return
      }
      loading(true)
      setTimeout(() => {
        this.searchForUsers({ identifier: search })
        loading(false)
      }, 300)
    },
    async searchForUsers (searchParams) {
      await this.$axios.$get('users', {
        params: searchParams
      })
        .then((res) => {
          this.userOptions = res.users
        })
    }
  }
}
</script>

<style>
.form-select option{
  background-color: beige;
}
</style>
