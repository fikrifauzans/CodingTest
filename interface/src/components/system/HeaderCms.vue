<template>
  <div v-if="!useModal">
    <q-header elevated class="bg-primary text-white" height-hint="98">
      <q-toolbar>
        <!-- LEFT MENU  -->
        <q-btn dense flat round icon="menu" size="sm" @click="toggleLeftDrawer" />
        <!-- APP NAME  -->
        <div>
          {{ app }}
        </div>
        <q-toolbar-title>
          <!-- AVATAR  -->
          <q-avatar size="sm">
            <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg" />
          </q-avatar>
        </q-toolbar-title>
        <!-- RIGHT BUTTON  -->

        <!-- REFRESH  -->
        <q-btn dense flat round icon="refresh" size="sm" @click="refresh">
          <q-tooltip>Refresh</q-tooltip>
        </q-btn>

        <!-- FULLSCREEN  -->
        <q-btn
          size="sm"
          round
          flat
          color="primary"
          class="text-white"
          @click="$q.fullscreen.toggle()"
          :icon="$q.fullscreen.isActive ? 'fullscreen_exit' : 'fullscreen'"
        >
          <q-tooltip>Fullscreen</q-tooltip>
        </q-btn>

        <!-- SETTING  -->
        <q-btn-dropdown dense flat round icon="tune" size="sm">
          <div class="q-pa-md" style="min-width: 200px">
            <q-btn-dropdown
              square
              color="primary"
              :label="$Lang.getLang()"
              size="sm"
              flat
            >
              <q-list bordered padding class="rounded-borders text-primary">
                <q-item
                  v-for="(item, index) in $Lang.list"
                  flat
                  clickable
                  dense
                  v-ripple
                  :active="link === item"
                  @click="link = $Lang.setLang(item)"
                  active-class="my-menu-link"
                >
                  <q-item-section>{{ item }}</q-item-section>
                </q-item>
              </q-list>
            </q-btn-dropdown>
          </div>
        </q-btn-dropdown>

        <!-- NOTIFICATION  -->
        <q-btn-dropdown dense flat round icon="notifications" size="sm">
          <div style="min-width: 200px">
            <div class="q-pa-md" style="max-width: 350px">
              <q-list>
                <q-item clickable>
                  <q-item-section>
                    <q-item-label>Single line item</q-item-label>
                    <q-item-label caption lines="2"
                      >Secondary line text. Lorem ipsum dolor sit amet, consectetur
                      adipiscit elit.</q-item-label
                    >
                  </q-item-section>

                  <q-item-section side top>
                    <q-item-label caption>5 min ago</q-item-label>
                    <q-icon name="star" color="yellow" />
                  </q-item-section>
                </q-item>
                <q-separator spaced inset />
              </q-list>
            </div>
          </div>
        </q-btn-dropdown>

        <q-btn dense flat round icon="menu" @click="toggleRightDrawer" size="sm" />
      </q-toolbar>
    </q-header>
    <q-drawer
      v-model="leftDrawerOpen"
      side="left"
      bordered
      persistent
      show-if-above
      no-swipe-backdrop
    >
      <!-- FILTER  -->
      <s-filter
        :table="table"
        v-if="filter && filter.value"
        @update:modelValue="(val) => updateFilter(val)"
        :model-value="modelValue"
        @closeFilter="closeFilter"
        :filter="filter"
        @refresh="$emit('refreshQuery')"
      />
      <!-- MENU  -->
      <s-menu v-else :menus="menus" />
      <div class="text-center q-mx-auto col-12 absolute-bottom row justify-center">
        <s-account class="q-mx-auto" />
      </div>
    </q-drawer>

    <q-drawer v-model="rightDrawerOpen" side="right" bordered>
      <!-- drawer content -->
    </q-drawer>
    <q-page-container :style="$Static.formHeight()">
      <q-form @submit="$emit('submit')" autofocus no-reset-focus greedy>
        <div
          class="row justify-between q-px-md q-py-sm bg-white items-center q-mb-sm"
          v-if="form == ''"
        >
          <div>
            <q-item class="q-pa-none text-primary" color="primary" v-ripple>
              <q-item-section>
                <q-item-label caption>{{ Meta ? Meta.module_name : "" }}</q-item-label>
                <q-item-label class="text-h6 text-primary"
                  >{{ Meta ? Meta.name : "" }}
                  {{ detail == "" ? "Detail" : "Form" }}</q-item-label
                >
              </q-item-section>
            </q-item>
          </div>
          <div class="q-gutter-xs">
            <q-btn
              icon="arrow_left"
              label="back"
              flat
              class="text-white bg-grey cursor-pointer"
              size="sm"
              type="button"
              @click="$emit('back')"
            />
            <q-btn
              v-if="detail != ''"
              icon="check"
              label="save"
              flat
              class="text-white bg-positive cursor-pointer"
              size="sm"
              type="submit"
            />
          </div>
        </div>

        <div v-if="table" class="bg-white q-mx-sm">
          <slot />
        </div>
        <q-scroll-area
          v-else
          class="bg-white q-mx-sm"
          style="height: calc(100vh - 180px)"
        >
          <slot />
        </q-scroll-area>
      </q-form>
    </q-page-container>

    <!-- FOOTER  -->
    <q-footer elevated class="bg-grey-2 text-dark">
      <q-toolbar>
        <div>{{ app }} Supesayan V.01</div>
      </q-toolbar>
    </q-footer>
  </div>
  <div v-else>
    <slot />
  </div>
</template>
<script>
import { ref } from "vue"

export default {
  setup() {
    return {}
  },
  watch: {
    "filter.value": function (val) {
      if (this.$q.screen.lt.md || val == true) this.leftDrawerOpen = true
    },
    modelValue: function (val) {
      this.leftDrawerOpen = true
    },
  },
  created() {
    this.appVersion()
    this.profile()
    this.link = this.$Lang.getLang()
  },
  props: ["useModal", "Meta", "form", "filter", "table", "modelValue", "detail"],
  data() {
    return {
      user: null,
      menus: null,
      app: null,
      link: "",
      leftDrawerOpen: false,
      rightDrawerOpen: false,
    }
  },
  methods: {
    appVersion() {
      this.$api.get(
        "/",
        (data, status, message, full) => {
          if (status == 200) return (this.app = message)
        },
        true
      )
    },
    profile() {
      this.$api.get(
        "me",
        (data, status, message, full) => {
          if (status == 200) {
            this.user = data
            this.menus = data.role.master_menu.menu_details
            this.$Handle.setLS("menus", this.menus)
          }
        },
        (e) => {
          if (e.status == 401) {
            this.$Handle.clearAllLS()
            this.$Handle.errorMessage(e.message)
            this.$router.push({ name: "login" })
          }
        }
      )
    },
    refresh() {
      this.$emit("refresh")
      this.profile()
    },
    closeFilter(val) {
      this.filter.value = false
      this.$emit("update:modelValue", val)
      this.$emit("closeFilter")
      this.refresh()
    },
    updateFilter(val) {
      this.$emit("update:modelValue", val)
    },
    toggleLeftDrawer() {
      this.leftDrawerOpen = !this.leftDrawerOpen
    },
    toggleRightDrawer() {
      this.rightDrawerOpen = !this.rightDrawerOpen
    },
  },
}
</script>
<style lang=""></style>
