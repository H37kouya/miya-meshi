<template>
  <div class="area-container mb-8">
    <h3 class="area-title">
      ジャンルから探す
    </h3>

    <!-- <div>
      <div class="search-now-location d-flex justify-space-between pa-4">
        <p class="mb-0">
          すべて
        </p>

        <v-icon>
          mdi-chevron-right
        </v-icon>
      </div>
    </div> -->

    <div class="px-4 py-2 border-t border-dark-grey">
      <p class="area-list-title mb-0">
        ジャンル一覧
      </p>

      <v-chip-group :value="value" column multiple @change="onChange">
        <template v-for="dish in dishes">
          <v-chip :key="dish.id" :value="dish.id" small filter outlined>
            {{ dish.name }}
          </v-chip>
        </template>
      </v-chip-group>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@nuxtjs/composition-api'
import { Dish } from '@/lib'

type Props = {
  dishes: Dish[],
  value: string[]
}

export default defineComponent({
  props: {
    dishes: {
      type: Array,
      default: () => []
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

    return {
      onChange
    }
  }
})
</script>

<style lang="scss" scoped>
.area-container {
  border: 1rem $gray solid;
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

.to-keyword-detail {
  font-size: 0.8rem;
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
