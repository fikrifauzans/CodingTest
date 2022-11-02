<template>
  <s-loading :load="loading" />
  <s-drawer
    @refresh="refresh"
    :Meta="Meta"
    :filter="filter"
    :table="table"
    v-model="filter.query"
    @update:modelValue="refresh"
  >
    <q-table
      virtual-scroll
      class="q-my-sm"
      :rows="table.rows"
      :columns="table.columns"
      row-key="id"
      selection="multiple"
      v-model:selected="table.selected"
      v-model:pagination="table.pagination"
      :style="$Static.table.height()"
      :dense="$Static.table.dense()"
      :flat="$Static.table.flat()"
      :color="$Static.table.color()"
      :rows-per-page-label="$Static.table.rowPerPageLabel()"
      :rows-per-page-options="$Static.table.rowPerPageOption()"
      :square="$Static.table.square()"
      :bordered="$Static.table.bordered()"
      binary-state-sort
      :visible-columns="table.visibleColumns"
      @request="getData"
      :loading="loading"
      :filter="table.search"
      :separator="$Static.table.separator()"
    >
      <template v-slot:top>
        <!-- <q-btn label="test" @click="false" /> -->
        <s-top-table
          :Meta="Meta"
          :table="table"
          v-model="table.search"
          @delete="daleteData"
          :trash="trash"
          @trash="setTrash"
          @restore="restoreData"
          @add="addData"
          @seachReset="table.search = null"
          @onFilter="setFilter"
          :filter="filter"
        ></s-top-table>

        <q-tabs
          v-model="tab"
          noCaps
          dense
          class="text-primary q-pa-none q-px-none"
          @click="refresh"
        >
          <q-tab name="0" label="Not Approve" />
          <q-tab name="1" label="Approved" />
        </q-tabs>
      </template>
      <template v-slot:body-cell-id="props">
        <q-td v-if="trash == true"> </q-td>
        <s-table-option
          v-else
          @show="detail(props.key)"
          @edit="edit(props.key)"
          :aprove="user.supervisor_id > 0 || props.row.is_aprove == 1 ? false : ''"
          @aprove="validation(props.row)"
          :noView="user.supervisor_id == null ? false : ''"
          :noEdit="user.supervisor_id == null ? false : ''"
        />
      </template>
      <template v-slot:body-cell-is_aprove="props">
        <q-td>
          <q-btn
            v-if="props.row.is_aprove == 1"
            icon="check"
            round
            rounded
            size="xs"
            color="positive"
          />
          <q-btn v-else icon="cancel" round rounded size="xs" color="negative" />
        </q-td>
      </template>
    </q-table>
    <t-modal v-model="modal" @submit="submit">
      <Form
        v-if="modalType == 'form'"
        :modal="useModal"
        :id="id"
        :submitOnModal="submitOnModal"
        @closeModal="modal = !modal"
        @refresh="refresh"
      />
      <Detail v-else :modal="useModal" :id="id" />
    </t-modal>

    <q-dialog v-model="small">
      <q-card style="width: 300px">
        <q-card-section>
          <div class="text-h6">Aprove</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          Click/Tap on Aprove for aproving
        </q-card-section>

        <q-card-actions align="right" class="bg-white text-teal">
          <q-btn size="xs" label="Cancel" color="grey" v-close-popup />
          <q-btn color="positive" size="xs" label="Approve" @click="editData" />
        </q-card-actions>
      </q-card>
    </q-dialog>
  </s-drawer>
