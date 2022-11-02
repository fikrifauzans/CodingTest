<template>
  <div>
    <q-ajax-bar ref="bar" position="top" color="amber" size="5px" skip-hijack />
  </div>
</template>

<script>
import { ref } from "vue"
export default {
  async mounted() {
    if (this.load == true) await this.loading()
  },
  props: ["load"],
  data() {
    return {
      bar: null,
    }
  },
  watch: {
    load: function (val) {
      if (val == true) this.loading()
      else this.stopLoad()
    },
  },
  methods: {
    async loading() {
      await this.$refs.bar.start()
    },
    stopLoad() {
      this.$refs.bar.stop()
    },
  },
}
</script>
