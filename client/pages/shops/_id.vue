<template>
  <div>
    <v-container class="u-light-grey-background py-2 breadcrumbs-container mb-0 mb-md-3">
      <v-breadcrumbs :items="breadcrumbs" class="py-0 px-0 px-sm-6" />
    </v-container>

    <ShopidTemplate
      v-if="data && data.shop"
      :shop="data.shop"
      :menus="state.menus"
      :type="type"
    />
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, reactive, useAsync, useContext, useMeta, watchEffect } from '@nuxtjs/composition-api'
import { Shop, Menu, Breadcrumb } from '@/lib'
import { getShopByID } from '@/src/infra/firestore/Shop'
import { getMenuListByShopID } from '@/src/infra/firestore/Menu'
import { useGetScreenSize } from '@/src/CompositonFunctions/utils/UseGetScreenSize'
import { isString } from '@/src/utils/String'

const breadcrumbs = [
  { exact: true, text: 'Home', to: '/' },
  { exact: true, text: 'お店で探す', to: '/shops' }
] as Breadcrumb[]

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

    const computedBreadcrumbs = computed(() => {
      if (data.value && data.value.shop) {
        return [
          ...breadcrumbs,
          { text: data.value.shop.name, to: `/shops/${data.value.shop.id}` }
        ] as Breadcrumb[]
      } else {
        return breadcrumbs
      }
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

    useMeta({
      title: (data && data.value && data.value.shop && data.value.shop.name) || '店舗詳細ページ'
    })

    return {
      breadcrumbs: computedBreadcrumbs,
      data,
      screenMd,
      state,
      type
    }
  },

  head: {}
})
</script>

<style lang="scss" scoped>
.empty-height {
  width: 100%;
  height: 400px;
}
</style>
