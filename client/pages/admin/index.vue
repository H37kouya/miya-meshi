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

    <v-row justify="center" class="mt-4">
      <v-col cols="6" md="3">
        <CardButton
          to="/"
          color="orange lighten-4"
          text="メインページ"
          text-color="grey"
          icon="mdi-home"
        />
      </v-col>

      <v-col cols="6" md="3">
        <CardButton
          to="/admin/shops"
          color="purple lighten-4"
          text="店舗一覧"
          text-color="grey"
          icon="mdi-store"
        />
      </v-col>

      <v-col cols="6" md="3">
        <CardButton
          to="/admin/shops/create"
          color="green  lighten-4"
          text="新規店舗作成"
          text-color="grey"
          icon="mdi-store"
        />
      </v-col>

      <v-col cols="6" md="3">
        <CardButton
          to="/shops"
          color="indigo lighten-4"
          text="店舗一覧"
          text-color="grey"
          icon="mdi-store"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'
import { MetaInfo } from 'vue-meta'

export default defineComponent({
  middleware: 'admin-auth',

  layout: 'auth',

  head (): MetaInfo {
    return {
      title: '管理者画面'
    }
  }
})
</script>
