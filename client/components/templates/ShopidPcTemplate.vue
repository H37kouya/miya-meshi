<template>
  <div>
    <v-container>
      <PcHeaderShopField :shop="shop" />

      <v-row>
        <v-col cols="8">
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
          <ShopContactField :shop="shop" :type="type" />
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
  menus: Menu[],
  type: 'dish'|'pic'|'contact'|'top'
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
