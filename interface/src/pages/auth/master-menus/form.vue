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
    <div class="q-px-md q-py-md">
      <div class="row">
        <div class="col-md-12 col-12">
          <s-form class="q-px-sm q-pb-md" :title="Meta.name">
            <t-input col="12" label="name" required v-model="model.name" />
          </s-form>
        </div>
        <div class="col-md-4 col-12 q-mb-md">
          <s-form class="q-px-sm" :title="'Add Menus'">
            <template v-slot:right>
              <div class="q-gutter-xs">
                <q-btn
                  :color="menus.type == 'parent' ? 'orange-3' : 'orange'"
                  label="parent"
                  size="sm"
                  @click="this.menus.type = 'parent'"
                />
                <q-btn
                  :color="menus.type == 'child' ? 'orange-3' : 'orange'"
                  label="child"
                  size="sm"
                  @click="this.menus.type = 'child'"
                />
              </div>
            </template>

            <div class="col-12 row" v-if="menus.type != 'parent'">
              <t-select
                label="Select Parent"
                api="menus"
                v-model="menus.parent_id"
                col="10"
                :option="menusOption"
                :optionLabel="'name'"
              />

              {{ menusOption }}

              <div class="col-2 text-center">
                <q-btn
                  color="primary"
                  class="q-mt-xs"
                  rounded
                  round
                  icon="add"
                  size="sm"
                  noCaps
                />
              </div>
            </div>
            <div class="col-12 row">
              <t-select-api
                label="Menus"
                api="menus"
                v-model="menus.value"
                multiple
                col="10"
              />
              <div class="col-2 text-center">
                <q-btn
                  color="primary"
                  class="q-mt-xs"
                  rounded
                  round
                  icon="add"
                  size="sm"
                  noCaps
                  @click="pushParent()"
                />
              </div>
            </div>

            {{ menus }}
          </s-form>
        </div>
        <!-- <div class="col-md-4 col-12 q-mb-sm"></div> -->
        <div class="col-md-8 col-12">
          <s-form class="q-px-sm" :title="'List Menus'">
            <MenuForm :menus="model.menu_details" />
          </s-form>
        </div>
      </div>
    </div>
  </s-drawer>
</template>

<script>
import Meta from "./meta"
import MenuForm from "./component/menu"
export default {
  props: ["modal", "id", "submitOnModal"],
  components: {
    MenuForm,
  },
  async created() {
    this.$Handle.loadingStart()
    this.Meta.model = {}
    if (this.$route.params.id) {
      this.param = this.$route.params.id ? this.$route.params.id : null
    }
    if (this.id) this.param = this.id ? this.id : null
    if (this.modal && this.modal.add === true) this.useModal = true
    if (this.modal && this.modal.edit === true) this.useModal = true
    if (this.param !== null) await this.findId(this.param)

    this.filterMenus()

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
      menus: { parent_id: null, value: [], type: "parent" },
      menusOption: [],
    }
  },

  watch: {
    submitOnModal: function (val) {
      if (val.isTrusted) this.submit()
    },
  },
  methods: {
    async findId(id) {
      let endpoint = Meta.module + "/" + id
      await this.$api.get(endpoint, (data, status, message, full) => {
        if (status == 200) {
          this.model = data
          this.$Handle.loadingStop()
        }
      })
    },
    async submit() {
      this.$Handle.loadingStart()
      if (this.param !== null) {
        await this.editData(this.param, this.model, this.Meta.module)
      } else await this.postData(this.model, this.Meta.module)
    },
    editData(id, model, url) {
      let endpoint = url + "/" + id
      this.$api.put(endpoint, model, (data, status, message, full) => {
        if (status == 200) {
          this.$Handle.successMessage(message)
          this.$Handle.loadingStop()
          this.back()
        }
      })
    },
    postData(model, url) {
      let endpoint = url
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
    pushParent() {
      if (this.menus.type == "child") {
        let parent = this.model.menu_details.filter((m) => {
          return m.menu_id == this.menus.parent_id
        })

        this.menus.value.forEach((element) => {
          parent[0].childs.push({
            parent_id: this.menus.parent_id,
            menu_id: element.id,
            master_menu_id: this.model.id,
            sort: parent[0].childs.length + 1,
            deleted_at: null,
            created_at: null,
            updated_at: null,
            menu: element,
            childs: [],
          })
          // console.log(parent[0])
          // console.log({
          //   parent_id: this.menus.parent_id,
          //   menu_id: element.id,
          //   master_menu_id: this.model.id,
          //   sort: parent[0].childs.length + 1,
          //   deleted_at: null,
          //   created_at: null,
          //   updated_at: null,
          //   menu: element,
          //   childs: [],
          // })
        })
      }
      if (this.menus.type == "parent") {
        this.menus.value.forEach((element) => {
          this.model.menu_details.push({
            parent_id: null,
            menu_id: element.id,
            master_menu_id: this.model.id,
            sort: this.model.menu_details.length + 1,
            deleted_at: null,
            created_at: null,
            updated_at: null,
            menu: element,
            childs: [],
          })
        })
      }
      this.menus.value = []
      this.menus.parent_id = null
    },
    filterMenus() {
      this.model.menu_details.forEach((m) => {
        this.menusOption.push(m.menu)
      })
    },
  },
}
</script>
