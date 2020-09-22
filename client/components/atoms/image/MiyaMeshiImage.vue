<template>
  <v-img src="/s/miya-meshi.png" alt="みやメシアイコン" :width="width" v-bind="$attrs" />
</template>

<script>
import { defineComponent } from '@nuxtjs/composition-api'

export default defineComponent({
  props: {
    width: {
      type: [Number, String],
      default: '120px'
    }
  }
})
</script>
