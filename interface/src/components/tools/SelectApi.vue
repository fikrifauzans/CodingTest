<template>
  <q-select
    outlined
    dense
    @update:model-value="(val) => updateValue(val)"
    v-model="modelValue"
    :option-label="optionLabel ? optionLabel : 'name'"
    :multiple="multiple == ''"
    use-input
    :optionValue="optionValue ? optionValue : 'id'"
    :use-chips="multiple == '' ? true : false"
    map-options
    :emit-value="full == '' ? false : true"
    input-debounce="0"
    :label="label"
    :options="options"
    @filter="filterFn"
    @filter-abort="abortFilterFn"
    hint="hint"
    class="q-mb-sm q-absolute_label"
    :class="`q-absolute_label col-12 col-sm-6 col-md-${col} q-px-xs`"
  >
    <template v-slot:no-option>
      <q-item>
        <q-item-section class="text-grey"> No results </q-item-section>
      </q-item>
    </template>
  </q-select>
</template>

<script>
import { ref } from "vue"

export default {
  data() {
    return {
      model: ref(null),
      options: null,
    }
  },
  props: ["api", "field", "optionValue", "optionLabel", "full", "col", "label"],
  methods: {
    filterFn(val, update, abort) {
      let endpoint = this.api + "?table="
      if (val != "") endpoint += `&like=${this.field ? this.field : "name"}:${val}`
      this.$api.get(
        endpoint,
        (data, status, message, full) => {
          if (status == 200) {
            update(() => {
              this.options = data.data
            })
          }
        },
        (e) => {}
      )
    },
    optionVal(val) {
      console.log(val)
    },
    updateValue(val) {
      this.$emit("update:modelValue", val)
    },

    abortFilterFn() {
      console.log("delayed filter aborted")
    },
  },
}
</script>
