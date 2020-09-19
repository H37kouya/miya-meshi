<template>
  <div>
    <v-container class="u-light-grey-background py-2 breadcrumbs-container">
      <v-breadcrumbs :items="breadcrumbs" class="py-0 px-0 px-sm-6" />
    </v-container>

    <v-container class="pa-0">
      <v-row class="mx-0">
        <v-col cols="12" md="8" class="px-0 px-md-3">
          <MainText>
            お店から探す
          </MainText>

          <div>
            <SearchAreaAndKyewordField
              :area="nowArea"
            />
          </div>

          <div>
            <div class="sales-title">
              <h3 class="pl-4 pt-4">営業中</h3>
            </div>

            <DefaultShopList :areas="areas" :shops="shops" :max-item="shops.length" />
          </div>
        </v-col>

        <v-col cols="12" md="4" class="d-none d-md-block">
          <div class="area-container">
            <h3 class="area-title">
              エリアから探す
            </h3>

            <div class="search-now-location d-flex justify-space-between pa-4">
              <p class="mb-0">
                現在地から探す
              </p>

              <v-icon>
                mdi-chevron-right
              </v-icon>
            </div>

            <div class="px-4 py-2">
              <v-chip-group>
                <v-chip small filter outlined value="canTakeout">
                  テイクアウト可
                </v-chip>
              </v-chip-group>

              <p class="text-right mb-0">
                <nuxt-link to="/keywords/detail" class="to-keyword-detail">
                  詳細検索
                </nuxt-link>
              </p>
            </div>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@nuxtjs/composition-api'
import { MetaInfo } from 'vue-meta'
import { Breadcrumb } from '@/lib'
import { useArea } from '@/src/CompositonFunctions/areas/UseArea'
import { useShop } from '@/src/CompositonFunctions/shops/UseShop'

const breadcrumbs = [
  { exact: true, text: 'Home', to: '/' },
  { exact: true, text: 'お店から探す', to: '/shops' },
] as Breadcrumb[]

export default defineComponent({
  setup (_, context: SetupContext) {
    const { areas, nowArea } = useArea(context.root)

    const { shops } = useShop(context.root)

    return {
      areas,
      breadcrumbs,
      nowArea,
      shops
    }
  },

  head: (): MetaInfo => ({
    title: 'お店から探す',
    meta: [
      { property: 'og:type', content: 'article' }
    ]
  })
})
</script>

<style lang="scss" scoped>
.sales-title {
  border-bottom: 1px solid #d5ceb7;

  h3 {
    font-size: 1.1rem;
    font-weight: bolder;
  }
}

.area-container {
  border: 1rem #f6f6f6 solid;
}

.area-title {
  font-size: 1.1rem;
  font-weight: bolder;
  padding: 1rem;
}

.search-now-location {
  color: #5a5041;
  background: #faf8f5;
  font-weight: bolder;
}

.to-keyword-detail {
  font-size: 0.8rem;
}
</style>
