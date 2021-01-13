<template>
  <div>
    <header-info
      :name="'service_providers'"
      :navigation="[{name:'home', link: 'dashboard'}, {name: 'service_providers', link: ''}]"
    />

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
          <div class="col-2">
            <label>{{ $t('area') }}</label>
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

          <!-- Type -->
          <div class="col-2">
            <label>{{ $t('service_provider_type') }}</label>
            <v-select
              v-model="filter.type_id"
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

                  <!-- Area -->
                  <template v-slot:cell(area)="data">
                    <span>{{ data.item.area.name }}</span>
                  </template>

                  <!-- Type -->
                  <template v-slot:cell(type)="data">
                    <span>{{ data.item.type ? data.item.type.title : 'deleted' }}</span>
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
                      @click.stop.prevent="deleteAction(data.item.id, $event)"
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
  </div>
</template>

<script>
// import Form from 'vform'
import LabelInputText from '~/components/forms/LabelInputText'
import SubmitButton from '~/components/forms/SubmitButton'
import SelectBox from '~/components/forms/SelectBox'
import { deleteItem } from '~/utils'

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
        type_id: '',
        area_id: ''
      },

      query: {},

      areas: [],
      serviceProviders: [],
      serviceProviderTypes: [],
      sortBy: 'id',
      sortDesc: false,
      fields: [
        { key: 'id', sortable: true },
        { key: 'name', sortable: true },
        { key: 'area', sortable: true },
        { key: 'type', sortable: true },
        { key: 'phone', sortable: true },
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
    this.fetchAreas()
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
    async fetchAreas () {
      await this.$axios.$get('areas/all')
        .then((res) => {
          this.areas = res
        })
    },
    async deleteAction (id, event) {
      const endpoint = `service-providers/${id}/delete`
      const res = await deleteItem(endpoint)

      if (res === true) {
        const index = this.serviceProviders.findIndex(element => element.id === id)
        this.serviceProviders.splice(index, 1)
      }
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
