<template>
  <v-container>
    <v-row justify="space-between">
      <AdminMainText>
        エリア編集
      </AdminMainText>

      <v-btn to="/area" color="success">
        エリア一覧へ戻る
      </v-btn>
    </v-row>

    <v-row>
      <v-col cols="12">
        <AreaForm :area="state.area" @delete="onDeleteAreaAddress" @submit="editArea" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { Area } from '@/lib'
import { Type } from '@/lib/enum'
import { editArea as editDBArea, getAreaByID } from '@/src/infra/firestore/Area'

export default defineComponent({
  middleware: 'admin-auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      area: {} as Area
    })

    const editArea = async (area: any) => {
      await editDBArea(context.root.$fireStore, context.root.$fireStoreObj, area, context.root.$route.params.id)

      return await context.root.$router.push('/area')
    }

    const onDeleteAreaAddress = async (address: string) => {
      console.log('done')
      const _newArea = await editDBArea(
        context.root.$fireStore,
        context.root.$fireStoreObj,
        {
          type: Type.AREA,
          id: state.area.id,
          name: state.area.name,
          addresses: state.area.addresses.filter((_address: string) => _address !== address)
        } as Area,
        context.root.$route.params.id
      )

      return await context.root.$router.push('/area')
    }

    watchEffect(async () => {
      state.area = await getAreaByID(context.root.$fireStore, context.root.$route.params.id)
    })

    return {
      state,
      editArea,
      onDeleteAreaAddress
    }
  }
})
</script>
