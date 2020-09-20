<template>
  <div>
    <div class="d-md-none d-flex justify-space-between align-center now-area-container">
      <div class="pl-4">
        <div class="d-flex">
          <p class="now-area mb-0">
            現在のエリア
          </p>

          <v-btn depressed text x-small color="primary" @click="onUpdateNowArea">
            現在地を更新
          </v-btn>
        </div>

        <p class="now-area-name mb-0">
          {{ area ? area.name : '不明' }}
        </p>
      </div>

      <div class="pr-4">
        <v-btn color="#d6cba6" depressed large to="/keywords/detail">
          エリアを変更
        </v-btn>
      </div>
    </div>

    <div class="search-keyword-container px-4 py-1">
      <p class="search-keyword-title my-1">
        絞り込み
      </p>

      <v-chip-group v-model="state.chips" multiple>
        <v-chip v-if="area" small filter outlined :value="area.id">
          {{ area.name }}
        </v-chip>

        <v-chip small filter outlined value="canTakeout">
          テイクアウト可
        </v-chip>
      </v-chip-group>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext } from '@nuxtjs/composition-api'
import { Area } from '@/lib'

type Props = {
  area: Area
}

type State = {
  chips: string[]
}

export default defineComponent({
  props: {
    area: {
      type: Object,
      default: undefined
    }
  },

  setup (_: Props, context: SetupContext) {
    const state = reactive<State>({
      chips: [] as string[]
    })

    const onUpdateNowArea = () => context.emit('updateNowArea')

    return {
      onUpdateNowArea,
      state
    }
  }
})
</script>

<style lang="scss" scoped>
.now-area {
  font-size: 0.8rem;
}

.now-area-name {
  font-size: 1rem;
  font-weight: bolder;
}

.now-area-container {
  border-top: 1px solid #d5ceb7;
  padding: 0.5rem 0;
}

.search-keyword-container {
  border-top: 1px solid #d5ceb7;
  border-bottom: 1px solid #d5ceb7;
}

.search-keyword-title {
  font-size: 0.7rem;
}
</style>