</template>
<script>
import { ref } from "vue"
import Meta from "./meta"
import Form from "./form"
import Detail from "./detail"
export default {
  components: {
    Form,
    Detail,
  },
  data() {
    return {
      Meta,
      id: null,
      table: Meta.table,
      useModal: Meta.formType,
      loading: false,
      modal: false,
      trash: false,
      modalType: "",
      submitOnModal: null,
      filter: {
        value: false,
        query: null,
      },
      user: null,
      tab: "0",
      small: false,
      model: null,
      user: this.$Handle.getLS("_user"),
    }
  },
  created() {
    this.table = this.$Handle.structureTable(
      this.table.columns(this.$Help, this.$Lang, this.Static)
    )
    if (this.$route.query.trash) this.trash = JSON.parse(this.$route.query.trash)
    if (this.$route.query.search) this.trash = JSON.parse(this.$route.query.search)
    if (this.$route.query.page) this.table.pagination = { ...this.$route.query }
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

      endpoint += "&where=is_aprove:" + this.tab
      if (this.user.supervisor_id != null) {
        endpoint += "|user_id:" + this.user.id
      }
      endpoint += "&like=" + this.$Help.transformQuery(this.filter.query)
      endpoint += this.trash ? "&trash=true" : ""
      endpoint += "&page=" + page
      endpoint += "&limit=" + rowsPerPage
      endpoint += "&order=" + this.$Handle.transformDesc(sortBy, descending)
      if (this.table.search) endpoint += "&search=" + this.table.search
      this.$api.get(
        endpoint,
        (data, status, message, full) => {
          if (status == 200) {
            this.table.rows = data.data.filter((val) =>
              this.trash && this.table.search ? val.deleted_at !== null : val
            )
            this.table.pagination.rowsNumber = this.table.search
              ? this.table.rows.length
              : data.total
            this.table.pagination.page = data.current_page
            this.table.pagination.rowsPerPage = data.per_page
            this.loading = false
          }
        },
        (e) => {}
      )
      this.$router.replace({
        query: { ...this.table.pagination, seach: this.table.search, trash: this.trash },
      })
    },
    async daleteData() {
      this.loading = true
      await this.table.selected.forEach((val) => {
        let endpoint = this.Meta.module
        endpoint += this.trash == true ? "/force/" : "/"
        endpoint += val.id
        this.$api.delete(endpoint, (data, status, message, full) => {
          this.$Handle.successMessage(message)
          this.table.selected = []
          this.refresh()
        })
      })
    },
    async restoreData() {
      this.loading = true
      await this.table.selected.forEach((val) => {
        let endpoint = this.Meta.module
        endpoint += "/restore/"
        endpoint += val.id
        this.$api.put(endpoint, val, (data, status, message, full) => {
          this.$Handle.successMessage(message)
          this.table.selected = []
          this.refresh()
        })
      })
    },
    setTrash() {
      this.trash = JSON.parse(this.trash)
      this.trash = !this.trash
      this.table.selected = []
      this.table.search = null
      this.table.pagination.page = 1
      this.table.pagination.rowsNumber = 1

      this.refresh()
    },
    detail(id) {
      this.id = id
      this.modalType = "detail"
      if (this.useModal.show === true) {
        this.modal = true
      } else {
        this.$router.push({
          params: { id },
          name: "view-" + this.Meta.module,
          query: { ...this.$route.query },
        })
      }
    },
    edit(id) {
      this.modalType = "form"
      if (this.useModal.edit === true) {
        this.modal = true
        this.id = id
      } else {
        this.$router.push({
          params: { id },
          name: "edit-" + this.Meta.module,
          query: { ...this.$route.query },
        })
      }
    },
    addData() {
      this.modalType = "form"
      if (this.useModal.add === true) {
        this.modal = true
      } else {
        this.$router.push({
          name: "add-" + this.Meta.module,
          query: { ...this.$route.query },
        })
      }
    },
    submit(evt) {
      this.$Handle.loadingStart()
      this.submitOnModal = evt
      this.refresh()
    },
    setFilter() {
      this.filter.value = true
      // this.left = !this.left
    },
    validation(item) {
      this.small = !this.small
      this.model = item
    },
    editData() {
      this.model.is_aprove = 1
      let endpoint = this.Meta.module + "/" + this.model.id
      this.$api.put(
        endpoint,
        this.model,
        (data, status, message, full) => {
          if (status == 200) {
            this.refresh()
            this.$Handle.successMessage("data approved")
            this.$Handle.loadingStop()
          }
        },
        (e) => {}
      )
    },
  },
}
</script>
