<template>
  <v-container>
    <v-row justify="space-between">
      <AdminMainText>
        店舗一覧
      </AdminMainText>

      <v-btn to="/shops/create" color="success">
        新規店舗追加
      </v-btn>
    </v-row>

    <v-row>
      <v-col cols="12">
        <AdminShopListCard :shops="state.shops" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, onMounted } from '@vue/composition-api'
import { MetaInfo } from 'vue-meta'
import { Shop } from 'miyameshi-lib'
import { getShopList } from 'miyameshi-lib/src/infra/firestore/Shop'

export default defineComponent({
  middleware: 'admin-auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      shops: [] as Shop[]
    })

    onMounted(async () => {
      state.shops = await getShopList(context.root.$fireStore, 0, true)
    })

    return {
      state
    }
  },

  head (): MetaInfo {
    return {
      title: '店舗一覧'
    }
  }
})
</script>
