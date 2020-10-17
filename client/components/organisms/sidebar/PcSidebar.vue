<template>
  <div>
    <div class="d-none d-md-block pt-2">
      <template v-if="visibleShopCount">
        <div v-if="maxShopCount" class="max-shop-count text-center text-md-left">
          <p>現在の掲載店舗数<span class="max-shop-count-number">{{ maxShopCount }}</span>店舗</p>
        </div>

        <div v-else style="height: 60px;" />
      </template>
    </div>

    <div class="border-md-4 border-gray mb-8">
      <MainText id="news" :level="2">
        新着情報
      </MainText>

      <v-lazy>
        <v-row class="mx-0 mb-4" justify="center">
          <template v-for="(news, key) in newsList">
            <v-col :key="`news${key}`" cols="12" class="px-0 pt-0">
              <NewsField
                :alt="news.hashtags[0]"
                :href="news.href"
                :to="news.to"
                :hashtags="news.hashtags"
                :src="news.src"
                :text="news.text"
              />
            </v-col>
          </template>
        </v-row>
      </v-lazy>
    </div>

    <div class="d-none d-md-block">
      <v-card href="https://forms.gle/gAknXAaCrfsr8UdA8" target="_blank" rel="noopener" flat>
        <v-img src="/s/recruitment-shop.png" alt="掲載希望の方はこちら" />
      </v-card>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api'
import { News } from '@/lib'

type Props = {
  maxShopCount: number|undefined
  newsList: News[]
}

export default defineComponent({
  props: {
    visibleShopCount: {
      type: Boolean,
      default: true
    },

    maxShopCount: {
      type: Number,
      default: undefined
    },

    newsList: {
      type: Array,
      default: () => []
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
</style>
