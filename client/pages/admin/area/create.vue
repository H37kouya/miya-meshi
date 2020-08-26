<template>
  <v-container>
    <v-row justify="space-between">
      <AdminMainText>
        エリア追加
      </AdminMainText>

      <v-btn to="/admin/area" color="success">
        エリア一覧へ戻る
      </v-btn>
    </v-row>

    <v-row>
      <v-col cols="12">
        <AreaForm @submit="createArea" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'
import { createArea as createDBArea } from 'miyameshi-lib/src/infra/firestore/Area'

export default defineComponent({
  middleware: 'admin-auth',

  layout: 'auth',

  setup (_: unknown, context: SetupContext) {
    const createArea = async (area: any) => {
      await createDBArea(context.root.$fireStore, context.root.$fireStoreObj, area)

      return await context.root.$router.push('/admin/area')
    }

    return {
      createArea
    }
  }
})
</script>
