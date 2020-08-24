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
            <label-input-text v-model="filter.name" :label="$t('name')" :type="'text'" :placeholder="'Enter Name'" name="name" />
          </div>
          <div class="col-2">
            <label-input-text v-model="filter.phone" :label="$t('phone')" :type="'text'" :placeholder="'Enter phone'" name="phone" />
          </div>
          <div class="col-2">
            <label-input-text v-model="filter.email" :label="$t('email')" :type="'email'" :placeholder="'Enter email'" name="email" />
          </div>
          <div class="col-2">
            <label-input-text v-model="filter.address" :label="$t('address')" :type="'text'" :placeholder="'Enter address'" name="address" />
          </div>
          <div class="col-2">
            <select-box v-model="filter.type_id" :label="$t('service_provider_type')" :items="serviceProviderTypes" name="type_id" />
          </div>
          <div class="col-2">
            <b-button
              type="submit"
              variant="warning"
            >
              {{ $t('search') }}
            </b-button>
          </div>
        </div>
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
                  :items="serviceProviders"
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
                    <span>{{ data.item.services }}</span>
                  </template>

                  <!-- Service Provider -->
                  <template v-slot:cell(service_provider)="data">
                    <span v-if="data.item.service_provider">{{ data.item.service_provider.name }}</span>
                  </template>

                  <!-- Status -->
                  <template v-slot:cell(status)="data">
                    <b-badge v-if="data.item.status.code == 0" variant="warning">
                      {{ data.item.status.string }}
                    </b-badge>
                    <b-badge v-if="data.item.status.code == 1" variant="primary">
                      {{ data.item.status.string }}
                    </b-badge>
                    <b-badge v-else-if="data.item.status.code == 2" variant="secondary">
                      {{ data.item.status.string }}
                    </b-badge>
                    <b-badge v-else-if="data.item.status.code == 3" variant="success">
                      {{ data.item.status.string }}
                    </b-badge>
                  </template>

                  <!-- Last Seen -->
                  <template v-slot:cell(last_seen)="data">
                    <span v-if="data.item.last_seen">
                      {{ $moment(String(data.item.last_seen)).format('LLLL') }}
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
import SelectBox from '~/components/forms/SelectBox'

export default {
  layout: 'admin',
  middleware: 'auth',
  components: {
    LabelInputText,
    SelectBox
  },
  data () {
    return {
      isBusy: false,
      rows: 1,
      perPage: 0,
      currentPage: 1,

      filter: {
        name: '',
        age: '',
        email: '',
        phone: '',
        address: '',
        type_id: ''
      },

      query: {},

      serviceProviders: [],
      serviceProviderTypes: [],
      sortBy: 'id',
      sortDesc: true,
      fields: [
        { key: 'id', sortable: true },
        { key: 'user', sortable: true },
        { key: 'address', sortable: false },
        { key: 'type', sortable: true },
        { key: 'services', sortable: true },
        { key: 'service_provider', sortable: false },
        { key: 'status', sortable: true },
        { key: 'actions', sortable: false }
      ]
    }
  },
  watch: {
    currentPage: {
      handler (value) {
        this.fetchData()
      }
    }
  },
  mounted () {
    this.$echo.channel('new-order')
      .listen('NewOrder', (e) => {
        console.log(e)
        this.serviceProviders.push(e)
      })

    this.fetchData().catch((error) => {
      console.log(error)
    })
  },
  methods: {
    async fetchData () {
      this.query.page = this.currentPage

      this.isBusy = true
      await this.$axios.$get('orders', {
        params: this.query
      })
        .then((res) => {
          this.rows = res.meta.total
          this.perPage = res.meta.per_page
          this.currentPage = res.meta.current_page
          this.serviceProviders = res.data
          this.isBusy = false
        })

      this.$router.push({ name: 'orders',
        query: this.query }).catch((err) => {})
    },
    deleteItem (id, event) {
      event.preventDefault()
      alert(id)
    },
    searchFilter () {
      this.currentPage = 1
      this.serializeFilter(this.filter, this.query)

      this.fetchData()
    },
    serializeFilter (filter, query) {
      for (const key in filter) {
        query[key] = filter[key]
      }
    }
  }
}
</script>

<style>

</style>
