<template>
  <div class="area-container mb-8">
    <h3 class="area-title">
      店舗名で探す
    </h3>

    <div class="px-4 py-2 border-t border-dark-grey">
      <v-text-field
        v-model="valueModel"
        label="店舗名で探す"
        prepend-icon="mdi-magnify"
        clearable
      />
    </div>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, SetupContext } from '@nuxtjs/composition-api'
import { Dish } from '@/lib'

type Props = {
  dishes: Dish[],
  value: string
}

export default defineComponent({
  props: {
    dishes: {
      type: Array,
      default: () => []
    },

    value: {
      type: String,
      default: ''
    }
  },

  setup (props: Props, context: SetupContext) {
    const valueModel = computed<Props['value']>({
      get: () => props.value,
      set: v => context.emit('input', v)
    })

    return {
      valueModel
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
