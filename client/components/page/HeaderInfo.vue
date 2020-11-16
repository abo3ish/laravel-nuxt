<template>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ $t(name) }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left">
            <li v-for="item in navigation" :key="item.name" class="breadcrumb-item" :class="item.link ? 'active' : ''">
              <nuxt-link v-if="item.link" :to="{name: item.link}">
                {{ $t(item.name) }}
              </nuxt-link>
              <span v-else>
                {{ item.trans === false ? item.name : $t(item.name) }}
              </span>
            </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
</template>

<script>
export default {
  name: 'HeaderInfo',
  props: {
    name: {
      required: false,
      default: '',
      type: String
    },
    navigation: {
      required: false,
      default: '',
      type: [Array, String]
    }
  }
}
</script>
