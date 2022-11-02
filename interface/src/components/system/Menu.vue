<template>
  <div>
    <q-list class="rounded-borders text-primary">
      <q-item
        v-if="user.id == 1"
        clickable
        v-ripple
        :active="link === 'users'"
        @click="pushRoute('users')"
        active-class="my-menu-link"
      >
        <q-item-section avatar>
          <q-icon name="person" />
        </q-item-section>

        <q-item-section>Users</q-item-section>
      </q-item>
      <q-item
        clickable
        v-ripple
        :active="link === 'inbox'"
        @click="pushRoute('espresences')"
        active-class="my-menu-link"
      >
        <q-item-section avatar>
          <q-icon name="schedule" />
        </q-item-section>

        <q-item-section>Espresences </q-item-section>
      </q-item>
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
  created() {
    this.link = this.$Handle.getSS("menus-name")
      ? JSON.parse(this.$Handle.getSS("menus-name"))
      : ""
    this.expansion = JSON.parse(this.$Handle.getSS("expansion"))
      ? JSON.parse(this.$Handle.getSS("expansion"))
      : []
  },

  data() {
    return {
      expansion: [],
      menus: null,
      user: this.$Handle.getLS("_user"),
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
      this.link = item
      this.$router.push({ name: item })
      sessionStorage.setItem("menus-name", JSON.stringify(item))
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
