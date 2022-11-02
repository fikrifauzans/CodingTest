<template>
  <s-loading :load="loading" />
  <s-drawer @refresh="refresh" :useModal="useModal" detail form :Meta="Meta">
    <div class="row">
      <div class="col-md-6 col-12">
        <s-form class="q-px-md py-sm q-mt-lg" :title="Meta.name">
          <t-list :list="mainList" />
        </s-form>
      </div>
      <div class="col-md-6 col-12">
        <s-form class="q-px-md q-py-lg" title="Icon Preview">
          <div class="col-12 justify-center row">
            <div class="col-12 row justify-center">
              <q-icon :name="model.icon" size="xl" color="orange" />
            </div>
            <div class="text-h6 text-primary col-12 text-center">{{ model.icon }}</div>
            <div class="text-h6 text-primary col-12 text-center">
              <q-btn
                size="sm"
                noCaps
                color="primary"
                :label="'Reference ?'"
                target="_blank"
                href="https://fonts.google.com/icons?selected=Material+Icons"
              />
            </div>
          </div>
        </s-form>
      </div>
    </div>
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
          this.model = data
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
