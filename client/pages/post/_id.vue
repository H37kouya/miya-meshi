<template>
  <div>
    <v-container class="u-light-grey-background py-2 breadcrumbs-container mb-2">
      <v-breadcrumbs :items="breadcrumbs" class="py-0 px-0 px-sm-6" />
    </v-container>

    <v-container class="pa-0">
      <v-row class="mx-0">
        <v-col cols="12" md="8" class="px-0 px-md-3 py-0">
          <div class="post-title">
            <MainText>
              {{ post.title }}
            </MainText>
          </div>

          <v-container>
            <div class="d-flex justify-space-between">
              <div>
                <p class="mb-0 post-updatedat">
                  <time :datetime="post.updatedAt" class="d-flex align-center">
                    <v-icon class="mr-1">mdi-clock-time-four</v-icon><span>{{ formatUpdatedAt }}</span>
                  </time>
                </p>
              </div>

              <div v-if="state.area">
                <p class="mb-0">
                  <v-icon color="#d4573c" small>
                    mdi-map-marker
                  </v-icon>
                  {{ state.area.name }}
                </p>
              </div>
            </div>
          </v-container>

          <div v-if="post.image">
            <div class="d-flex justify-center">
              <v-img
                max-width="600px"
                width="100%"
                :alt="`${post.title} - サムネイル`"
                :src="post.image"
              />
            </div>
          </div>

          <v-container id="post_content">
            <div class="post-description">
              <p>{{ post.description }}</p>
            </div>

            <div v-if="state.shops.length > 0">
              <div id="shop_list_top" class="border-b border-dark-gray">
                <h2 class="shop-title">
                  注目のお店
                </h2>
              </div>

              <v-row>
                <v-col v-for="shop in state.shops.slice(0, screenSm ? 3 : 2)" :key="shop.id" cols="6" sm="4">
                  <ShopCard
                    :alt="`${shop.name} - thumnails`"
                    :area="computedShopArea(shop.address)"
                    :can-takeout="shop.canTakeout"
                    :can-go-to-eat="shop.canGoToEat"
                    :to="`/shops/${shop.id}`"
                    :src="shop.imageLink"
                    :name="shop.name"
                    :prefix-name="shop.prefixName"
                    :price-range="shop.priceRange"
                  />
                </v-col>
              </v-row>

              <div v-if="visibleAllShopLink" class="d-flex justify-end">
                <v-btn small color="#1976d2" text class="text-right" @click="toShopListBottom">
                  全てのお店を見る ↓
                </v-btn>
              </div>
            </div>

            <div v-if="post.contents">
              <div id="post_content_start" class="border-b border-dark-gray">
                <h2 class="shop-title">
                  本文
                </h2>
              </div>

              <div class="post-main-content">
                <div v-html="post.contents" />
              </div>
            </div>

            <div v-if="post.contents && state.shops.length > 0" class="mt-4">
              <div id="shop_list_bottom" class="border-b border-dark-gray">
                <h2 class="shop-title">
                  注目のお店
                </h2>
              </div>

              <v-row>
                <v-col v-for="shop in state.shops" :key="shop.id" cols="6" sm="4">
                  <ShopCard
                    :alt="`${shop.name} - thumnails`"
                    :area="computedShopArea(shop.address)"
                    :can-takeout="shop.canTakeout"
                    :can-go-to-eat="shop.canGoToEat"
                    :to="`/shops/${shop.id}`"
                    :src="shop.imageLink"
                    :name="shop.name"
                    :prefix-name="shop.prefixName"
                    :price-range="shop.priceRange"
                  />
                </v-col>
              </v-row>
            </div>
          </v-container>
        </v-col>

        <v-col cols="12" md="4" class="d-none d-md-block pt-0">
          <div class="border-md-4 border-gray mb-8">
            <MainText id="news" :level="2">
              新着情報
            </MainText>

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
          </div>

          <div>
            <v-card href="https://forms.gle/gAknXAaCrfsr8UdA8" target="_blank" rel="noopener" flat>
              <v-img src="/s/recruitment-shop.png" alt="掲載希望の方はこちら" />
            </v-card>
          </div>

          <div class="mt-8">
            <adsbygoogle
              ad-slot="7220123703"
            />
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script lang="ts">
import { AxiosError } from 'axios'
import { computed, defineComponent, reactive, useContext, useMeta, watchEffect } from '@nuxtjs/composition-api'
import dayjs from 'dayjs'
import VueScrollto from 'vue-scrollto'
import { Area, Breadcrumb, Shop, Post } from '@/lib'
import { Context } from '@nuxt/types'
import { getAreaByID } from '@/src/infra/firestore/Area'
import { useNews } from '~/src/CompositonFunctions/news/UseNews'
import { getShopByIDs } from '~/src/infra/firestore/Shop'
import { computedShortShopAddress, getShopAreaByAddress } from '~/src/utils/Shop'
import { useArea } from '~/src/CompositonFunctions/areas/UseArea'
import { useGetScreenSize } from '~/src/CompositonFunctions/utils/UseGetScreenSize'
import { getSelectionPost } from '~/src/infra/backend/SelectionPost'

