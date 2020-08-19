<template>
  <div class="mt-4">
    <HeaderShopField
      :src="state.shop.imageLink"
      :name="state.shop.name"
      :prefix-name="state.shop.prefixName"
    />

    <div v-if="state.shop.description">
      <DescriptionShopField :description="state.shop.description" />
    </div>

    <div class="u-light-grey-background d-flex justify-center">
      <div class="max-width-480">
        <FiveOneAdField src="/circle-ad.png" href="https://uu-circle20.firebaseapp.com/" />
      </div>
    </div>

    <div>
      <RecommendShopField :menus="state.menus" />
    </div>

    <div>
      <DefaultMainText :level="2">
        メニュー
      </DefaultMainText>

      <MenuImageShopField v-if="menuImage" :src="menuImage" />

      <div v-if="state.menus && state.menus.length > 0">
        <DefaultMenuList :menus="state.menus" />
      </div>
    </div>

    <StoryShopField v-if="state.shop.intro" :text="state.shop.intro" :src="state.shop.imageLink" />

    <ContactShopField :shop="state.shop" />

    <div v-if="state.shop.latitude && state.shop.longitude" class="d-flex justify-center mb-4">
      <Map :latitude="state.shop.latitude" :longitude="state.shop.longitude" />
    </div>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { Shop } from '@/src/types/Shop'
import { getShopByID } from '@/src/infra/firestore/Shop'
import { Menu } from '@/src/types/Menu'
import { getMenuListByShopID } from '@/src/infra/firestore/Menu'

type State = {
  shop: Shop,
  menus: Menu[]
}

export default defineComponent({
  setup (_, context: SetupContext) {
    const state = reactive<State>({
      shop: {} as Shop,
      menus: [] as Menu[]
    })

    watchEffect(async () => {
      const [shop, menus] = await Promise.all([
        getShopByID(context.root.$fireStore, context.root.$route.params.id),
        getMenuListByShopID(context.root.$fireStore, context.root.$route.params.id)
      ])
      state.shop = shop
      state.menus = menus
    })

    const menuImage = computed(() => {
      if (!state.shop.menuImageLink) {
        return undefined
      }

      return state.shop.menuImageLink[0]
    })

    return {
      state,
      menuImage
    }
  }
})
</script>
