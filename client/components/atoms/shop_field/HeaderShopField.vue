<template>
  <div class="px-md-3">
    <div class="d-md-none">
      <div class="d-flex justify-center header-shop w-100">
        <div class="pos-relative header-shop-wrapper">
          <a :href="shop.imageLink" target="_blank" rel="noopener">
            <v-img
              :src="shop.imageLink"
              width="480px"
              max-width="100%"
              aspect-ratio="1.78"
              min-height="210px"
            />
          </a>

          <div class="pl-4 py-2">
            <p class="mb-0 shop-prefix">
              {{ shop.prefixName }}
            </p>

            <h1 class="shop-heading max-text-height-1">
              {{ shop.name }}
            </h1>
          </div>

          <TelIconButton class="tel-pos" large :tel="shop.tel" />
        </div>
      </div>

      <DescriptionShopField v-if="shop.description" :description="shop.description" />
    </div>

    <div class="d-none d-md-block u-light-grey-background header-shop-container pt-3">
      <div class="pb-2 px-4">
        <p class="mb-0 shop-prefix-name">
          {{ shop.prefixName }}
        </p>

        <h1 class="mb-0 shop-name">
          {{ shop.name }}
        </h1>
      </div>

      <div v-if="area || shop.canTakeout || (shop.timeZone && shop.timeZone.length > 0)" class="pb-4 px-4">
        <v-chip v-if="area" outlined small>
          {{ area.name }}
        </v-chip>

        <v-chip v-if="shop.canTakeout" outlined small>
          テイクアウト可
        </v-chip>

        <template v-if="shop.timeZone && shop.timeZone.length > 0">
          <v-chip v-if="shop.timeZone.includes('朝')" outlined small>
            朝
          </v-chip>

          <v-chip v-if="shop.timeZone.includes('昼')" outlined small>
            昼
          </v-chip>

          <v-chip v-if="shop.timeZone.includes('夜')" outlined small>
            夜
          </v-chip>
        </template>
      </div>
    </div>

    <v-lazy>
      <v-container class="u-light-grey-background pa-0 header-shop-container">
        <v-row class="mx-0 header-shop-row">
          <v-col cols="3" class="py-0 px-0 pl-md-3">
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
              :disabled="!canClickDish"
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

          <v-col cols="3" class="py-0 px-0 pr-md-3">
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
              <span class="d-none d-md-block">地図・お問い合わせ</span>
              <span class="d-md-none">地図</span>
            </v-btn>
          </v-col>
        </v-row>
      </v-container>
    </v-lazy>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api'
import { Area, Shop } from '@/lib'
import { useGetScreenSize } from '@/src/CompositonFunctions/utils/UseGetScreenSize'

type Props = {
  area: Area,
  shop: Shop,
  src: string,
  prefixName: string,
  name: string
}
export default defineComponent({
  props: {
    area: {
      type: Object,
      default: undefined
    },

    canClickDish: {
      type: Boolean,
      default: true
    },

    shop: {
      type: Object,
      default: undefined
    },

    src: {
      type: String,
      default: '/no-image.png'
    },

    prefixName: {
      type: String,
      default: undefined
    },

    name: {
      type: String,
      default: undefined
    }
  },

  setup () {
    const { screenMd } = useGetScreenSize()

    return {
      screenMd
    }
  }
})
</script>

<style lang="scss" scoped>
.tel-pos {
  position: absolute;
  bottom: 0;
  right: 2.5rem;
  transform: translateY(-45%);
}

.header-shop {
  max-width: 100%;
}

.header-shop-wrapper {
  width: 480px;
  max-width: 100%;
}

.shop-prefix {
  font-size: 0.9rem;
  min-height: 1rem;
}

.shop-heading {
  font-size: 1.25rem;
  font-weight: 500;
}

.header-shop-container {
  width: 100%;

  @include mq(md) {
    background: #faf8f5;
  }
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
    background: $white;
  }
}

.header-shop-row {
  @include mq(md) {
    margin-left: -12px !important;
    margin-right: -12px !important;
  }
}
</style>
