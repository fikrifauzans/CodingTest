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
    <div class="q-px-md">
      <s-form class="q-px-md q-py-lg" :title="Meta.name">
        <t-select
          v-model="model.type"
          col="6"
          :options="[{ label: 'in' }, { label: 'Out' }]"
          :optionLabel="'label'"
          optionValue="label"
          label="Type"
        />
        <t-date col="6" dateTime v-model="model.date" />
        <!-- {{ model }} -->
      </s-form>
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
    const user = this.$Handle.getLS("_user")
    this.model.user_id = user.id
    this.model.is_aprove = 0
  },
  data() {
    return {
      Meta,
      useModal: false,
      model: Meta.model,
      loading: false,
      edit: false,
      param: null,
      user: null,
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
      console.log(model)
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
