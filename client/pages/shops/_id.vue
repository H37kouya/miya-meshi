<template>
  <div class="mt-4">
    <HeaderShopField
      :src="state.shop.imageLink"
      :name="state.shop.name"
      :prefix-name="state.shop.prefixName"
    />

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

      <div class="u-light-grey-background">
        <v-container>
          <div class="d-flex justify-center">
            <v-card
              :href="state.shop.menuImageLink ? state.shop.menuImageLink[0] : '/no-image.png'"
              target="_blank"
              rel="noopener"
            >
              <v-img
                :src="state.shop.menuImageLink ? state.shop.menuImageLink[0] : '/no-image.png'"
                max-width="480px"
                width="100%"
              />
            </v-card>
          </div>
        </v-container>
      </div>
    </div>

    <div v-if="state.menus && state.menus.length > 0">
      <DefaultMenuList :menus="state.menus" />
    </div>

    <div>
      <ContactShopField :shop="state.shop" />
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, reactive, SetupContext } from '@vue/composition-api'
import { Shop } from '@/src/types/Shop'
import { getShopByID } from '@/src/infra/firestore/Shop'
import { Menu } from '@/src/types/Menu'
import { getMenuListByShopID } from '@/src/infra/firestore/Menu'

export default defineComponent({
  setup (_, context: SetupContext) {
    const state = reactive({
      shop: {} as Shop,
      menus: [] as Menu[]
    })

    onMounted(async () => {
      const [shop, menus] = await Promise.all([
        getShopByID(context.root.$fireStore, context.root.$route.params.id),
        getMenuListByShopID(context.root.$fireStore, context.root.$route.params.id)
      ])
      state.shop = shop
      state.menus = menus
    })

    return {
      state
    }
  }
})
</script>
