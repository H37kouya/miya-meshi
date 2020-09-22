<template>
  <div>
    <div class="d-md-none d-flex justify-space-between align-center now-area-container">
      <div class="pl-4">
        <p class="now-area-name mb-0 d-flex align-center">
          <v-icon size="20" color="#f44336">
            mdi-map-marker
          </v-icon>
          <span>
            {{ area ? area.name : '全て' }}
          </span>
        </p>
      </div>

      <div class="pr-4">
        <nuxt-link class="change-area text-decoration-none" to="/keywords/detail">
          <div class="d-flex align-center">
            <v-icon small>
              mdi-magnify
            </v-icon>

            <span>エリア変更</span>
          </div>
        </nuxt-link>
      </div>
    </div>

    <div class="search-keyword-container px-4 py-1">
      <p class="search-keyword-title my-1">
        絞り込み
      </p>

      <v-chip-group :value="value" multiple @change="onChange">
        <v-chip
          v-if="area"
          :value="area.id"
          class="d-md-none"
          small
          filter
          outlined
        >
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
import { defineComponent, SetupContext } from '@nuxtjs/composition-api'

type State = {
  chips: string[]
}

export default defineComponent({
  props: {
    area: {
      type: Object,
      default: undefined
    },

    value: {
      type: Array,
      default: () => []
    }
  },

  setup (_, context: SetupContext) {
    const onChange = (val: string[]) => context.emit('change', val)

    const onUpdateNowArea = () => context.emit('updateNowArea')

    return {
      onChange,
      onUpdateNowArea
    }
  }
})
</script>

<style lang="scss" scoped>
.change-area {
  font-size: 0.8rem;
}

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
