<template>
  <v-form @submit.prevent="onSubmit">
    <v-row>
      <v-col cols="8">
        <v-card outlined>
          <v-card-text>
            <KeywordNameTextField
              v-model="state.keyword.name"
            />

            <KeywordPriorityTextField
              v-model="state.keyword.priority"
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
import { Keyword } from '@/lib'

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
        name: '' as Keyword['name'],
        priority: 1 as Keyword['priority']
      }
    })

    watch(() => props.keyword, (newVal, _) => {
      state.keyword.name = newVal ? newVal.name : state.keyword.name
      state.keyword.priority = newVal ? newVal.priority : state.keyword.priority
    })

    const onSubmit = () => context.emit('submit', state.keyword)

    return {
      state,
      onSubmit
    }
  }
})
</script>
