<template>
  <div class="col-12">
    <q-list class="text-primary" v-for="(item, index) in menus" :key="index" v-if="menus">
      <div
        class="row col-12 items-center"
        v-if="item.menu && item.parent_id == null && item.menu.link"
      >
        <div class="column col-2">
          <div class="q-gutter-xs text-center">
            <q-btn
              size="xs"
              round
              rounded
              icon="edit"
              flat
              :color="utils.ParentBtnSwap[index] ? 'orange-3' : 'orange'"
              @click="utils.ParentBtnSwap[index] = !utils.ParentBtnSwap[index]"
            />
            <q-btn
              flat
              size="xs"
              round
              rounded
              icon="delete"
              v-if="!utils.ParentBtnSwap[index]"
              :color="utils.ParentBtnSwap[index] ? 'negative' : 'negative'"
              @click="menus.splice(index, 1)"
            />
            <q-btn
              size="xs"
              round
              rounded
              icon="expand_less"
              color="primary"
              v-if="utils.ParentBtnSwap[index]"
            />
            <q-btn
              size="xs"
              round
              rounded
              icon="keyboard_arrow_down"
              color="primary"
              v-if="utils.ParentBtnSwap[index]"
            />
          </div>
        </div>
        <div class="col-10">
          <q-item
            clickable
            v-ripple
            :active="item.menu && link === item.menu.path"
            active-class="my-menu-link"
          >
            <q-item-section avatar>
              <div class="row justify-center items-center">
                <div>
                  <q-icon :name="item && item.menu ? item.menu.icon : ''" size="sm" />
                </div>
              </div>
            </q-item-section>
            <q-item-section>{{ item && item.menu ? item.menu.name : "" }}</q-item-section>


          </q-item>
        </div>
      </div>
      <div class="row col-12" v-else>
        <div class="column col-2 q-mt-xs q-pt-sm">
          <div class="q-gutter-xs text-center">
            <q-btn
              size="xs"
              round
              rounded
              flat
              icon="edit"
              :color="utils.ParentBtnSwap[index] ? 'orange-3' : 'orange'"
              @click="utils.ParentBtnSwap[index] = !utils.ParentBtnSwap[index]"
            />
            <q-btn
              flat
              size="xs"
              round
              rounded
              icon="delete"
              v-if="!utils.ParentBtnSwap[index]"
              :color="utils.ParentBtnSwap[index] ? 'negative' : 'negative'"
              @click="menus.splice(index, 1)"
            />

            <q-btn
              size="xs"
              round
              rounded
              icon="expand_less"
              color="primary"
              v-if="utils.ParentBtnSwap[index]"
            />
            <q-btn
              size="xs"
              round
              rounded
              icon="keyboard_arrow_down"
              color="primary"
              v-if="utils.ParentBtnSwap[index]"
            />
          </div>
        </div>

        <div class="col-10">
          <q-expansion-item
            icon="person"
            label="Management Account"
            color="primary"
            class="text-primary"
            v-model="expansion[index]"
          >
            <div class="row col-12 items-center" v-for="(child, index) in item.childs">
              <div class="q-gutter-xs text-center col-3">
                <q-btn
                  flat
                  size="xs"
                  round
                  rounded
                  icon="edit"
                  :color="utils.ChildBtnSwap[index] ? 'orange-3' : 'orange'"
                  @click="utils.ChildBtnSwap[index] = !utils.ChildBtnSwap[index]"
                />
                <q-btn
                  flat
                  size="xs"
                  round
                  rounded
                  icon="delete"
                  v-if="!utils.ChildBtnSwap[index]"
                  :color="utils.ChildBtnSwap[index] ? 'negative' : 'negative'"
                  @click="item.childs.splice(index, 1)"
                />
                <q-btn
                  size="xs"
                  round
                  rounded
                  icon="expand_less"
                  color="primary"
                  v-if="utils.ChildBtnSwap[index]"
                />
                <q-btn
                  size="xs"
                  round
                  rounded
                  icon="keyboard_arrow_down"
                  color="primary"
                  v-if="utils.ChildBtnSwap[index]"
                />
              </div>
              <div class="col-9">
                <q-item
                  v-if="child && child.menu"
                  clickable
                  v-ripple
                  :active="child.menu && link === child.menu.path"
                  active-class="my-menu-link"
                >
                  <q-item-section avatar class="q-ml-md" v-if="child && child.menu">
                    <q-icon :name="child ? child.menu.icon : ''" />
                  </q-item-section>
                  <q-item-section>{{
                    child && child.menu ? child.menu.name : ""
                  }}</q-item-section>
                </q-item>
              </div>
            </div>
          </q-expansion-item>
        </div>
      </div>
    </q-list>

  </div>
</template>

<script>
import { ref } from "vue"

export default {
  setup() {
    return {
      link: ref("inbox"),
    }
  },
  props: ["menus"],
  created() {},

  data() {
    return {
      expansion: [],
      utils: {
        ParentBtnSwap: [],
        ChildBtnSwap: [],
      },
    }
  },
  watch: {
    expansion: {
      handler: function (val, oldVal) {
        this.setExpansion()
      },
      deep: true,
    },
  },
  methods: {
    pushRoute(item) {
      this.link = item.menu.path
      this.$router.push({ name: item.menu.path })
      sessionStorage.setItem("menus-name", JSON.stringify(item.menu.path))
    },
    setExpansion() {
      sessionStorage.setItem("expansion", JSON.stringify(this.expansion))
    },
  },
}
</script>

<style lang="sass">
.my-menu-link
  color: white
  background: $primary
</style>
