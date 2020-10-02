<template>
  <div>
    <MainText id="recommend_for_instagram">
      <div class="d-flex align-end justify-center justify-md-start">
        <v-icon size="30">
          mdi-instagram
        </v-icon>
        <span>インスタからのおすすめ</span>
      </div>
    </MainText>

    <DefaultTopInstaShopList :areas="areas" :shops="instaShops" />

    <div class="u-light-grey-background white-md-background pb-2">
      <div class="d-flex justify-center">
        <v-container class="text-right pt-0">
          <p class="mb-0">
            <nuxt-link to="/insta" class="miya-meshi-books">
              もっとみる
            </nuxt-link>
          </p>
        </v-container>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api'
import { Shop } from '@/lib'

type Props = {
  instaShops: Shop[]
}
export default defineComponent({
  props: {
    areas: {
      type: Array,
      default: () => []
    },

    instaShops: {
      type: Array,
      default: () => []
    }
  }
})
</script>

<style lang="scss" scoped>
.miya-meshi-books {
  font-size: 0.8rem;

  &::after {
    content: '→';
  }
}
</style>
