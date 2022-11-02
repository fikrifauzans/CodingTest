<template>
  <q-input
    class="q-mb-sm q-absolute_label"
    outlined
    :model-value="modelValue"
    @update:modelValue="(val) => $emit('update:modelValue', val)"
    :label="label"
    :dense="dense === false ? false : true"
    :class="`q-absolute_label col-12 col-sm-6 col-md-${col} q-px-xs`"
    :rules="required == '' ? [(val) => !!val || 'Field is required'] : false"
    lazy-rules
    :required="required == ''"
    @blur="$emit('blur')"
    @focus="$emit('focus')"
    @keyup="keyon(modelValue)"
  >
    <template v-slot:append>
      <div>
        <q-icon :name="rIcon" :size="iconSize ? iconSize : 'xs'" />
      </div>
    </template>
  </q-input>
</template>
<script>
export default {
  props: [
    "col",
    "label",
    "modelValue",
    "rIcon",
    "iconSize",
    "required",
    "type",
    "number",
  ],

  watch: {
    modelValue: {
      // handler: function (val, oldVal) {
      //
      // },
      // deep: true,
    },
  },
  methods: {
    keyon(val) {
      let oldVal = val[val.length - 1]

      if (this.number == "") {
        if (
          isNaN(parseInt(val[val.length - 1])) ||
          isNaN(parseInt(oldVal[oldVal.length - 1]))
        ) {
          if (typeof oldVal == "string") {
            oldVal = 0
            val = 0
          }

          if (oldVal == "" || oldVal == undefined) {
            this.$emit("update:modelValue", val)
            // console.log(true)
          } else this.$emit("update:modelValue", oldVal)
        }
      }
    },
  },
}
</script>
<style lang=""></style>
