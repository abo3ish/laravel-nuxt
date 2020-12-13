<template>
  <div>
    <header-info
      :name="'services'"
      :navigation="[{name:'home', link: 'dashboard'}, {name: 'services', link: ''}]"
    />

    <!-- Filter -->
    <section class="filter content">
      <form role="form" @submit.prevent="searchFilter()">
        <div class="row">
          <!-- Title -->
          <div class="col-2">
            <label-input-text v-model="filter.title" :label="$t('title')" :type="'text'" :placeholder="'Enter Name'" name="title" />
          </div>

          <!-- Service Provider Type -->
          <div class="col-2">
            <select-box v-model="filter.service_provider_type_id" :label="$t('service_provider_type')" :items="serviceProviderTypes" name="service_provider_type_id" />
          </div>

          <!-- Examination Type -->
          <div class="col-2">
            <select-box v-model="filter.examination_id" :label="$t('examination_type')" :items="examinations" name="examination_id" />
          </div>

          <!-- Status -->
          <div class="col-2">
            <select-box v-model="filter.status" :label="$t('status')" :items="statuses" name="examination_id" />
          </div>
        </div>
        <submit-button />
      </form>
    </section>
    <!-- Table -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div class="card card-primary">
              <div class="card-header">
                <n-link :to="{name: 'create-service' }">
                  <button class="btn btn-outline-light float-left">
                    {{ $t('add_new') }}
                  </button>
                </n-link>
              </div>
              <div class="card card-body">
                <b-table
                  :items="services"
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

                  <!-- Service Provider Type -->
                  <template v-slot:cell(service_provider_type)="data">
                    {{ data.item.service_provider_type.title }}
                  </template>

                  <!-- Examination -->
                  <template v-slot:cell(examination)="data">
                    <span>{{ data.item.examination.title }}</span>
                  </template>

                  <!-- Parent -->
                  <template v-slot:cell(parent)="data">
                    <span v-if="data.item.parent">{{ data.item.parent.title }}</span>
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

                  <!-- Actions -->
                  <template v-slot:cell(actions)="data">
                    <!-- Show -->
                    <b-button
                      :to="{ name: 'show-service', params: { id: data.item.id }}"
                      variant="info"
                      size="sm"
                    >
                      Show
                    </b-button>
                    <!-- Edit -->
                    <b-button
                      :to="{ name: 'edit-service', params: { id: data.item.id }}"
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
      title: this.$t('services')
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
        title: '',
        service_provider_type_id: '',
        examination_id: '',
        status: ''
      },

      statuses: [
        { id: 0, title: 'not_active' },
        { id: 1, title: 'active' }
      ],

      query: {},

      examinations: [],
      serviceProviderTypes: [],
      services: [],
      sortBy: 'id',
      sortDesc: false,
      fields: [
        { key: 'id', sortable: true },
        { key: 'title', sortable: true },
        { key: 'service_provider_type', sortable: true },
        { key: 'examination', sortable: true },
        { key: 'parent', sortable: true },
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
    this.fetchExaminations()
    this.fetchData()
  },
  methods: {
    async fetchData () {
      this.query.page = this.currentPage
      this.isBusy = true

      await this.$axios.$get('services', {
        params: this.query
      })
        .then((res) => {
          this.rows = res.pagination.total
          this.perPage = res.pagination.per_page
          this.currentPage = res.pagination.current_page
          this.services = res.data
          this.isBusy = false
        })

      this.$router.replace({ name: 'services',
        query: this.query }).catch(() => {})
    },
    fetchServiceProviderTypes () {
      this.$axios.$get('service-provider-types/all')
        .then((res) => {
          this.serviceProviderTypes = res
        })
    },
    fetchExaminations () {
      this.$axios.$get('examinations/all')
        .then((res) => {
          this.examinations = res
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
