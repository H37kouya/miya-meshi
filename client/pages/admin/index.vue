<template>
  <v-container>
    <h1>認証TOPページ</h1>

    <h2>ログイン済み</h2>
  </v-container>
</template>

<script>
import { defineComponent, reactive, SetupContext } from '@vue/composition-api'

export default defineComponent({
  middleware: 'admin-auth'
})
</script>
