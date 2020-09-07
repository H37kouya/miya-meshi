<template>
  <div>
    <v-slider
      v-model="model"
      :max="5"
      :min="1"
      dense
      step="1"
      ticks="always"
      tick-size="4"
    >
      <template #prepend>
        <v-icon
          @click="decrement"
        >
          mdi-minus
        </v-icon>
      </template>

      <template #append>
        <v-icon
          @click="increment"
        >
          mdi-plus
        </v-icon>
      </template>
    </v-slider>
  </div>
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'
import { useModel } from '@/src/CompositonFunctions/utils/UseModel'
import { Shop } from '@/lib'
import { ShopMaxStringSize } from '@/src/types/Shop'
import { Shop as ShopJa } from '@/lang/ja/Shop'

type Props = {
  value: Shop['priority']
}

export default defineComponent({
  props: {
    value: {
      type: Number,
      default: 1
    }
  },

  setup (props: Props, context: SetupContext) {
    const MAX = 5; const MIN = 1
    const { model } = useModel<Props>(props, context.emit)

    const decrement = () => {
      if (MIN < model.value) {
        context.emit('input', model.value - 1)
      }
    }

    const increment = () => {
      if (model.value < MAX) {
        context.emit('input', model.value + 1)
      }
    }

    return {
      model,
      decrement,
      increment,
      ShopJa
    }
  }
})
</script>
