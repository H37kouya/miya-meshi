<template>
  <v-container>
    <v-row class="mb-4" justify="space-between">
      <AdminMainText>
        新規メニュー追加
      </AdminMainText>
    </v-row>

    <v-row />
  </v-container>
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'
import { removeUndefinedFromObject } from '@/src/utils/Object'
import { MetaInfo } from 'vue-meta'
import { MenuFormState } from '@/src/types/MenuFormState'

export default defineComponent({
  middleware: 'admin-auth',

  layout: 'auth',

  setup (_: unknown, context: SetupContext) {
    const createMenu = async (menus: MenuFormState['menu']) => {
      const addData = {
        ...removeUndefinedFromObject(menus),
        createdAt: context.root.$fireStoreObj.FieldValue.serverTimestamp(),
        updatedAt: context.root.$fireStoreObj.FieldValue.serverTimestamp()
      } as firebase.firestore.DocumentData

      await context.root.$fireStore.collection('menus').add(addData)

      return await context.root.$router.push('/admin/shops')
    }

    return {
      createMenu
    }
  },

  head (): MetaInfo {
    return {
      title: '新規店舗作成'
    }
  }
})
</script>
