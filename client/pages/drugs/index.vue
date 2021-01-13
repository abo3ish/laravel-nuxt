<template>
  <div>
    <header-info
      :name="'drugs'"
      :navigation="[{name:'home', link: 'dashboard'}, {name: 'drugs', link: ''}]"
    />

    <section class="filter content">
      <form role="form" @submit.prevent="searchFilter()">
        <div class="row">
          <!-- Name -->
          <div class="col-2">
            <label-input-text v-model="filter.name" :label="$t('name')" :type="'text'" :placeholder="'Enter Name'" name="name" />
          </div>

          <!-- Scientific Name -->
          <div class="col-2">
            <label-input-text v-model="filter.scientific_name" :label="$t('scientific_name')" :type="'text'" :placeholder="'Enter Scientific Name'" name="scientific_name" />
          </div>

          <!-- Category -->
          <div class="col-2">
            <select-box v-model="filter.category_id" :label="$t('category')" :items="categories" name="category_id" />
          </div>

          <!-- Price -->
          <div class="col-2">
            <label-input-text v-model="filter.price" :label="$t('price')" :type="'number'" :placeholder="'Enter Price'" name="name" />
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
                <n-link :to="{name: 'create-drug' }">
                  <button class="btn btn-outline-light float-left">
                    {{ $t('add_new') }}
                  </button>
                </n-link>
              </div>
              <div class="card card-body">
                <b-table
                  :items="drugs"
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
                  <template v-slot:cell(category)="data">
                    <span>{{ data.item.category.title }}</span>
                  </template>

                  <!-- Actions -->
                  <template v-slot:cell(actions)="data">
                    <!-- Show -->
                    <b-button
                      :to="{ name: 'show-drug', params: { id: data.item.id }}"
                      variant="info"
                      size="sm"
                    >
                      Show
                    </b-button>
                    <!-- Edit -->
                    <b-button
                      :to="{ name: 'edit-drug', params: { id: data.item.id }}"
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
        <!-- {{ $('drugs') }} -->
      </div>
    </div>
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
      title: this.$t('drugs')
    }
  },
  components: {
    LabelInputText,
    SubmitButton,
    SelectBox
  },
  data () {
    return {
      drugs: [],
      categories: [],

      isBusy: false,
      rows: 1,
      perPage: 0,
      currentPage: 1,

      filter: {
        name: '',
        scientific_name: '',
        category_id: '',
        price: ''
      },

      query: {},

      sortBy: 'id',
      sortDesc: false,
      fields: [
        { key: 'id', sortable: true },
        { key: 'name', sortable: true },
        { key: 'scientific_name', sortable: true },
        { key: 'category', sortable: true },
        { key: 'price', sortable: true },
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
    this.fetchCategories()

    this.fetchData().catch((error) => {
      console.log(error)
    })
  },
  methods: {
    async fetchCategories () {
      await this.$axios.$get('/pharmacy-categories')
        .then((res) => {
          this.categories = res
        })
    },
    async fetchData () {
      this.query.page = this.currentPage
      this.isBusy = true

      await this.$axios.$get('drugs', {
        params: this.query
      })
        .then((res) => {
          this.rows = res.pagination.total
          this.perPage = res.pagination.per_page
          this.currentPage = res.pagination.current_page
          this.drugs = res.drugs
          this.isBusy = false
        })

      this.$router.replace({ name: 'drugs',
        query: this.query }).catch(() => {})
    },
    async deleteAction (id, event) {
      const endpoint = `drugs/${id}/delete`
      const res = await deleteItem(endpoint)

      if (res === true) {
        const index = this.drugs.findIndex(element => element.id === id)
        this.drugs.splice(index, 1)
      }
      event.preventDefault()
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
