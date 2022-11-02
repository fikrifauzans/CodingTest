<template>
  <s-loading :load="loading" />
  <s-drawer
    @refresh="refresh"
    :useModal="useModal"
    form
    @submit="submit"
    @back="back"
    :Meta="Meta"
  >
    <div class="row">
      <div class="col-md-6 col-12">
        <s-form class="q-px-md q-py-lg" title="Menu">
          <t-input col="12" label="name" required v-model="model.name" />
          <t-input col="12" label="path" required v-model="model.path" />
          <t-input col="12" label="link" required v-model="model.link" />
          <t-input col="12" label="icon" required v-model="model.icon" />
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
    this.Meta.model = {}
    if (this.$route.params.id) {
      this.param = this.$route.params.id ? this.$route.params.id : null
    }
    if (this.id) this.param = this.id ? this.id : null
    if (this.modal && this.modal.add === true) this.useModal = true
    if (this.modal && this.modal.edit === true) this.useModal = true
    if (this.param !== null) this.findId(this.param)
    this.$Handle.loadingStop()
  },
  data() {
    return {
      Meta,
      useModal: false,
      model: Meta.model,
      loading: false,
      edit: false,
      param: null,
    }
  },

  watch: {
    submitOnModal: function (val) {
      if (val.isTrusted) this.submit()
    },
  },
  methods: {
    findId(id) {
      let endpoint = Meta.module + "/" + id
      this.$api.get(endpoint, (data, status, message, full) => {
        if (status == 200) {
          this.model = data
          this.$Handle.loadingStop()
        }
      })
    },
    async submit() {
      this.$Handle.loadingStart()
      if (this.param !== null) await this.editData(this.param)
      else await this.postData(this.model)
    },
    editData(id) {
      let endpoint = this.Meta.module + "/" + id
      this.$api.put(endpoint, this.model, (data, status, message, full) => {
        if (status == 200) {
          this.$Handle.successMessage(message)
          this.$Handle.loadingStop()
          this.back()
        }
      })
    },
    postData(model) {
      let endpoint = this.Meta.module
      this.$api.post(endpoint, model, (data, status, message, full) => {
        if (status == 200) {
          this.$Handle.successMessage(message)
          this.$Handle.loadingStop()
          this.back()
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
