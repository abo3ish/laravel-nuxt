<template>
  <div>
    <loading v-if="loading" />

    <header-info
      :name="'orders'"
      :navigation="[{name:'home', link: 'dashboard'}, {name: 'orders', link: 'orders'}, {name: order.uuid, link: '', trans: false}]"
    />

    <div class="row">
      <div class="col-md-12">
        <!-- card -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              {{ order.user.name + " - " + order.type + " - " + order.status.string }}
              <n-link :to="{name: 'edit-order' }">
                <button class="btn btn-outline-light float-left">
                  {{ $t('edit') }}
                </button>
              </n-link>
            </h3>
          </div>
          <!-- /.card-header -->

          <!-- form start -->
          <div class="card-body">
            <!-- Type -->
            <div class="form-group">
              <label for="type">{{ $t('order_type') }} : </label>
              <code class="badge badge-info">
                {{ order.type }} <br>
              </code>
            </div>

            <!-- UUID -->
            <div class="form-group">
              <label for="type">{{ $t('order_number') }} : </label>
              <code class="badge badge-danger">
                {{ order.uuid }} <br>
              </code>
            </div>

            <!-- Name -->
            <div class="form-group">
              <label for="user">{{ $t('user') }} : </label>
              <code>
                <nuxt-link v-if=" order.user"
                           :to="{ name: 'show-user', params: { id: order.user.id }}"
                >
                  {{ order.user.name }}
                </nuxt-link>
                <br>
              </code>
            </div>

            <!-- Phone -->
            <div class="form-group">
              <label for="phone">{{ $t('phone') }} : </label>
              <code>
                {{ order.user.phone }}
              </code>
            </div>

            <!-- Status -->
            <div class="form-group">
              <label for="status">{{ $t('status') }} : </label>
              <code>
                {{ order.status.string }} <br>
              </code>
            </div>

            <!-- Address -->
            <div class="form-group">
              <label for="area">{{ $t('area') }} : </label>
              <code id="area">
                {{ order.address.area }}
              </code>
              ||
              <label for="street">{{ $t('street') }} : </label>
              <code id="street" dir="rtl">
                {{ order.address.street }}
              </code>
              ||
              <label for="building_number">{{ $t('building_number') }} : </label>
              <code id="building_number">
                {{ order.address.building_number }}
              </code>
              ||
              <label for="floor_number">{{ $t('floor_number') }} : </label>
              <code id="floor_number">
                {{ order.address.floor_number }}
              </code>
              ||
              <label for="flat_number">{{ $t('flat_number') }} : </label>
              <code id="flat_number">
                {{ order.address.flat_number }}
              </code>
              ||
              <a
                :href="`https://www.google.com/maps/search/?api=1&query=${order.address.lat},${order.address.lat}`"
                target="_blank"
              >
                افتح علي الخريطة
              </a>
            </div>

            <!-- Service Provider -->
            <div class="form-group">
              <label for="service_provider">{{ $t('service_provider') }} : </label>
              <code id="service_provider">
                <nuxt-link v-if=" order.service_provider"
                           :to="{ name: 'show-service-provider', params: { id: order.service_provider.id }}"
                >
                  {{ order.service_provider.name }}
                </nuxt-link>
                <span v-else>{{ $t('service_provider_not_assigned') }}</span>
                <br>
              </code>
            </div>
            <!-- /.Service Provider -->

            <!-- Is Collected -->
            <div class="form-group">
              <label for="is_collected">{{ $t('is_collected') }} : </label>
              <code id="is_collected">
                {{ order.is_collected ? $t('order_collected') : $t('order_not_collected') }} <br>
              </code>
            </div>
            <!-- /.Service Provider -->

            <!-- Prices -->
            <div class="row">
              <div class="col-3">
                <table class="table table-responsive table-hover">
                  <tr v-for="price in Object.keys(order.prices)" :key="price.id" class="">
                    <th>{{ $t(price) }}</th>
                    <td>{{ order.prices[price] }}</td>
                  </tr>
                </table>
              </div>
              <div class="col-3">
                <table class="table table-responsive table-hover">
                  <tr v-for="profit in Object.keys(order.profits)" :key="profit.id" class="">
                    <th>{{ $t(profit) }}</th>
                    <td>{{ order.profits[profit] }}</td>
                  </tr>
                </table>
              </div>
              <div class="col-6">
                <table class="table table-striped table-responsive table-hover">
                  <tr v-for="date in Object.keys(order.dates)" :key="date.id">
                    <th>{{ $t(date) }}</th>
                    <td>{{ order.dates[date] ? $moment(String(order.dates[date]), "YYYY-MM-DD hh:mm:ss").format('LLLL') : '' }}</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card -->

        <!-- Services -->
        <div v-if="order.services.length" class="card card-primary">
          <div class="card card-header">
            Services
          </div>
          <div class="card card-body">
            <b-table :items="order.services" :fields="servicesFields" show-empty />
          </div>
        </div>
        <!-- ./Services -->

        <!-- Drugs -->
        <div v-if="order.drugs.length" class="card card-primary">
          <div class="card card-header">
            Products
          </div>
          <div class="card card-body">
            <b-table :items="order.drugs" :fields="drugsFields" show-empty />
          </div>
        </div>
        <!-- ./Drugs -->

        <!-- Attachments -->
        <div v-for="attachment in order.attachments" :key="attachment.id" class="card card-indigo">
          <b-button v-if="!attachment.ready" variant="primary" @click="loadFile(attachment)">
            <b-spinner v-if="attachment.loading" small /> Load File
          </b-button>

          <!-- Audio -->
          <vue-plyr v-if="attachment.type == 'audio' && attachment.rowFile != ''">
            <audio>
              <source :src="attachment.rowFile" :type="attachment.mime">
            </audio>
          </vue-plyr>

          <!-- images -->
          <b-card-img v-if="attachment.type=='text' || attachment.type=='image'" :src="attachment.rowFile" thumbnail fluid />
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  layout: 'admin',
  middleware: 'auth',

  head () {
    return {
      title: this.order.uuid
    }
  },
  data () {
    return {
      loading: true,
      order: {
        id: '',
        uuid: '',
        user: {},
        address: {},
        type: '',
        status: {},
        services: {},
        drugs: {},
        attachments: [],
        prices: {},
        profits: {},
        created_at: '',
        is_collected: '',
        service_provider_type: '',
        service_provider: {},
        audio: '',
        dates: {}
      },
      servicesFields: [
        'title',
        'service_provider_type',
        'estimated_price',
        'price_to_pay',
        'discount_price',
        'discount'
      ],
      drugsFields: [
        'name',
        'price',
        'price_to_pay',
        'discount_price',
        'discount'
      ]
    }
  },
  mounted () {
    this.fetchOrder()
  },
  methods: {
    fetchOrder () {
      this.$axios.$get('/orders/' + this.$route.params.id)
        .then((res) => {
          this.order = res
        })
      this.loading = false
    },
    playAudio (attachment) {
      attachment.loading = true

      if (!attachment.rowFile) {
        this.loadFile(attachment)
      }
      // const snd = new Audio(attachment.rowFile)

      // snd.play()
    },
    pauseAudio (attachment) {
      attachment.loading = true
      if (!attachment.audio) {
        return
      }
      attachment.audio.pause()
    },
    async loadFile (attachment) {
      await this.$axios.$get('/attachments/' + attachment.id, { responseType: 'blob' })
        .then((res) => {
          const reader = new FileReader()
          reader.readAsDataURL(res)
          reader.onload = () => {
            attachment.rowFile = reader.result
            attachment.loading = false
            attachment.ready = true
          }
        })
    }
  }
}

</script>

<style>

</style>
