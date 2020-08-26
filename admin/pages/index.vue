<template>
  <v-container>
    <v-row>
      <div>
        <AdminMainText>
          管理者画面
        </AdminMainText>

        <AdminMainText :level="2" class="mt-2">
          メニュー選択
        </AdminMainText>
      </div>
    </v-row>

    <v-row class="mt-4">
      <v-col cols="6" md="3">
        <TopPageAdminButton />
      </v-col>

      <v-col cols="6" md="3">
        <ListShopAdminButton />
      </v-col>

      <v-col cols="6" md="3">
        <CreateShopAdminButton />
      </v-col>

      <v-col cols="6" md="3">
        <KeywordAdminButton />
      </v-col>

      <v-col cols="6" sm="3">
        <AreaAdminButton />
      </v-col>

      <v-col cols="6" md="3">
        <MiyaMeshiInstaAdminButton />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'
import { MetaInfo } from 'vue-meta'

export default defineComponent({
  middleware: 'admin-auth',



  head (): MetaInfo {
    return {
      title: '管理者画面'
    }
  }
})
</script>
