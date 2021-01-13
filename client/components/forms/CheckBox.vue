<template>
  <div class="form-check">
    <input
      :id="idName"
      :name="name"
      :value="value"
      :checked="value"
      type="checkbox"
      class="form-check-input"
      @change="updateValue($event.target.checked)"
    >
    <label class="form-check-label" :for="idName"><b>{{ label }}</b></label>
  </div>
</template>

<script>
export default {
  name: 'CheckBox',
  props: {
    label: {
      required: false,
      default: '',
      type: String
    },
    value: {
      required: true,
      type: [Boolean, Number],
      default: false
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