const breadcrumbs = [
  { exact: true, text: 'Home', to: '/' },
  { exact: true, text: 'ブログ一覧', to: '/post' }
] as Breadcrumb[]

export default defineComponent({
  validate (ctx: Context) {
    return Number.isInteger(Number(ctx.params.id))
  },

  setup () {
    const state = reactive({
      area: {} as Area|undefined,
      shops: [] as Shop[]
    })
    const { newsList } = useNews()

    const ctx = useContext()

    const { areas } = useArea(ctx.store)

    const { screenSm } = useGetScreenSize()

    const post = computed(() => ctx.store.getters['post/post'] as Post)

    const toShopListBottom = () => {
      VueScrollto.scrollTo('#shop_list_bottom')
    }

    const formatUpdatedAt = computed(() => dayjs(post.value.updatedAt).format('YYYY年MM月DD日'))

    const newBreadcrumbs = computed(() => [
      ...breadcrumbs,
      {
        text: post.value.title,
        to: `/post/${ctx.params.value.id}`
      }
    ])

    const computedShopArea = computed(() => {
      return (address: Shop['address']) => {
        if (areas.value) {
          const area = getShopAreaByAddress(address, areas.value)
          if (area) {
            return area.name
          }
        }

        if (address) {
          if (address.includes('宇都宮')) {
            return computedShortShopAddress(address)
          } else {
            return '宇都宮市外'
          }
        }

        return undefined
      }
    })

    const visibleAllShopLink = computed(() => {
      const max = screenSm ? 3 : 2
      return state.shops.length > max
    })

    useMeta({
      title: post.value.title || 'ブログ'
    })

    watchEffect(async () => {
      state.area = post.value && post.value.firebase_area_ids && post.value.firebase_area_ids.length > 0
        ? await getAreaByID(ctx.$fireStore, post.value.firebase_area_ids[0])
        : undefined
    })

    watchEffect(async () => {
      if (post.value.firebase_shop_ids && post.value.firebase_shop_ids.length > 0) {
        state.shops = await getShopByIDs(ctx.$fireStore, ctx.$fireStoreObj, post.value.firebase_shop_ids)
      }
    })

    return {
      state,
      screenSm,
      newsList,
      visibleAllShopLink,
      computedShopArea,
      breadcrumbs: newBreadcrumbs,
      formatUpdatedAt,
      post,
      toShopListBottom
    }
  },

  async asyncData ({ $axios, store, params, error }) {
    store.commit('post/clearPost')

    try {
      const post = await getSelectionPost(Number(params.id), $axios)

      store.commit('post/setPost', post)
    } catch (_e) {
      const e = _e as AxiosError<any>

      if (e.response && e.response.status === 404) {
        return error({
          statusCode: 404,
          message: 'Page Not Found.'
        })
      }

      return error({
        statusCode: 500,
        message: 'Internal Server Error'
      })
    }
  },

  head: {}
})
</script>

<style lang="scss" scoped>
.post-title {
  background: #faf8f5;
}

.shop-title {
  font-size: 1rem;
  font-weight: bolder;
}

.post-description {
  font-weight: bolder;
  font-size: 1rem;
}

.post-updatedat {
  font-size: 0.8rem;
}
</style>
