<template>
  <div>
    <DefaultInstaTopPageShopList :insta-shops="instaShops" />

    <v-lazy>
      <MainText id="recommend_for_weekend" :level="2">
        今週のおすすめ
      </MainText>
    </v-lazy>

    <v-lazy>
      <DefaultMenuList :menus="menus" justify="center" />
    </v-lazy>

    <v-lazy>
      <MainText id="news" :level="2">
        新着情報
      </MainText>
    </v-lazy>

    <v-lazy>
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
    </v-lazy>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'
import { Shop, News, Menu } from '@h37kouya/miyameshi-lib'

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
