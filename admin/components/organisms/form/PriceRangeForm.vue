<template>
  <v-form @submit.prevent="onSubmit">
    <v-row>
      <v-col cols="8">
        <v-card outlined>
          <v-card-text>
            <NamePriceRangeTextField
              v-model="state.priceRange.name"
            />

            <PriorityPriceRangeTextField
              v-model="state.priceRange.priority"
            />

            <div class="d-flex justify-end">
              <v-btn type="submit" color="primary" large>
                追加
              </v-btn>
            </div>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-form>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watch } from '@vue/composition-api'
import { PriceRange } from 'miyameshi-lib'

type Props = {
  priceRange?: PriceRange
}

export default defineComponent({
  props: {
    priceRange: {
      type: Object,
      default: undefined
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive({
      priceRange: {
        name: '' as PriceRange['name'],
        priority: 10 as PriceRange['priority']
      }
    })

    watch(() => props.priceRange, (newVal, _) => {
      state.priceRange.name = newVal ? newVal.name : state.priceRange.name
      state.priceRange.priority = newVal ? newVal.priority : state.priceRange.priority
    })

    const onSubmit = () => context.emit('submit', state.priceRange)

    return {
      state,
      onSubmit
    }
  }
})
</script>
