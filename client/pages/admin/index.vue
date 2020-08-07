<template>
  <v-container>
    <h1>認証TOPページ</h1>

    <h2>ログイン済み</h2>

    <v-btn to="/admin/shops">
      Go To Shop List
    </v-btn>
  </v-container>
</template>

<script>
import { defineComponent, reactive, SetupContext } from '@vue/composition-api'

export default defineComponent({
  middleware: 'admin-auth',

  layout: 'auth'
})
</script>
