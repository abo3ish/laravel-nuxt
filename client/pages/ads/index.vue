<template>
  <div>
    <header-info
      :name="'ads'"
      :navigation="[{name:'home', link: 'dashboard'}, {name: 'ads', link: ''}]"
    />

    <!-- Filter -->
    <section class="filter content">
      <form role="form" @submit.prevent="searchFilter()">
        <div class="row">
          <!-- Slug -->
          <div class="col-2">
            <label-input-text v-model="filter.slug" :label="$t('slug')" :type="'text'" :placeholder="'Enter Slug'" name="slug" />
          </div>
          <!-- Position -->
          <div class="col-2">
            <select-box v-model="filter.position" :items="positions" :label="$t('position')" name="position" />
          </div>

          <!-- Status -->
          <div class="col-2">
            <select-box v-model="filter.status" :items="statuses" :label="$t('status')" name="status" />
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
                <n-link :to="{name: 'create-ad' }">
                  <button class="btn btn-outline-light float-left">
                    {{ $t('add_new') }}
                  </button>
                </n-link>
              </div>
              <div class="card card-body">
                <b-table
                  :items="ads"
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

                  <!-- Image -->
                  <template v-slot:cell(image)="data">
                    <b-img-lazy :src="data.item.image" height="200px" width="200px" />
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
                      :to="{ name: 'show-ad', params: { id: data.item.id }}"
                      variant="info"
                      size="sm"
                    >
                      Show
                    </b-button>
                    <!-- Edit -->
                    <b-button
                      :to="{ name: 'edit-ad', params: { id: data.item.id }}"
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
      title: this.$t('ads')
    }
  },
  components: {
    LabelInputText,
    SubmitButton,
    SelectBox
  },
  data () {
    return {
      ads: [],
      positions: [
        'full',
        'top',
        'bottom'
      ],
      statuses: [
        { id: 1, title: 'مفعل' },
        { id: 0, title: 'غير مفعل' }
      ],
      isBusy: false,
      rows: 1,
      perPage: 0,
      currentPage: 1,

      filter: {
        slug: '',
        status: ''
      },

      query: {},

      sortBy: 'id',
      sortDesc: false,
      fields: [
        { key: 'id', sortable: true },
        { key: 'slug', sortable: true },
        { key: 'position', sortable: true },
        { key: 'image', sortable: true },
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

      await this.$axios.$get('advertisements', {
        params: this.query
      })
        .then((res) => {
          this.rows = res.pagination.total
          this.perPage = res.pagination.per_page
          this.currentPage = res.pagination.current_page
          this.ads = res.ads
          this.isBusy = false
        })

      this.$router.replace({ name: 'ads',
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
