<template>
  <div>
    <v-container class="u-light-grey-background py-2 breadcrumbs-container mb-0 mb-md-3">
      <v-breadcrumbs :items="breadcrumbs" class="py-0 px-0 px-sm-6" />
    </v-container>

    <ShopidTemplate
      :shop="shop"
      :menus="menus"
      :type="type"
    />
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import { Shop, Menu, Breadcrumb } from '@/lib'
import { getShopByID } from '@/src/infra/firestore/Shop'
import { getMenuListByShopID } from '@/src/infra/firestore/Menu'
import { isString } from '@/src/utils/String'

const breadcrumbs = [
  { exact: true, text: 'Home', to: '/' },
  { exact: true, text: 'お店で探す', to: '/shops' }
] as Breadcrumb[]

interface State {
  shop: Shop,
  menus: Menu[]
}

interface Method {

}

interface Computed {
  breadcrumbs: Breadcrumb[],
  type: 'top'|'dish'|'pic'|'contact'
}

export default Vue.extend<State, Method, Computed>({
  data () {
    return {
      shop: {} as Shop,
      menus: [] as Menu[]
    }
  },

  computed: {
    breadcrumbs () {
      if (this.shop) {
        return [
          ...breadcrumbs,
          { text: this.shop.name, to: `/shops/${this.shop.id}` }
        ] as Breadcrumb[]
      } else {
        return breadcrumbs
      }
    },

    type () {
      const _type = this.$route.query.type
      const defaultType = ['dish', 'pic', 'contact']
      if (isString(_type) && defaultType.includes(_type)) {
        return _type as 'dish'|'pic'|'contact'
      }

      return 'top'
    }
  },

  async created () {
    const shop = await getShopByID(this.$fireStore, this.$route.params.id)
    if (!shop) {
      return this.$nuxt.error({
        statusCode: 404,
        message: '指定された店舗は削除された可能性があります。'
      })
    }

    this.shop = shop
  },

  async mounted () {
    this.menus = await getMenuListByShopID(this.$fireStore, this.$route.params.id)
  },

  head() {
    return {
      title: (this.shop && this.shop.name) || '店舗詳細ページ'
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
