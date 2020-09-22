<template>
  <div>
    <v-container class="py-2">
      <v-breadcrumbs :items="breadcrumbs" class="py-0 px-0 px-sm-6" />
    </v-container>

    <v-container>
      <PcHeaderShopField :shop="shop" />

      <v-row>
        <v-col cols="8">
          <PcTopShopField :shop="shop" />

          <div>
            <div class="border-b border-gray">
              <MainText :level="2">
                おすすめの3品
              </MainText>
            </div>

            <RecommendShopField :menus="menus" />
          </div>

          <div class="mt-4">
            <div class="border-t border-gray">
              <MainText :level="2">
                店舗情報
              </MainText>
            </div>

            <div>
              <v-lazy>
                <ContactShopTable :shop="shop" />
              </v-lazy>
            </div>
          </div>
        </v-col>

        <v-col cols="4">
          <ShopContactField :shop="shop" />
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent } from '@nuxtjs/composition-api'
import { Breadcrumb, Shop, Menu } from '@/lib'

const breadcrumbs = [
  { exact: true, text: 'Home', to: '/' },
  { exact: true, text: 'お店で探す', to: '/shops' }
] as Breadcrumb[]

type Props = {
  shop: Shop,
  menus: Menu[]
}

export default defineComponent({
  props: {
    shop: {
      type: Object,
      required: true
    },

    menus: {
      type: Array,
      default: () => []
    }
  },

  setup (props: Props) {
    const menuImage = computed(() => {
      if (!props.shop.menuImageLink) {
        return undefined
      }

      return props.shop.menuImageLink[0]
    })

    const computedBreadcrumbs = computed(() => {
      return [
        ...breadcrumbs,
        { text: props.shop.name, to: `/shops/${props.shop.id}` }
      ] as Breadcrumb[]
    })

    return {
      breadcrumbs: computedBreadcrumbs,
      menuImage
    }
  }
})
</script>

<style>

</style>
