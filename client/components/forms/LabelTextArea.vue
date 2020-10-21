<template>
  <div class="form-group">
    <label v-if="label" class="col-form-label" :for="idName">{{ label }}</label>
    <div class="input-group mb-3">
      <textarea
        :id="idName"
        :name="name"
        :value="value"
        :placeholder="placeholder"
        class="form-control"
        @input="updateValue($event.target.value)"
      />
    </div>
  </div>
</template>

<script>
export default {
  name: 'LabelInputText',
  props: {
    label: {
      required: false,
      default: '',
      type: String
    },
    value: {
      required: false,
      type: [String, Number],
      default: ''
    },
    placeholder: {
      required: false,
      default: '',
      type: String
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
