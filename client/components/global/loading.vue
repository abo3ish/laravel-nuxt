<template lang="html">
  <div class="loading-page">
    <b-spinner variant="primary" type="grow" label="Spinning" />
  </div>
</template>

<script>
export default {

}
</script>

<style scoped>
  .loading-page {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.3);
    text-align: center;
    padding-top: 200px;
    font-size: 30px;
    font-family: sans-serif;
    z-index: 999;
  }
</style>
