<template>
  <v-row class="menu-item-container" align="center">
    <v-col cols="3" class="px-2">
      <v-card>
        <v-img :src="state.menu.image" aspect-ratio="1.2" />
      </v-card>
    </v-col>

    <v-col class="px-2">
      <div>
        <p class="menu-name mb-0">
          {{ state.menu.name }}
        </p>
        <p class="price mb-0">
          {{ priceDisplay }} 円 ({{ state.menu.isTaxIncluded ? '税込' : '税抜' }})
        </p>
      </div>
    </v-col>
  </v-row>
</template>

<script lang="ts">
import { defineComponent, SetupContext, watch, reactive, computed } from '@vue/composition-api'
import { Menu } from '@/src/types/Menu'

type Props = {
  menu: Menu
}

export default defineComponent({
  props: {
    menu: {
      type: Object,
      required: true
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive({
      menu: props.menu
    })

    const priceDisplay = computed(() => {
      if (state.menu && state.menu.price) {
        return state.menu.price.toLocaleString()
      }

      return 0
    })

    watch(() => props.menu, (newVal, _) => {
      state.menu = newVal
    })

    return {
      priceDisplay,
      state
    }
  }
})
</script>

<style lang="scss" scoped>
.menu-item-container {
  background-color: #fff;
  border-radius: 5px;
}

.menu-name {
  font-size: 0.9rem;
  word-break: break-all;
  height: 2.75rem;
}

.price {
  font-size: 0.8rem;
}
</style>
