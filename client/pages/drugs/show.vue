<template>
  <div>
    <loading v-if="!drug.id" />
    <header-info
      :name="'drugs'"
      :navigation="[{name:'home', link: 'dashboard'}, {name: 'drugs', link: 'drugs'}, {name: drug.name, link: '', trans: false}]"
    />

    <div class="row">
      <div class="col-md-12">
        <!-- card -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              {{ drug.name }}
              <n-link :to="{name: 'edit-drug' }">
                <button class="btn btn-outline-light float-left">
                  {{ $t('edit') }}
                </button>
              </n-link>
            </h3>
          </div>
          <!-- /.card-header -->

          <!-- form start -->
          <div class="card-body">
            <!-- Name -->
            <div class="form-group">
              <label for="image">{{ $t('image') }} : </label>
              <b-img fluid :src="drug.image" />
            </div>

            <!-- Name -->
            <div class="form-group">
              <label for="name">{{ $t('name') }} : </label>
              <code>
                {{ drug.name }} <br>
              </code>
            </div>

            <!-- Scientific Name -->
            <div class="form-group">
              <label for="scientific_name">{{ $t('scientific_name') }} : </label>
              <code>
                {{ drug.scientific_name }} <br>
              </code>
            </div>

            <!-- category -->
            <div class="form-group">
              <label for="category">{{ $t('category') }} : </label>
              <code>
                {{ drug.category.title }} <br>
              </code>
            </div>

            <!-- description -->
            <div class="form-group">
              <label for="description">{{ $t('description') }} : </label>
              <code>
                {{ drug.description }} <br>
              </code>
            </div>

            <!-- Price -->
            <div class="form-group">
              <label for="price">{{ $t('price') }} : </label>
              <code>
                {{ drug.price }}
              </code>
            </div>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</template>

<script>
import Loading from '~/components/global/loading'

export default {
  layout: 'admin',
  middleware: 'auth',
  head () {
    return {
      title: this.drug.name
    }
  },
  components: {
    Loading
  },

  data: () => {
    return {
      drug: {
        id: '',
        name: '',
        scientific_name: '',
        image: '',
        description: '',
        category: '',
        price: ''
      }
    }
  },
  mounted () {
    this.fetchData()
  },
  methods: {
    fetchData () {
      this.$axios.$get('drugs/' + this.$route.params.id)
        .then((res) => {
          this.drug = res
        })
    }
  }
}
</script>

<style scoped>
  /* .loader {
    text-align: center;
    color: #bbbbbb;
  } */
</style>
