<template>
  <v-form @submit.prevent="onSubmit">
    <v-row>
      <v-col cols="12">
        <v-card outlined>
          <v-card-text>
            <v-row>
              <v-col cols="8">
                <v-text-field
                  v-model="state.post.title"
                  label="ブログタイトル"
                  outlined
                />

                <v-text-field
                  v-model="state.post.description"
                  label="概要 (50文字以下)"
                  outlined
                  placeholder="宇都宮でおすすめな女子会居酒屋3店舗！〇〇なお店はおすすめ。"
                />
              </v-col>

              <v-col cols="4">
                <v-switch
                  v-model="state.post.release"
                  :label="state.post.release ? '公開' : '非公開'"
                  class="mt-0"
                />
              </v-col>
            </v-row>
          </v-card-text>

          <div>
            <EditorTextField />
          </div>

          <div class="d-flex justify-end">
            <v-btn type="submit" color="primary" large>
              追加
            </v-btn>
          </div>
        </v-card>
      </v-col>
    </v-row>
  </v-form>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { Dish, Post } from '@/lib'

type State = {
  post: Post
}

type Props = {
  post?: Post
}

export default defineComponent({
  props: {
    post: {
      type: Object,
      default: undefined
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive<State>({
      post: {
        title: '',
        description: '',
        longText: '',
        image: '',
        release: true
      } as Post
    })

    watchEffect(() => {
      if (props.post) {
        state.post = props.post
      }
    })

    const onSubmit = () => context.emit('submit', state.post)

    return {
      state,
      onSubmit
    }
  }
})
</script>
