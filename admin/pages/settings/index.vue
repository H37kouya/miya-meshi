<template>
  <v-container>
    <v-row>
      <AdminMainText>
        設定
      </AdminMainText>
    </v-row>

    <v-row class="mt-4">
      <v-col cols="12" sm="8">
        <v-card>
          <v-list>
            <v-list-item @click="logout">
              <span class="red--text">ログアウト</span>
            </v-list-item>
          </v-list>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'
import { useAuth } from '@/src/CompositonFunctions/utils/UseAuth'

export default defineComponent({
  setup (_, context: SetupContext) {
    const { logout } = useAuth(context.root)

    return {
      logout
    }
  }
})
</script>
