<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $t('orders') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item">
                <nuxt-link :to="{name: 'home'}">
                  {{ $t("home") }}
                </nuxt-link>
              </li>
              <li class="breadcrumb-item active">
                <nuxt-link :to="{name: 'orders'}">
                  {{ $t('orders') }}
                </nuxt-link>
              </li>
              <li class="breadcrumb-item active">
                {{ order.uuid }}
              </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

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
              <code>
                {{ order.type }} <br>
              </code>
            </div>

            <!-- Name -->
            <div class="form-group">
              <label for="username">{{ $t('username') }} : </label>
              <code>
                {{ order.user.name }} <br>
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
              <label for="address">{{ $t('address') }} : </label>
              <code id="address">
                {{ order.address }} <br>
              </code>
            </div>

            <!-- Service Provider -->
            <div class="form-group">
              <label for="service_provider">{{ $t('service_provider') }} : </label>
              <code id="service_provider">
                {{ order.service_provider ? order.service_provider.name : $t('service_provider_not_assigned') }} <br>
              </code>
            </div>
            <!-- /.Service Provider -->

            <!-- Service Provider -->
            <div class="form-group">
              <label for="is_collected">{{ $t('is_collected') }} : </label>
              <code id="is_collected">
                {{ order.is_collected ? $t('order_collected') : $t('order_not_collected') }} <br>
              </code>
            </div>
            <!-- /.Service Provider -->

            <!-- Created At-->
            <div class="form-group">
              <label>{{ $t('created_at') }} : </label>
              <code>
                {{ $moment(String(order.created_at)).format('LLLL') }} <br>
              </code>
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
            Services
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
// const { ensureFile } = require('fs-extra')
// import fs from 'fs-extra'
export default {
  middleware: 'auth',
  layout: 'admin',

  data () {
    return {
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
        created_at: '',
        is_collected: '',
        service_provider_type: '',
        service_provider: {},
        audio: ''
      },
      servicesFields: [
        'title',
        'service_provider_type',
        'estimated_price',
        'price_to_pay'
      ],
      drugsFields: [
        'title',
        'price_to_pay'
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
