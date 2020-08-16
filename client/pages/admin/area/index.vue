<template>
  <v-container>
    <v-row justify="space-between">
      <AdminMainText>
        エリア一覧
      </AdminMainText>

      <v-btn to="/admin/area/create" color="success">
        エリア追加
      </v-btn>
    </v-row>

    <v-row justify="center">
      <v-col cols="3">
        <AddressRelationAreaAdminCard />
      </v-col>
    </v-row>

    <div>
      <!-- TODO: エリア → 住所複数選択 -->
      <AdminAreaListCard :areas="state.areas" />
    </div>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { Area } from '~/src/types/Area'
import { getAreaList } from '~/src/infra/firestore/Area'

export default defineComponent({
  middleware: 'admin-auth',

  layout: 'auth',

  setup (_, context: SetupContext) {
    const state = reactive({
      areas: [] as Area[]
    })

    watchEffect(async () => {
      state.areas = await getAreaList(context.root.$fireStore)
    })

    return {
      state
    }
  }
})
</script>
