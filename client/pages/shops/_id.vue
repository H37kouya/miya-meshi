<template>
  <div class="mt-4">
    <HeaderShopField :src="state.shop.imageLink" :name="state.shop.name" />

    <div>
      <DefaultMainText :level="2">
        当店のおすすめ
      </DefaultMainText>

      <div class="u-light-grey-background" />
    </div>

    <div>
      <DefaultMainText :level="2">
        メニュー
      </DefaultMainText>

      <div class="u-light-grey-background">
        <v-container>
          <div class="d-flex justify-center">
            <v-card>
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
      <DefaultMainText :level="2">
        その他メニュー
      </DefaultMainText>

      <DefaultMenuList :menus="state.menus" />
    </div>

    <div>
      <DefaultMainText :level="2">
        お問い合わせ
      </DefaultMainText>

      <div class="u-light-grey-background" />
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
      state.shop = await getShopByID(context.root.$fireStore, context.root.$route.params.id)
      state.menus = await getMenuListByShopID(context.root.$fireStore, state.shop.id)
    })

    return {
      state
    }
  }
})
</script>
