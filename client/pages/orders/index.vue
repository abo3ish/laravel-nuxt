<template>
  <div>
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
                {{ $t('service_providers') }}
              </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="filter content">
      <form role="form" @submit.prevent="searchFilter()">
        <div class="row">
          <div class="col-2">
            <label-input-text v-model="filter.uuid" :label="$t('order_uuid')" :type="'number'" :placeholder="'Enter UUID'" name="uuid" />
          </div>
          <div class="col-2">
            <select-box v-model="filter.service_provider_type_id" :label="$t('service_provider_type')" :items="serviceProviderTypes" name="service_provider_type_id" />
          </div>
          <div class="col-2">
            <select-box v-model="filter.status" :label="$t('order_status')" :items="orderStatuses" name="status" />
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

                  <!-- Address -->
                  <template v-slot:cell(address)="data">
                    <span>{{ data.item.address }}</span>
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

                  <!-- Last Seen -->
                  <template v-slot:cell(created_at)="data">
                    <span v-if="data.item.created_at">
                      {{ $moment(String(data.item.created_at)).format('LLLL') }}
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

    <div class="card card-primary">
      <div class="card-header">
        <!-- {{ $('service_providers') }} -->
      </div>
    </div>
  </div>
</template>

<script>
// import Form from 'vform'
import LabelInputText from '~/components/forms/LabelInputText'
import SubmitButton from '~/components/forms/SubmitButton'
import SelectBox from '~/components/forms/SelectBox'

export default {
  name: 'Orders',
  layout: 'admin',
  middleware: 'auth',
  components: {
    LabelInputText,
    SubmitButton,
    SelectBox
  },
  data () {
    return {
      isBusy: false,
      rows: 1,
      perPage: 0,
      currentPage: 1,

      filter: {
        uuid: '',
        service_provider_type_id: '',
        status: '',
        service_provider_id: '',
        user_id: ''
      },

      query: {},

      orders: [],
      serviceProviderTypes: [],
      orderStatuses: [
        { id: '1', title: 'تحت المراجعة' },
        { id: '2', title: 'تم الموافقة' },
        { id: '3', title: 'الطلب في الطريق' },
        { id: '4', title: 'تم التوصيل' }
      ],

      sortBy: 'id',
      sortDesc: true,
      fields: [
        { key: 'uuid', sortable: true },
        { key: 'user', sortable: true },
        { key: 'address', sortable: false },
        { key: 'type', sortable: true },
        { key: 'items', sortable: true },
        { key: 'service_provider_type', sortable: true },
        { key: 'service_provider', sortable: true },
        { key: 'status', sortable: true },
        { key: 'created_at', sortable: true },
        { key: 'actions', sortable: false }
      ]
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
  async mounted () {
    await this.fetchServiceProviderTypes()
    await this.fetchData().catch((err) => {
      console.log(err)
    })
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
    }
  }
}
</script>
