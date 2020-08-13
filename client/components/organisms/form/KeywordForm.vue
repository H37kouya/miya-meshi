<template>
  <v-form @submit.prevent="onSubmit">
    <v-row>
      <v-col cols="8">
        <KeywordNameTextField
          v-model="state.keyword.name"
        />
      </v-col>
    </v-row>

    <v-btn type="submit" color="primary">
      追加
    </v-btn>
  </v-form>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watch } from '@vue/composition-api'
import { Keyword } from '@/src/types/Keyword'

type Props = {
  keyword?: Keyword
}

export default defineComponent({
  props: {
    keyword: {
      type: Object,
      default: undefined
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive({
      keyword: {
        name: '' as Keyword['name']
      }
    })

    watch(() => props.keyword, (newVal, _) => {
      state.keyword.name = newVal ? newVal.name : state.keyword.name
    })

    const onSubmit = () => context.emit('submit', state.keyword)

    return {
      state,
      onSubmit
    }
  }
})
</script>
