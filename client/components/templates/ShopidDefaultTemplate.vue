<template>
  <div>
    <HeaderShopField
      :src="shop.imageLink"
      :name="shop.name"
      :prefix-name="shop.prefixName"
    />

    <div v-if="shop.description">
      <DescriptionShopField :description="shop.description" />
    </div>

    <div class="u-light-grey-background d-flex justify-center">
      <div class="max-width-480">
        <FiveOneAdField src="/s/circle-ad.png" href="https://uu-circle20.firebaseapp.com/" />
      </div>
    </div>

    <MainText :level="2">
      当店のおすすめ
    </MainText>

    <RecommendShopField :menus="menus" />

    <v-lazy>
      <div>
        <MainText :level="2">
          メニュー
        </MainText>

        <MenuImageShopField v-if="menuImage" :src="menuImage" />

        <div v-if="menus && menus.length > 0">
          <DefaultMenuList :menus="menus" />
        </div>
      </div>
    </v-lazy>

    <v-lazy>
      <StoryShopField v-if="shop.intro" :text="shop.intro" :src="shop.imageLink" />
    </v-lazy>

    <v-lazy>
      <ContactShopField :shop="shop" />
    </v-lazy>

    <div class="u-light-grey-background">
      <div v-if="shop.latitude && shop.longitude" class="d-flex justify-center pb-6">
        <LazyMap :latitude="shop.latitude" :longitude="shop.longitude" />
      </div>
    </div>

    <v-lazy>
      <MainText :level="2">
        各種SNS
      </MainText>

      <SnsIconsShopField :shop="shop" />
    </v-lazy>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent } from '@nuxtjs/composition-api'
import { Breadcrumb, Shop, Menu } from '@/lib'
import { uniqArray } from '~/src/utils/Array'
import { DEFAULT_IMAGE } from '~/src/types/Menu'

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

      const uniq = uniqArray(props.shop.menuImageLink)
      // 画像が複数枚登録されていているとき、配列内のデフォルト画像を削除する
      return uniq.length > 1
        ? uniq.filter((val: string) => val !== DEFAULT_IMAGE)
        : uniq
    })

    const computedBreadcrumbs = computed(() => {
      return [
        ...breadcrumbs,
        { exact: true, text: props.shop.name, to: `/shops/${props.shop.id}` }
      ] as Breadcrumb[]
    })

    return {
      breadcrumbs: computedBreadcrumbs,
      menuImage
    }
  }
})
</script>
