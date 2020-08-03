<template>
  <div>
    <b-table
      :items="serviceProviders"
      :fields="fields"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :per-page="perPage"
      :current-page="currentPage"
      responsive="sm"
    />
    <b-pagination
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      first-number
    />
  </div>
</template>

<script>
export default {
  layout: 'admin',
  middleware: 'auth',
  data () {
    return {
      rows: 1,
      perPage: 0,
      currentPage: 0,

      serviceProviders: [],
      sortBy: 'id',
      sortDesc: false,
      fields: [
        { key: 'id', sortable: true },
        { key: 'name', sortable: true },
        { key: 'phone', sortable: true },
        { key: 'email', sortable: true },
        { key: 'address', sortable: false }
      ]
    }
  },
  watch: {
    currentPage: {
      handler (value) {
        this.fetchData().catch((error) => {
          console.error(error)
        })
      }
    }
  },
  mounted () {
    this.fetchData().catch((error) => {
      console.log(error)
    })
  },
  methods: {
    async fetchData () {
      await this.$axios.$get('service-providers?page=' + this.currentPage)
        .then((res) => {
          this.serviceProviders = res.data
          this.rows = res.total
          this.currentPage = res.current_page
          console.log(this.serviceProviders, this.currentPage)
        })
    }
  }
}
</script>

<style>

</style>
