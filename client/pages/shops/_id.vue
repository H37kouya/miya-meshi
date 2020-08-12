<template>
  <div class="mt-4">
    <HeaderShopField :src="state.shop.imageLink" :name="state.shop.name" />

    <div>
      <DefaultMainText :level="2">
        メニュー
      </DefaultMainText>

      <div class="u-light-grey-background">
        <v-container>
          <v-row justify="center">
            <template v-for="(menu, key) in state.menus">
              <v-col :key="key" cols="4" md="3" class="px-1">
                <MenuCard
                  v-bind="menu"
                  :src="menu.image || `/sample_niku.jpg`"
                  :to="`/shops/${menu.shopID}`"
                />
              </v-col>
            </template>
          </v-row>
        </v-container>
      </div>
    </div>

    <div>
      <DefaultMainText :level="2">
        お問い合わせ
      </DefaultMainText>
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
