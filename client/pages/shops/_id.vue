<template>
  <v-container>
    <v-row>
      <v-col cols="12" md="8" class="px-0 px-sm-3">
        <ShopidDefaultTemplate v-if="data && data.shop" :shop="data.shop" :menus="state.menus" />

        <div v-else class="empty-height" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, reactive, useAsync, useContext, watchEffect } from '@nuxtjs/composition-api'
import { Shop, Menu } from '@/lib'
import { getShopByID } from '@/src/infra/firestore/Shop'
import { getMenuListByShopID } from '@/src/infra/firestore/Menu'

type State = {
  shop: Shop,
  menus: Menu[]
}

export default defineComponent({
  setup () {
    const { app, error, params } = useContext()
    const state = reactive({
      menus: [] as Menu[]
    })

    const data = useAsync<{ shop: Shop|undefined }>(async () => {
      const shop = await getShopByID(app.$fireStore, params.value.id)

      return { shop }
    }, params.value.id)

    watchEffect(() => {
      if (data.value && data.value.shop === undefined) {
        return error({
          statusCode: 404,
          message: '指定された店舗は削除された可能性があります。'
        })
      }
    })

    watchEffect(async () => {
      state.menus = await getMenuListByShopID(app.$fireStore, params.value.id)
    })

    return {
      data,
      state
    }
  }
})
</script>

<style lang="scss" scoped>
.empty-height {
  width: 100%;
  height: 400px;
}
</style>
