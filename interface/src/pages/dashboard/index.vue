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
    <div>Dashboard Masih Kosong</div>
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
    }
  },
  created() {},
  methods: {
    refresh() {
      this.getData()
    },
  },
}
</script>
