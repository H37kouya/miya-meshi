<template>
  <v-container class="pt-0 pt-sm-0">
    <v-row class="d-sm-none u-light-grey-background" justify="center">
      <v-col class="max-width-350 text-center py-3">
        <ToSearchShopButton bold width="100%" />

        <div v-if="maxShopCount" class="max-shop-count text-center pt-4">
          <p class="mb-2">
            現在の掲載店舗数<span class="max-shop-count-number">{{ maxShopCount }}</span>店舗
          </p>
        </div>

        <div v-else style="height: 60px;" />
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="12" class="pa-0">
        <div class="d-md-none text-center border-y border-dark-gray miya-meshi-about-container">
          <nuxt-link
            class="text-decoration-none w-100 d-flex justify-center align-center link"
            to="/about/miyameshi#title"
          >
            みやメシ応援隊とは
          </nuxt-link>
        </div>
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="12" md="8" class="py-0 pt-md-3 px-0 px-md-3">
        <DefaultInstaTopPageShopList :areas="areas" :insta-shops="instaShops" />

        <v-lazy>
          <MainText id="recommend_for_weekend" :level="2" class="border-b border-dark-gray">
            今週のおすすめ
          </MainText>
        </v-lazy>

        <v-lazy>
          <DefaultShopList :areas="areas" :shops="shops" justify="start" />
        </v-lazy>
      </v-col>

      <v-col cols="12" md="4" class="px-0 px-md-4 pt-0 pt-md-3">
        <pc-sidebar
          :max-shop-count="maxShopCount"
          :news-list="newsList"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api'
import { Shop, News, Area } from '@/lib'

type Props = {
  areas: Area[],
  shops: Shop[],
  instaShops: Shop[],
  newsList: News[]
}

export default defineComponent({
  props: {
    areas: {
      type: Array,
      default: () => []
    },

    shops: {
      type: Array,
      default: () => []
    },

    instaShops: {
      type: Array,
      default: () => {}
    },

    newsList: {
      type: Array,
      default: () => []
    },

    maxShopCount: {
      type: Number,
      default: undefined
    }
  }
})
</script>

<style lang="scss" scoped>
.miya-meshi-about-container {
  height: 60px;

  .link {
    height: 100%;
    font-size: 1rem;
    font-weight: bolder;
    background: #90B496;
    color: $white;
  }
}
</style>
