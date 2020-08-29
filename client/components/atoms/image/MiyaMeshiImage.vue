<template>
  <v-img src="/s/miya-meshi.png" alt="みやメシアイコン" :width="width" v-bind="$attrs" />
</template>

<script>
export default {
  props: {
    width: {
      type: [Number, String],
      default: '120px'
    }
  }
}
</script>
