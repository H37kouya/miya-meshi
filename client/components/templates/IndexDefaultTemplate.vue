<template>
  <v-container>
    <v-row>
      <v-col cols="12" md="8" class="px-0 px-md-3">
        <DefaultInstaTopPageShopList :insta-shops="instaShops" />

        <v-lazy>
          <MainText id="recommend_for_weekend" :level="2">
            今週のおすすめ
          </MainText>
        </v-lazy>

        <v-lazy>
          <DefaultShopList :areas="areas" :shops="shops" justify="center" />
        </v-lazy>
      </v-col>

      <v-col cols="12" md="4" class="px-0 px-md-8">
        <div v-if="maxShopCount" class="max-shop-count text-center text-md-left">
          <p>現在の掲載店舗数<span class="max-shop-count-number">{{ maxShopCount }}</span>店舗</p>
        </div>

        <div v-else style="height: 60px;" />

        <div class="news-list-container">
          <v-lazy>
            <MainText id="news" :level="2">
              新着情報
            </MainText>
          </v-lazy>

          <v-lazy>
            <v-row class="mx-0 mb-4" justify="center">
              <template v-for="(news, key) in newsList">
                <v-col :key="`news${key}`" cols="12" class="px-0 pt-0 px-sm-2">
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
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'
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
.max-shop-count {
  font-size: 1rem;
  font-weight: bolder;

  @include mq(md) {
    font-size: 1.2rem;
  }
}

.max-shop-count-number {
  font-size: 1.5rem;
  font-weight: 500;
  padding-left: 1rem;

  @include mq(md) {
    font-size: 2rem;
  }
}

.news-list-container {
  @include mq(md) {
    border: 1rem #f6f6f6 solid;
  }
}
</style>
