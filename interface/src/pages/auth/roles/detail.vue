<template>
  <s-loading :load="loading" />
  <s-drawer @refresh="refresh" :useModal="useModal" form detail @back="back" :Meta="Meta">
    <div class="col-12 row q-mt-md">
      <div class="col-md-6 col-12 q-mb-sm">
        <s-form class="q-px-md py-sm" :title="'Detail ' + Meta.name">
          <t-list :list="mainList" />
        </s-form>
      </div>
      <div class="col-md-6 col-12" style="height: 100%">
        <s-form class="q-px-md" title="Permissions Access">
          <PermissionsTable
            class="col-12"
            status
            :permissions="model.permission_access"
            v-model="model.permission_access"
          />
        </s-form>
        <!-- {{ model }} -->
      </div>
    </div>
    <!-- {{ model }} -->
  </s-drawer>
</template>

<script>
import Meta from "./meta"
import PermissionsTable from "./component/PermissionsTable"

export default {
  props: ["modal", "id", "submitOnModal"],
  components: {
    PermissionsTable,
  },
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
        destroy: [
          "id",
          "permission_access",
          "master_menu_id",
          "deleted_at",
          "created_at",
          "updated_at",
        ],
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
          this.model = data
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
