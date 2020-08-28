<template>
  <v-system-bar v-if="isVisibleSystemBar" app window color="blue lighten-5">
    <div class="d-flex bg-blue align-center" style="max-width: 100%;">
      <p class="mb-0 max-text-height-1">{{ news }}</p>

      <v-btn icon small @click="onClose">
        <v-icon>
          mdi-close
        </v-icon>
      </v-btn>
    </div>
  </v-system-bar>
</template>

<script lang="ts">
import { computed, defineComponent, reactive, SetupContext } from '@vue/composition-api'

export default defineComponent({
  setup(_, context: SetupContext) {
    const state = reactive({
      systemBar: true
    })

    const isVisibleSystemBar = computed(() => {
      return state.systemBar
    })

    const onClose = () => {
      state.systemBar = false
    }

    const news = 'メンテナンスをします。2020年8月28日全日。'
    const type = 'info'

    return {
      isVisibleSystemBar,
      onClose,
      news,
      type
    }
  }
})
</script>
