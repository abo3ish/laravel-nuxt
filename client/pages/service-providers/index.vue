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
          <!-- Name -->
          <div class="col-2">
            <label-input-text v-model="filter.name" :label="$t('name')" :type="'text'" :placeholder="'Enter Name'" name="name" />
          </div>
          <!-- Phone -->
          <div class="col-2">
            <label-input-text v-model="filter.phone" :label="$t('phone')" :type="'text'" :placeholder="'Enter phone'" name="phone" />
          </div>
          <!-- Email -->
          <div class="col-2">
            <label-input-text v-model="filter.email" :label="$t('email')" :type="'email'" :placeholder="'Enter email'" name="email" />
          </div>
          <!-- Address -->
          <div class="col-2">
            <label-input-text v-model="filter.address" :label="$t('address')" :type="'text'" :placeholder="'Enter address'" name="address" />
          </div>
          <!-- Type -->
          <div class="col-2">
            <select-box v-model="filter.type_id" :label="$t('service_provider_type')" :items="serviceProviderTypes" name="type_id" />
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
                  <!-- Spinner -->
                  <template v-slot:table-busy>
                    <div class="text-center text-primary my-2">
                      <b-spinner variant="primary" class="align-middle" />
                      <strong>...تحميل</strong>
                    </div>
                  </template>
                  <!-- Type -->
                  <template v-slot:cell(type)="data">
                    <span>{{ data.item.type.title }}</span>
                  </template>

                  <!-- Status -->
                  <template v-slot:cell(status)="data">
                    <b-badge v-if="data.item.status" variant="success">
                      {{ $t('activated') }}
                    </b-badge>
                    <b-badge v-else variant="danger">
                      {{ $t('not_activated') }}
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
                      :to="{ name: 'show-service-provider', params: { id: data.item.id }}"
                      variant="info"
                      size="sm"
                    >
                      Show
                    </b-button>
                    <!-- Edit -->
                    <b-button
                      :to="{ name: 'edit-service-provider', params: { id: data.item.id }}"
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
  layout: 'admin',
  middleware: 'auth',
  head () {
    return {
      title: this.$t('service_providers')
    }
  },
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
      sortDesc: false,
      fields: [
        { key: 'id', sortable: true },
        // { key: 'first_name', sortable: true },
        // { key: 'last_name', sortable: true }
        { key: 'name', sortable: true },
        { key: 'type', sortable: true },
        { key: 'phone', sortable: true },
        { key: 'address', sortable: false },
        { key: 'last_seen', sortable: true },
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
    this.fetchServiceProviderTypes()
    this.fetchData()
  },
  methods: {
    async fetchData () {
      this.query.page = this.currentPage
      this.isBusy = true

      await this.$axios.$get('service-providers', {
        params: this.query
      })
        .then((res) => {
          this.rows = res.pagination.total
          this.perPage = res.pagination.per_page
          this.currentPage = res.pagination.current_page
          this.serviceProviders = res.data
          this.isBusy = false
        })

      this.$router.replace({ name: 'service-providers',
        query: this.query }).catch(() => {})
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
