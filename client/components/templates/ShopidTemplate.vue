<template>
  <div>
    <v-container class="px-0 px-md-3 py-0">
      <HeaderShopField :can-click-dish="canClickDish" :shop="shop" :area="area" />
    </v-container>

    <v-container class="px-0 px-md-3 py-0">
      <v-row class="mx-0">
        <v-col cols="12" md="8" class="px-0 px-md-3 pt-0 pt-md-3">
          <template v-if="type === 'top'">
            <ShopTypeTopField :shop="shop" :menus="menus" />
          </template>

          <template v-else-if="type === 'dish'">
            <ShopTypeDishField :shop="shop" :menus="menus" />
          </template>

          <template v-else-if="type === 'pic'">
            <ShopTypePicField :shop="shop" :menus="menus" />
          </template>

          <template v-else-if="type === 'contact'">
            <ShopTypeContactField :shop="shop" :menus="menus" />
          </template>

          <div class="my-4 mb-md-8">
            <div class="border-t border-gray mb-6">
              <ShopText :level="2">
                店舗情報
              </ShopText>
            </div>

            <div class="d-flex justify-center d-md-block">
              <v-lazy>
                <ContactShopTable :shop="shop" />
              </v-lazy>
            </div>
          </div>
        </v-col>

        <v-col cols="12" md="4" class="px-0 px-md-3 pt-0 pt-md-3">
          <ShopContactField :shop="shop" :type="type" />
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent } from '@nuxtjs/composition-api'
import { Breadcrumb, Shop, Menu, Area } from '@/lib'

const breadcrumbs = [
  { exact: true, text: 'Home', to: '/' },
  { exact: true, text: 'お店で探す', to: '/shops' }
] as Breadcrumb[]

type Props = {
  area?: Area,
  shop: Shop,
  menus: Menu[],
  type: 'dish'|'pic'|'contact'|'top'
}

export default defineComponent({
  props: {
    area: {
      type: Object,
      default: undefined
    },

    shop: {
      type: Object,
      required: true
    },

    menus: {
      type: Array,
      default: () => []
    },

    type: {
      type: String,
      default: 'top'
    }
  },

  setup (props: Props) {
    const menuImage = computed(() => {
      if (!props.shop.menuImageLink) {
        return undefined
      }

      return props.shop.menuImageLink[0]
    })

    const canClickDish = computed(() => {
      return props.menus.length > 0
    })

    const computedBreadcrumbs = computed(() => {
      return [
        ...breadcrumbs,
        { text: props.shop.name, to: `/shops/${props.shop.id}` }
      ] as Breadcrumb[]
    })

    return {
      breadcrumbs: computedBreadcrumbs,
      canClickDish,
      menuImage
    }
  }
})
</script>

<style>

</style>
