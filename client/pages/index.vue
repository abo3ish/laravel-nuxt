<template>
  <router-view />
</template>

<script>
export default {
  layout: 'admin',
  middleware: 'auth'
}
</script>
