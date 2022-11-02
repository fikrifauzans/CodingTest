<template>
  <q-layout view="lhr lpr lFf" class="bg-grey-3">
    <router-view />
  </q-layout>
</template>

<script>
export default {
  name: "MainLayouts",
  created() {
    this.authCheck()
  },
  methods: {
    authCheck() {
      this.$api.get(
        "auth",
        (data, status, message, full) => {
          if (status == 200) {
            return true
          }
        },
        (e) => {
          if (e.status == 401) {
            this.Handle.clearAllLS()
            this.Handle.errorMessage(e.message)
            this.$router.push({ name: "login" })
          }
        }
      )
    },
  },
}
</script>
