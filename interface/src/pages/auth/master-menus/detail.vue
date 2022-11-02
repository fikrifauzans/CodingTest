<template>
  <s-loading :load="loading" />
  <s-drawer @refresh="refresh" :useModal="useModal">
    <s-form class="q-px-md py-sm q-mt-lg">
      <t-list :list="mainList" />
    </s-form>
  </s-drawer>
</template>

<script>
import Meta from "./meta"

export default {
  props: ["modal", "id", "submitOnModal"],
  created() {
    this.$Handle.loadingStart()
    if (this.modal && this.modal.show === true) this.useModal = true
    if (this.$route.params.id) {
      this.param = this.$route.params.id ? this.$route.params.id : null
    }
    if (this.id) this.param = this.id ? this.id : null
    if (this.param) this.findId(this.param)
    else this.$Handle.loadingStop()
  },
  data() {
    return {
      Meta,
      useModal: false,
      model: Meta.model,
      mainList: null,
      loading: false,
      param: null,
      setup: {
        destroy: ["id", "deleted_at", "created_at", "updated_at"],
        money: [],
        date: [],
      },
    }
  },

  watch: {},
  methods: {
    findId(id) {
      let endpoint = Meta.module + "/" + id
      this.$api.get(endpoint, (data, status, message, full) => {
        if (status == 200) {
          this.mainList = this.$Help.transformList(data, this.setup)
          this.$Handle.loadingStop()
        }
      })
    },
    back() {
      if (this.useModal == true) this.$emit("closeModal")
      else
        return this.$router.push({ name: Meta.module, query: { ...this.$route.query } })
    },
  },
}
</script>
