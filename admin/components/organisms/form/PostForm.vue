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
                  maxlength="50"
                  counter
                  placeholder="宇都宮でおすすめな女子会居酒屋3店舗！"
                />

                <v-text-field
                  v-model="state.post.description"
                  label="概要"
                  outlined
                  maxlength="50"
                  counter
                  placeholder="宇都宮でおすすめな女子会居酒屋3店舗！〇〇なお店はおすすめ。"
                />
              </v-col>

              <v-col cols="4">
                <v-row>
                  <v-col cols="6" class="py-0">
                    <v-card-subtitle class="py-0">
                      公開設定
                    </v-card-subtitle>

                    <v-switch
                      v-model="state.post.release"
                      :label="state.post.release ? '公開' : '非公開'"
                      class="mt-0"
                    />
                  </v-col>

                  <v-col cols="6" class="py-0">
                    <div class="d-flex justify-end">
                      <v-btn type="submit" color="primary" large>
                        追加
                      </v-btn>
                    </div>
                  </v-col>
                </v-row>

                <v-row>
                  <v-col cols="12" class="py-0">
                    <UploadImageFile
                      :path="`/post/${uuid}`"
                      :past-image-link="state.post.image"
                      @input="(v) => state.post.image = v"
                    />
                  </v-col>
                </v-row>
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
      </v-col>

      <v-col cols="12">
        <v-card outlined class="mb-8">
          <v-card-subtitle>
            ブログコンテンツ
          </v-card-subtitle>

          <div>
            <EditorTextField
              v-model="state.post.contents"
            />
          </div>
        </v-card>

        <div class="d-flex justify-end">
          <v-btn type="submit" color="primary" large>
            追加
          </v-btn>
        </div>
      </v-col>
    </v-row>
  </v-form>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { Dish, Post } from '@/lib'
import { v4 as createUUID } from 'uuid'

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
        contents: 'ブログを書き始めよう',
        image: '',
        release: true
      } as Post
    })

    watchEffect(() => {
      if (props.post) {
        state.post = props.post
      }
    })

    const uuid = createUUID()

    const onSubmit = () => context.emit('submit', state.post)

    return {
      state,
      uuid,
      onSubmit
    }
  }
})
</script>
