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
                {{ $t('users') }}
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
                <n-link :to="{name: 'create-user' }">
                  <button class="btn btn-outline-light float-left">
                    {{ $t('add_new') }}
                  </button>
                </n-link>
              </div>
              <div class="card card-body">
                <b-table
                  :items="users"
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
                      {{ $moment(String(data.item.last_seen), "YYYY-MM-DD").format('LLLL') }}
                    </span>
                  </template>

                  <!-- Actions -->
                  <template v-slot:cell(actions)="data">
                    <!-- Show -->
                    <b-button
                      :to="{ name: 'show-user', params: { id: data.item.id }}"
                      variant="info"
                      size="sm"
                    >
                      Show
                    </b-button>
                    <!-- Edit -->
                    <b-button
                      :to="{ name: 'edit-user', params: { id: data.item.id }}"
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

export default {
  layout: 'admin',
  middleware: 'auth',
  head () {
    return {
      title: this.$t('users')
    }
  },
  components: {
    LabelInputText,
    SubmitButton
  },
  data () {
    return {
      users: [],

      isBusy: false,
      rows: 1,
      perPage: 0,
      currentPage: 1,

      filter: {
        name: '',
        age: '',
        email: '',
        phone: '',
        address: ''
      },

      query: {},

      sortBy: 'id',
      sortDesc: false,
      fields: [
        { key: 'id', sortable: true },
        { key: 'name', sortable: true },
        { key: 'email', sortable: true },
        { key: 'phone', sortable: true },
        { key: 'address', sortable: false },
        { key: 'social_provider', sortable: true },
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
    this.fetchData()
  },
  methods: {
    async fetchData () {
      this.query.page = this.currentPage
      this.isBusy = true

      await this.$axios.$get('users', {
        params: this.query
      })
        .then((res) => {
          this.rows = res.pagination.total
          this.perPage = res.pagination.per_page
          this.currentPage = res.pagination.current_page
          this.users = res.users
          this.isBusy = false
        })

      this.$router.replace({ name: 'users',
        query: this.query }).catch(() => {})
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
