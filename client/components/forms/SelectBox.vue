<template>
  <div class="form-group">
    <label v-if="label" :for="idName">{{ label }}</label>
    <select
      :id="idName"
      :value="value"
      :name="name"
      class="form-control"
      @input="updateValue($event.target.value)"
    >
      <option value="" selected>
        {{ $t('select') }}
      </option>
      <option v-for="item in items" :key="item.id" :value="item.id" :selected="item.id == value ? 'selected' : ''">
        {{ item.title }}
      </option>
    </select>
  </div>
</template>

<script>
export default {
  name: 'Selectbox',
  props: {
    label: {
      required: false,
      default: '',
      type: String
    },
    items: {
      required: true,
      type: [Array]
    },
    value: {
      required: true,
      type: [String, Number]
    },
    name: {
      required: true,
      type: String
    }
  },
  computed: {
    idName () {
      return this.label.toLowerCase().replace(' ', '-') + '-' + Math.floor(Math.random() * 100)
    }
  },
  methods: {
    updateValue (value) {
      this.$emit('input', value)
    }
  }
}
</script>

<style>

</style>
