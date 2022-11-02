<template>
  <q-td>
    <q-btn
      v-if="noEdit !== ''"
      size="sm"
      flat
      color="blue"
      round
      icon="edit"
      @click="$emit('edit')"
    />
    <q-btn
      v-if="noView !== ''"
      size="sm"
      flat
      color="orange"
      round
      icon="visibility"
      @click="$emit('show')"
    />
    <q-btn
      class="q-ml-sm"
      v-if="aprove === ''"
      label="approve"
      size="xs"
      color="positive"
      @click="$emit('aprove')"
    />
  </q-td>
</template>
<script>
export default {
  props: ["aprove", "noView", "noEdit"],
}
</script>
<style lang=""></style>
