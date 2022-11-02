<template>
  <q-select
    outlined
    dense
    @update:model-value="(val) => updateValue(val)"
    :model-value="modelValue"
    :option-label="optionLabel ? optionLabel : 'name'"
    :optionValue="optionValue ? optionValue : 'id'"
    :multiple="multiple == ''"
    use-input
    :use-chips="multiple == '' ? true : false"
    map-options
    :emit-value="full == '' ? false : true"
    input-debounce="0"
    :label="label"
    :options="stringOptions"
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
  created() {},
  data() {
    return {
      model: ref(null),
      firstValue: null,
      stringOptions: null,
    }
  },
  props: [
    "api",
    "field",
    "optionValue",
    "optionLabel",
    "modelValue",
    "full",
    "col",
    "label",
    "options",
    "raw",
    "multiple",
  ],
  methods: {
    filterFn(val, update, abort) {
      this.copyObject()
      update(() => {
        const needle = val.toLowerCase()
        this.stringOptions = this.stringOptions.filter((v, i) => {
          return v[this.optionLabel].toString().toLowerCase().indexOf(needle) > -1
        })
      })
      // }
    },

    updateValue(val) {
      this.$emit("update:modelValue", val)
    },

    abortFilterFn() {
      console.log("delayed filter aborted")
    },
    copyObject() {
      this.stringOptions = this.options
    },
    // getOption() {
    //   console.log(this.options)
    //   console.log(this.stringOptions)
    //   this.options = this.stringOptions
    // },
  },
}
</script>
