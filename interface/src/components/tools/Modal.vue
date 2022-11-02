<template>
  <q-dialog
    :model-value="modelValue"
    @update:modelValue="(val) => $emit('update:modelValue', val)"
  >
    <q-card style="width: 800px; max-width: 90vw">
      <q-form @submit="submit">
        <q-card-section class="row justify-between q-px-lg">
          <div class="text-h6">{{ title ? title : "" }}</div>
          <div class="text-h6 q-gutter-sm">
            <q-btn
              icon="close"
              round
              flat
              class="text-white bg-grey"
              size="xs"
              v-close-popup
            />
          </div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          <slot />
        </q-card-section>

        <q-card-actions align="right" class="bg-white text-teal q-pa-md">
          <!-- <q-btn flat label="OK" v-close-popup /> -->
          <q-btn
            icon="check"
            label="save"
            flat
            class="text-white bg-positive cursor-pointer"
            size="sm"
            type="submit"
          />
        </q-card-actions>
      </q-form>
    </q-card>
  </q-dialog>
</template>
<script>
export default {
  props: ["modelValue", "title"],
  methods: {
    submit(evt) {
      if (evt.isTrusted == true) {
        this.$emit("submit", evt)
      }
    },
  },
}
</script>
<style lang=""></style>
