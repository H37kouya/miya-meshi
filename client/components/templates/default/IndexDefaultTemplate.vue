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

    <DefaultMainText id="recommend_for_weekend" :level="2">
      今週のおすすめ
    </DefaultMainText>

    <DefaultMenuList :menus="menus" justify="center" />

    <DefaultMainText id="news" :level="2">
      新着情報
    </DefaultMainText>

    <v-row class="mx-0 mb-4" justify="center">
      <template v-for="(news, key) in newsList">
        <v-col :key="`news${key}`" cols="12" sm="4" md="3" class="px-0 pt-0 px-sm-2">
          <NewsField
            :alt="news.hashtags[0]"
            :href="news.href"
            :hashtags="news.hashtags"
            :src="news.src"
            :text="news.text"
          />
        </v-col>
      </template>
    </v-row>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'
import { Menu } from '@/src/types/Menu'
import { News } from '@/src/types/News'
import { Shop } from '@/src/types/Shop'

type Props = {
  menus: Menu[],
  instaShops: Shop[],
  newsList: News[]
}

export default defineComponent({
  props: {
    menus: {
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
