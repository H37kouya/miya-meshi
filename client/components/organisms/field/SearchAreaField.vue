<template>
  <div class="area-container mb-8">
    <h3 class="area-title">
      エリアから探す
    </h3>

    <div>
      <v-btn
        :disabled="(nowArea && value.includes(nowArea.id)) || false"
        color="#faf8f5"
        depressed
        width="100%"
        height="52px"
        class="search-now-location d-flex justify-space-between pa-4"
        @click="onSearchNowLocation"
      >
        <span>
          現在地から探す
        </span>

        <v-icon>
          mdi-chevron-right
        </v-icon>
      </v-btn>
    </div>

    <div class="area-list-container px-4 py-2">
      <div class="d-flex justify-space-between">
        <p class="area-list-title mb-0">
          現在のエリア
        </p>

        <v-btn depressed x-small color="#faf8f5" @click="onUpdateNowArea">
          現在地を更新
        </v-btn>
      </div>

      <p class="now-area-name mb-0">
        {{ nowArea ? nowArea.name : 'すべて' }}
      </p>
    </div>

    <div class="px-4 py-2">
      <p class="area-list-title mb-0">
        エリア一覧
      </p>

      <v-chip-group :value="value" column multiple @change="onChange">
        <template v-for="area in areas">
          <v-chip :key="area.id" :value="area.id" small filter outlined>
            {{ area.name }}
          </v-chip>
        </template>
      </v-chip-group>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@nuxtjs/composition-api'
import { Area } from '@/lib'

type Props = {
  areas: Area[],
  nowArea: Area,
  value: string[]
}

export default defineComponent({
  props: {
    areas: {
      type: Array,
      default: () => []
    },

    nowArea: {
      type: Object,
      default: undefined
    },

    value: {
      type: Array,
      default: () => []
    }
  },

  setup (props: Props, context: SetupContext) {
    const onChange = (value: string[]) => {
      return context.emit('change', value)
    }

    const onUpdateNowArea = () => context.emit('updateNowArea')

    const onSearchNowLocation = () => {
      const _value = props.value.slice()
      if (!_value.find((v: string) => v === props.nowArea.id)) {
        _value.push(props.nowArea.id)
      }

      return onChange(_value)
    }

    return {
      onChange,
      onSearchNowLocation,
      onUpdateNowArea
    }
  }
})
</script>

<style lang="scss" scoped>
.area-container {
  border: 1rem #f6f6f6 solid;
}

.area-title {
  font-size: 1.1rem;
  font-weight: bolder;
  padding: 1rem;
}

.search-now-location {
  color: #5a5041;
  background: #faf8f5;
  font-weight: bolder;
}

.area-list-container {
  border-bottom: 1px solid $dark-gray;
}

.area-list-title {
  font-size: 0.8rem;
}

.now-area-name {
  font-size: 1rem;
  font-weight: bolder;
}
</style>
