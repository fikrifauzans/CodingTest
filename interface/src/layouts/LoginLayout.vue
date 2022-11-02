<template>
  <div class="window-height window-width row">
    <div class="col-md-5 col-12 login-background">
      <q-tabs v-model="tab" class="text-primary absolute z-top" align="left">
        <q-tab name="login" label="Login" />
        <q-tab name="register" label="Sign Up" />
      </q-tabs>

      <q-card class="my-card transparent row col-12 justify-center items-center fit">
        <div class="q-pa-md col-12">
          <!-- LOGIN  -->
          <q-card-section v-if="tab == 'login'">
            <div class="text-h6 text-center text-primary q-my-lg">
              SUPERSAYAN BASECODE
            </div>
            <q-form @submit="login">
              <q-input
                label="Username"
                dense
                rounded
                outlined
                v-model="dataModel.username"
                class="q-my-md text-primary"
                color="primary"
              >
                <template v-slot:prepend>
                  <q-icon size="xs" name="person" />
                </template>
              </q-input>
              <q-input
                color="primary"
                label="Password"
                dense
                rounded
                outlined
                v-model="dataModel.password"
                class="q-my-md text-primary"
                type="password"
              >
                <template v-slot:prepend>
                  <q-icon size="xs" name="lock" />
                </template>
              </q-input>
              <div class="text-center">
                <q-btn
                  label="Submit"
                  color="primary"
                  outlined
                  class="transparent q-px-xl"
                  rounded
                  outline
                  size="md"
                  type="submit"
                />
              </div>
              <small class="text-small text-primary">Or Login With :</small>
              <!-- LOGIN WITH GOOGLE ACCOUNT  -->
              <div class="text-left q-my-md">
                <q-btn rounded outline color="primary" size="lg">
                  <i class="fa-brands fa-google text-primary"></i>
                </q-btn>
              </div>

              <!-- FORGOT PASSWORD  -->
              <div class="text-center cursor-pointer">
                <bold class="text-center text-primary">Forgot password ?</bold>
              </div>
            </q-form>
          </q-card-section>
          <q-card-section v-if="tab == 'register'">
            <div class="text-h6 text-center text-primary q-mt-md">CREATE ACCOUNT</div>

            <q-form method="post" @submit="register">
              <q-input
                dense
                label="Name"
                rounded
                outlined
                v-model="dataModel.name"
                class="q-my-md text-primary"
                color="primary"
                :rules="[(val) => !!val || 'Field is required']"
                required
              >
                <template v-slot:prepend>
                  <q-icon size="xs" name="person" />
                </template>
              </q-input>
              <q-input
                :rules="[(val) => !!val || 'Field is required']"
                dense
                color="primary"
                label="Username"
                rounded
                outlined
                v-model="dataModel.username"
                class="q-my-md text-primary"
              >
                <template v-slot:prepend>
                  <q-icon size="xs" name="lock" />
                </template>
              </q-input>
              <q-input
                dense
                color="primary"
                label="Email"
                rounded
                outlined
                v-model="dataModel.email"
                class="q-my-md text-primary"
                :rules="[(val) => !!val || 'Field is required']"
              >
                <template v-slot:prepend>
                  <q-icon size="xs" name="mail" />
                </template>
              </q-input>
              <q-input
                dense
                color="primary"
                label="Password"
                rounded
                outlined
                v-model="dataModel.password"
                class="q-my-md text-primary"
                type="password"
                :rules="[(val) => !!val || 'Field is required']"
              >
                <template v-slot:prepend>
                  <q-icon size="xs" name="lock" />
                </template>
              </q-input>
              <q-input
                dense
                color="primary"
                label="Confirm Password"
                rounded
                outlined
                v-model="dataModel.confirmPassword"
                class="q-my-md text-primary"
                type="password"
                :rules="[(val) => val == dataModel.password || 'password is not match']"
                lazy-rules
              >
                <template v-slot:prepend>
                  <q-icon size="xs" name="mail" />
                </template>
              </q-input>
              <div class="text-center">
                <q-btn
                  type="submit"
                  label="Create Account"
                  color="primary"
                  outlined
                  class="transparent q-px-xl q-mt-md"
                  rounded
                  outline
                  size="md"
                />
              </div>
            </q-form>
          </q-card-section>
        </div>
      </q-card>
    </div>
    <div class="col-md-7">
      <q-img src="~assets/images/login-background.webp" class="fit window-height" />
    </div>
  </div>
</template>
<script>
export default {
  name: "LoginLayout",
  created() {
    if (this.$Handle.getLS("_user") && this.$Handle.getLS("_token")) {
      this.$router.push({ name: "dashboard" })
    }
    // if()
  },
  data() {
    return { tab: "login", dataModel: { username: null, password: null }, errors: null }
  },
  methods: {
    register() {
      this.$api.post(
        this.tab,
        this.dataModel,
        (data, status, message, full) => {
          if (status == 200 || status == 201) {
            this.$Handle.successMessage(message)
            this.tab = "login"
            this.dataModel = {}
          }
        },
        (errorMessage) => {
          for (const [key, value] of Object.entries(errorMessage.errors)) {
            this.$Handle.errorMessage(`${value}`)
          }
        }
      )
    },
    login() {
      this.$api.post(
        this.tab,
        this.dataModel,
        (data, status, message, full) => {
          if (status == 200) {
            this.$Handle.setLS("_user", data.users)
            this.$Handle.setLS("_token", data.token)
            this.$Handle.successMessage(message)
            this.$router.push({ name: "dashboard" })
          }
        },
        (errorMessage) => {
          for (const [key, value] of Object.entries(errorMessage)) {
            this.$Handle.errorMessage(`${value}`)
          }
        }
      )
    },
  },
}
</script>
<!-- <style lang="scss">
.login-background {
  background: linear-gradient(to right, #1e3c72, #2a5298);
}
</style> -->
