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
                  maxlength="100"
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
        <v-tabs v-model="state.tab" grow>
          <v-tab>
            ブログコンテンツ
          </v-tab>

          <v-tab>
            店舗・エリア
          </v-tab>
        </v-tabs>

        <v-tabs-items v-model="state.tab">
          <v-tab-item>
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
          </v-tab-item>

          <v-tab-item>
            <v-card width="100%" outlined class="mb-8">
              <v-card-subtitle>
                店舗選択
              </v-card-subtitle>

              <div>
                <p class="mb-0">店舗選択機能は現在作成中</p>
              </div>

              <v-card-subtitle>
                エリア選択
              </v-card-subtitle>

              <div class="ml-4" style="max-width: 300px;">
                <v-select
                  v-model="state.post.firebase_area_ids"
                  :items="areaSelectItems"
                  item-text="text"
                  item-value="value"
                  prepend-icon="mdi-map"
                  label="エリア一覧"
                  outlined
                  multiple
                />
              </div>
            </v-card>
          </v-tab-item>
        </v-tabs-items>

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
import { computed, defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { Area, Post } from '@/lib'
import { v4 as createUUID } from 'uuid'

type State = {
  post: Partial<Post>
  tab: any
}

type Props = {
  areas: Area[]
  post?: Post
}

export default defineComponent({
  props: {
    areas: {
      type: Array,
      default: () => []
    },

    post: {
      type: Object,
      default: undefined
    },

    initital: {
      type: Boolean,
      default: true
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive<State>({
      post: {
        title: '',
        description: '',
        contents: 'ブログを書き始めよう',
        image: '',
        release: true,
        firebase_area_ids: [],
        firebase_shop_ids: []
      } as Partial<Post>,
      tab: ''
    })

    watchEffect(() => {
      if (props.post) {
        state.post = props.post
      }
    })

    const uuid = createUUID()

    const onSubmit = () => {
      context.emit('submit', state.post)
    }

    const areaSelectItems = computed(() => props.areas.map((area: Area) => ({
      text: area.name,
      value: area.id
    })))

    return {
      areaSelectItems,
      state,
      uuid,
      onSubmit
    }
  }
})
</script>
