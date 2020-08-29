<template>
  <v-img src="/u-lab-icon.png" alt="U-labアイコン" :width="width" v-bind="$attrs" />
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
