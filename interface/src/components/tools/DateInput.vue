<template>
  <q-input
    v-if="dateTime != ''"
    outlined
    :dense="dense === false ? false : true"
    v-model="date"
    mask="date"
    :rules="['date']"
    :class="`col-12 col-sm-6 col-md-${col} q-px-xs`"
    :label="label"
  >
    <template v-slot:append>
      <q-icon name="event" class="cursor-pointer">
        <q-popup-proxy cover transition-show="scale" transition-hide="scale">
          <q-date v-model="date">
            <div class="row items-center justify-end">
              <q-btn v-close-popup label="Close" color="primary" flat />
            </div>
          </q-date>
        </q-popup-proxy>
      </q-icon>
    </template>
  </q-input>

  <q-input
    :model-value="modelValue"
    outlined
    :dense="dense === false ? false : true"
    v-if="dateTime == ''"
    :class="`col-12 col-sm-6 col-md-${col} q-px-xs`"
    @update:model-value="(val) => $emit('update:modelValue', val)"
  >
    <template v-slot:prepend>
      <q-icon name="event" class="cursor-pointer">
        <q-popup-proxy cover transition-show="scale" transition-hide="scale">
          <q-date
            @update:model-value="(val) => $emit('update:modelValue', val)"
            mask="YYYY-MM-DD HH:mm"
          >
            <div class="row items-center justify-end">
              <q-btn v-close-popup label="Close" color="primary" flat />
            </div>
          </q-date>
        </q-popup-proxy>
      </q-icon>
    </template>

    <template v-slot:append>
      <q-icon name="access_time" class="cursor-pointer">
        <q-popup-proxy cover transition-show="scale" transition-hide="scale">
          <q-time
            :model-value="modelValue"
            mask="YYYY-MM-DD HH:mm"
            format24h
            @update:model-value="(val) => $emit('update:modelValue', val)"
          >
            <div class="row items-center justify-end">
              <q-btn v-close-popup label="Close" color="primary" flat />
            </div>
          </q-time>
        </q-popup-proxy>
      </q-icon>
    </template>
  </q-input>
</template>

<script>
import { ref } from "vue"
import { date } from "quasar"
export default {
  setup() {
    return {
      // date: ref("2019/02/01"),
    }
  },
  data() {
    return {
      date: null,
    }
  },

  created() {
    const timeStamp = Date.now()
    const formattedString = date.formatDate(timeStamp, "YYYY-MM-DD HH:mm")
    this.date = formattedString
  },
  props: ["col", "dateTime", "modelValue", "label"],
}
</script>
