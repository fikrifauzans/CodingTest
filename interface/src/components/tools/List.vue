<template>
  <div class="row col-12" v-for="(value, key, index) in list">
    <div class="col-4">{{ key }}</div>
    <div class="col-1">:</div>
    <div class="text-bold col-7">{{ value }}</div>
  </div>
</template>
<script>
export default {
  props: ["list"],
}
</script>
<style></style>
