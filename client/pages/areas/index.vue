<template>
  <div>
    <header-info
      :name="'areas'"
      :navigation="[{name:'home', link: 'dashboard'}, {name: 'areas', link: ''}]"
    />

    <!-- Filter -->
    <section class="filter content">
      <form role="form" @submit.prevent="searchFilter()">
        <div class="row">
          <!-- Status -->
          <div class="col-2">
            <select-box v-model="filter.status" :items="statuses" :label="$t('status')" name="status" />
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
                <n-link :to="{name: 'create-area' }">
                  <button class="btn btn-outline-light float-left">
                    {{ $t('add_new') }}
                  </button>
                </n-link>
              </div>
              <div class="card card-body">
                <b-table
                  :items="areas"
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
                      :to="{ name: 'show-area', params: { id: data.item.id }}"
                      variant="info"
                      size="sm"
                    >
                      Show
                    </b-button>
                    <!-- Edit -->
                    <b-button
                      :to="{ name: 'edit-area', params: { id: data.item.id }}"
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

    <div class="card card-primary">
      <div class="card-header">
        <!-- {{ $('service_providers') }} -->
      </div>
    </div>
  </div>
</template>

<script>
import SelectBox from '~/components/forms/SelectBox'
import { deleteItem } from '~/utils'
import SubmitButton from '~/components/forms/SubmitButton'

export default {
  layout: 'admin',
  middleware: 'auth',
  head () {
    return {
      title: this.$t('areas')
    }
  },
  components: {
    SelectBox,
    SubmitButton
  },

  data () {
    return {
      areas: [],
      statuses: [
        { id: 1, title: 'مفعل' },
        { id: 0, title: 'غير مفعل' }
      ],
      isBusy: false,
      rows: 1,
      perPage: 0,
      currentPage: 1,

      sortBy: 'id',
      sortDesc: false,
      fields: [
        { key: 'id', sortable: true },
        { key: 'name', sortable: true },
        { key: 'status', sortable: true },
        { key: 'actions', sortable: false }
      ],
      filter: {
        status: ''
      },

      query: {}
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
    this.fetchData()
  },
  methods: {
    async fetchData () {
      this.query.page = this.currentPage
      this.isBusy = true

      await this.$axios.$get('areas', {
        params: this.query
      })
        .then((res) => {
          this.rows = res.pagination.total
          this.perPage = res.pagination.per_page
          this.currentPage = res.pagination.current_page
          this.areas = res.areas
          this.isBusy = false
        })
      this.$router.replace({ name: 'areas',
        query: this.query }).catch(() => {})
    },
    async deleteAction (id, event) {
      const endpoint = `areas/${id}/delete`
      const res = await deleteItem(endpoint)

      if (res === true) {
        const index = this.areas.findIndex(element => element.id === id)
        this.areas.splice(index, 1)
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
