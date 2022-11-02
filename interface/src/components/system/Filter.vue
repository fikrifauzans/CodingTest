<template>
  <div class="relative-position">
    <q-tabs v-model="tab" class="bg-white text-primary q-pa-sm">
      <q-tab name="filter" icon="filter_alt" size="sm" ripple />
      <q-tab name="filter_list" icon="filter_list" size="sm" ripple />
    </q-tabs>
    <div>
      <q-btn
        icon="close"
        size="sm"
        round
        class="absolute-top-right text-grey q-ma-xs"
        flat
        @click="closeFilter"
      />
    </div>
  </div>

  <div v-if="tab == 'filter'">
    <div class="q-px-md text-weight-bold q-my-sm text-primary">Search By Column :</div>
    <div class="col-12" v-for="(value, key, index) in table.columns">
      <div v-for="item in table.visibleColumns" class="col-12">
        <t-input
          class="q-pa-xs q-px-md"
          v-if="item == value.name"
          @update:modelValue="updateQuery()"
          :label="value.label.toLowerCase()"
          v-model="filter[value.name]"
          @keyup="updateQuery(filter)"
        />
      </div>
    </div>
  </div>
  <div v-if="tab == 'filter_list'">
    <div class="q-px-md text-weight-bold q-my-sm text-primary row">Sort Column :</div>
    <div class="col-12 column q-px-md">
      <q-toggle
        v-for="(item, index) in table.columns"
        v-model="table.visibleColumns"
        :val="table.columns[index].name"
        :label="item.label"
      />
    </div>
  </div>
</template>
<script>
export default {
  props: ["table", "modelValue"],
  created() {},
  data() {
    return {
      tab: "filter",
      filter: {},
    }
  },
  methods: {
    updateQuery() {
      this.$emit("refresh")
      this.$emit("update:modelValue", this.filter)
    },
    closeFilter() {
      this.$emit("closeFilter")
    },
  },
}
</script>
<style></style>
