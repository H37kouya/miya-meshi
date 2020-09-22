<template>
  <div class="border-large-grey">
    <div v-if="shop.tel" class="border-b-4 border-gray">
      <div class="border-b border-dark-gray">
        <h3 class="contact-title pt-4 px-4 pb-2">
          電話
        </h3>
      </div>

      <p class="cotact-tel mb-0 px-4 py-2">{{ shop.tel }}</p>
    </div>

    <div v-if="shop.latitude && shop.longitude" class="border-b-4 border-gray">
      <div class="border-b border-dark-gray">
        <h3 class="contact-title pt-4 px-4 pb-2">
          地図
        </h3>
      </div>

      <div class="pa-2">
        <LazyMap :latitude="shop.latitude" :longitude="shop.longitude" />
      </div>
    </div>

    <div>
      <div class="border-b border-dark-gray">
        <h3 class="contact-title pt-4 px-4 pb-2">
          各種SNS
        </h3>
      </div>

      <div>
        <SnsIconsShopField :shop="shop" />
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api'
import { Shop } from '@/lib'

type Props = {
  shop: Shop
}
export default defineComponent({
  props: {
    shop: {
      type: Object,
      default: undefined
    }
  }
})
</script>

<style lang="scss" scoped>
.contact-title {
  font-size: 1.25rem;
  font-weight: bolder;
}

.cotact-tel {
  font-size: 1.5rem;
  font-weight: bolder;
}
</style>
