<template>
  <div>
    <div class="border-b border-gray">
      <MainText :level="2">
        地図・お問い合わせ
      </MainText>
    </div>

    <div class="pa-2">
      <LazyMap :latitude="shop.latitude" :longitude="shop.longitude" :width="640" />
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
