<template>
  <div class="q-pa-md">
    <q-btn-dropdown class="glossy" color="primary" size="md" rounded :label="user.name">
      <div class="row no-wrap q-pa-md">
        <div class="column">
          <div class="text-h6 q-mb-md">Settings</div>
          <q-toggle v-model="mobileData" label="Use Mobile Data" />
          <q-toggle v-model="bluetooth" label="Bluetooth" />
        </div>

        <q-separator vertical inset class="q-mx-lg" />

        <div class="column items-center">
          <q-avatar size="72px">
            <img src="https://cdn.quasar.dev/img/boy-avatar.png" />
          </q-avatar>

          <div class="text-subtitle1 q-mt-md q-mb-xs">{{ user ? user.name : "" }}</div>

          <q-btn
            color="primary"
            label="Logout"
            push
            size="sm"
            v-close-popup
            @click="logout"
          />
        </div>
      </div>
    </q-btn-dropdown>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: null,
    }
  },
  created() {
    this.user = this.$Handle.getLS("_user")
  },
  methods: {
    logout() {
      this.$api.post("logout", {}, (data, status, message, full) => {
        if (status == 200) {
          this.$Handle.successMessage(message)
          this.$Handle.clearAllLS()
          this.$router.push({ name: "login" })
          // window.location.reload()
        }
      })
    },
  },
}
</script>
<style lang=""></style>
