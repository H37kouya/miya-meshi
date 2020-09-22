<template>
  <div>
    <div class="border-b border-gray">
      <MainText :level="2">
        店舗写真
      </MainText>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    shop: {
      type: Object,
      default: undefined
    },

    menus: {
      type: Array,
      default: () => []
    }
  }
}
</script>

<style>

</style>
