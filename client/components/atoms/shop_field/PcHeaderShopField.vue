<template>
  <div class="header-shop-container pt-3">
    <div class="pb-2 px-4">
      <p class="mb-0 shop-prefix-name">
        {{ shop.prefixName }}
      </p>

      <h1 class="mb-0 shop-name">
        {{ shop.name }}
      </h1>
    </div>

    <v-row>
      <v-col cols="3" class="py-0 pr-0">
        <v-btn
          :to="`/shops/${shop.id}`"
          class="shop-menu-btn"
          exact-active-class="shop-active-class"
          exact
          text
          tile
          width="100%"
          height="44px"
        >
          トップ
        </v-btn>
      </v-col>

      <v-col cols="3" class="pa-0">
        <v-btn
          :to="`/shops/${shop.id}?type=dish`"
          class="shop-menu-btn"
          exact-active-class="shop-active-class"
          exact
          text
          tile
          width="100%"
          height="44px"
        >
          料理
        </v-btn>
      </v-col>

      <v-col cols="3" class="pa-0">
        <v-btn
          :to="`/shops/${shop.id}?type=pic`"
          class="shop-menu-btn"
          exact-active-class="shop-active-class"
          exact
          text
          tile
          width="100%"
          height="44px"
        >
          店舗写真
        </v-btn>
      </v-col>

      <v-col cols="3" class="py-0 pl-0">
        <v-btn
          :to="`/shops/${shop.id}?type=contact`"
          class="shop-menu-btn"
          exact
          exact-active-class="shop-active-class"
          text
          tile
          width="100%"
          height="44px"
        >
          地図・お問い合わせ
        </v-btn>
      </v-col>
    </v-row>
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
.header-shop-container {
  width: 100%;
  background: #FAF8F5;
}

.shop-name {
  font-size: 1.5rem;
  font-weight: bolder;
}

.shop-prefix-name {
  font-size: 0.9rem;
}

.shop-menu-btn {
  font-weight: bolder;
  &::before {
    transition: none;
  }
}

.shop-active-class {
  &::before {
    opacity: 1 !important;
    background: #fff;
  }
}
</style>
