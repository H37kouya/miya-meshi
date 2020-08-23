<template>
  <div>
    <DefaultMainText id="recommend_for_instagram">
      <div class="d-flex align-center justify-center">
        <v-icon>mdi-instagram</v-icon>
        <span>インスタからのおすすめ</span>
      </div>
    </DefaultMainText>

    <DefaultInstaShopList :shops="instaShops" />

    <div class="u-light-grey-background pb-2">
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
import { defineComponent } from '@vue/composition-api'

export default defineComponent({
  props: {
    instaShops: {
      type: Array,
      default: () => []
    }
  }
})
</script>
