<template>
  <v-dialog v-model="state.dialog" max-width="300px">
    <template v-slot:activator="{ on, attrs }">
      <v-btn
        color="red lighten-2"
        dark
        v-bind="attrs"
        v-on="on"
      >
        {{ text }}
      </v-btn>
    </template>

    <v-card max-width="300px">
      <v-card-title class="headline grey lighten-2">
        削除しますか？
      </v-card-title>

      <v-card-text class="pt-4">
        本当に削除してもよろしいですか？
        一度、削除すると、元に戻せません。
      </v-card-text>

      <v-divider />

      <v-card-actions>
        <v-btn color="primary" text @click="state.dialog = false">
          やめる
        </v-btn>

        <v-spacer />

        <v-btn
          color="red lighten-2"
          text
          @click="onClick"
        >
          {{ text }}
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext } from '@vue/composition-api'

export default defineComponent({
  props: {
    text: {
      type: String,
      default: '削除する'
    }
  },

  setup (_, context: SetupContext) {
    const state = reactive({
      dialog: false
    })

    const onClick = () => context.emit('click')

    return {
      state,
      onClick
    }
  }
})
</script>
