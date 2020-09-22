<template>
  <div>
    <PcTopShopField :shop="shop" />

    <div>
      <div class="border-b border-gray">
        <MainText :level="2">
          おすすめの3品
        </MainText>
      </div>

      <RecommendShopField :menus="menus" />
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
