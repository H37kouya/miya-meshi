<template>
  <div>
    <v-container class="u-light-grey-background py-2 breadcrumbs-container mb-2">
      <v-breadcrumbs :items="breadcrumbs" class="py-0 px-0 px-sm-6" />
    </v-container>

    <v-container>
      <v-row>
        <v-col cols="12" class="px-0 px-sm-3">
          <template v-if="!screenMd">
            <div v-if="data && data.shop" class="d-md-none">
              <ShopidDefaultTemplate
                :shop="data.shop"
                :menus="state.menus"
              />
            </div>

            <div v-else class="empty-height" />
          </template>

          <template v-else>
            <div class="d-none d-md-block">
              <ShopidPcTemplate
                v-if="data && data.shop"
                :shop="data.shop"
                :menus="state.menus"
                :type="type"
              />
            </div>
          </template>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, reactive, useAsync, useContext, watchEffect } from '@nuxtjs/composition-api'
import { Shop, Menu } from '@/lib'
import { getShopByID } from '@/src/infra/firestore/Shop'
import { getMenuListByShopID } from '@/src/infra/firestore/Menu'
import { useGetScreenSize } from '@/src/CompositonFunctions/utils/UseGetScreenSize'
import { isString } from '@/src/utils/String'

type State = {
  shop: Shop,
  menus: Menu[]
}

export default defineComponent({
  setup () {
    const { app, error, params, query } = useContext()
    const state = reactive({
      menus: [] as Menu[]
    })

    const { screenMd } = useGetScreenSize()

    const data = useAsync<{ shop: Shop|undefined }>(async () => {
      const shop = await getShopByID(app.$fireStore, params.value.id)

      return { shop }
    }, params.value.id)

    const type = computed(() => {
      const _type = query.value.type
      const defaultType = ['dish', 'pic', 'contact']
      if (isString(_type) && defaultType.includes(_type)) {
        return _type as 'dish'|'pic'|'contact'
      }

      return 'top'
    })

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
      screenMd,
      state,
      type
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
