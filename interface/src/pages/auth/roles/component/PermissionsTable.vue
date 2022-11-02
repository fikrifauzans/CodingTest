<template>
  <q-table
    virtual-scroll
    class="q-my-sm"
    :rows="table.rows"
    :columns="table.columns"
    row-key="id"
    selection="multiple"
    v-model:selected="table.selected"
    v-model:pagination="table.pagination"
    :style="$Static.table.height('300px')"
    :dense="$Static.table.dense()"
    :flat="$Static.table.flat()"
    :color="$Static.table.color()"
    :rows-per-page-label="$Static.table.rowPerPageLabel()"
    :rows-per-page-options="$Static.table.rowPerPageOption(0)"
    :square="$Static.table.square()"
    :bordered="$Static.table.bordered()"
    binary-state-sort
    :visible-columns="table.visibleColumns"
    @request="getData"
    :loading="loading"
    :filter="table.search"
    :separator="$Static.table.separator()"
    @update:selected="update(table.selected)"
  >
    <template v-slot:header-cell-status="props">
      <q-th v-if="status == ''"> Status </q-th>
    </template>
    <template v-slot:body-cell-status="props">
      <q-td class="text-center" v-if="status == ''">
        <q-btn
          v-if="props.row.status"
          icon="check"
          size="xs"
          color="positive"
          round
          rounded
        />
        <q-btn v-else icon="close" size="xs" color="negative" round rounded />
      </q-td>
    </template>
    <template v-if="status == ''" v-slot:body-selection="props"> </template>
    <template v-if="status == ''" v-slot:header-selection="props"> </template>
  </q-table>
  <!-- {{ table.selected }} -->
</template>
<script>
import { ref } from "vue"
import Meta from "./meta"

export default {
  components: {},
  props: ["permissions", "status"],
  data() {
    return {
      Meta,
      id: null,
      table: Meta.table,
      filter: {
        value: false,
        query: null,
      },
    }
  },
  created() {
    this.table = this.$Handle.structureTable(
      this.table.columns(this.$Help, this.$Lang, this.Static)
    )

    this.refresh()
  },
  methods: {
    refresh() {
      this.getData()
    },
    getData(props) {
      this.loading = true
      if (props) this.table.pagination = props.pagination
      let { page, rowsPerPage, sortBy, descending } = { ...this.table.pagination }
      let endpoint = this.Meta.module + "?table="
      endpoint += "&like=" + this.$Help.transformQuery(this.filter.query)
      endpoint += this.trash ? "&trash=true" : ""
      endpoint += "&page=" + page
      endpoint += "&limit=" + "0"
      endpoint += "&order=" + this.$Handle.transformDesc(sortBy, descending)
      if (this.table.search) endpoint += "&search=" + this.table.search
      this.$api.get(
        endpoint,
        (data, status, message, full) => {
          if (status == 200) {
            this.table.rows = data.data.filter((val) =>
              this.trash && this.table.search ? val.deleted_at !== null : val
            )

            this.loading = false
            for (let i = 0; i < this.permissions.length; i++) {
              for (let j = 0; j < this.table.rows.length; j++) {
                if (this.permissions[i].permission_id == this.table.rows[j].id) {
                  this.table.rows[j].status = true
                  this.table.selected.push(this.table.rows[j])
                }
              }
            }
            this.update(this.table.selected)
          }
        },
        (e) => {}
      )
    },
    update(val) {
      this.$emit("update:modelValue", val)
    },
  },
}
</script>
