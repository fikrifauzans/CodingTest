<template>
  <q-card class="fit" flat>
    <div class="row col-12">
      <div class="col-12 row">
        <div class="row justify-between col-12 bg-grey-4 rounded-borders q-pa-md">
          <div class="text-bold border text-primary">
            {{ title ? title : "" }}
          </div>
          <div>
            <slot name="right" />
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="row s-card-content q-mx-sm q-pa-md col-12">
          <slot />
        </div>
      </div>
    </div>
  </q-card>
</template>
<script>
export default {
  props: ["title"],
}
</script>
<style lang=""></style>
