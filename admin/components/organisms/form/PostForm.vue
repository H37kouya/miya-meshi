<template>
  <v-form @submit.prevent="onSubmit">
    <v-row>
      <v-col cols="12">
        <v-card outlined>
          <v-card-text>
            <v-row>
              <v-col cols="12" sm="8">
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

              <v-col cols="12" sm="4">
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

                    <v-card-subtitle class="py-0">
                      公開時間
                    </v-card-subtitle>

                    <v-menu
                      ref="menu_publish_from"
                      v-model="state.menu.publish_from"
                      :close-on-content-click="false"
                      :return-value.sync="state.publish_from"
                      label="公開開始日時"
                      transition="scale-transition"
                      offset-y
                      min-width="290px"
                    >
                      <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                          v-model="state.publish_from"
                          :placeholder="state.post.publish_from"
                          label="公開開始日時"
                          prepend-icon="mdi-calendar"
                          readonly
                          v-bind="attrs"
                          v-on="on"
                        ></v-text-field>
                      </template>
                      <v-date-picker
                        v-model="state.publish_from"
                        no-title
                        scrollable
                      >
                        <v-spacer></v-spacer>
                        <v-btn
                          text
                          color="primary"
                          @click="state.menu.publish_from = false"
                        >
                          Cancel
                        </v-btn>
                        <v-btn
                          text
                          color="primary"
                          @click="$refs.menu_publish_from.save(state.publish_from)"
                        >
                          OK
                        </v-btn>
                      </v-date-picker>
                    </v-menu>

                    <v-menu
                      ref="menu_publish_to"
                      v-model="state.menu.publish_to"
                      :close-on-content-click="false"
                      :return-value.sync="state.publish_to"
                      label="公開終了日時"
                      transition="scale-transition"
                      offset-y
                      min-width="290px"
                    >
                      <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                          v-model="state.publish_to"
                          :placeholder="state.post.publish_to"
                          label="公開終了日時"
                          prepend-icon="mdi-calendar"
                          readonly
                          v-bind="attrs"
                          v-on="on"
                        ></v-text-field>
                      </template>
                      <v-date-picker
                        v-model="state.publish_to"
                        no-title
                        scrollable
                      >
                        <v-spacer></v-spacer>
                        <v-btn
                          text
                          color="primary"
                          @click="state.menu.publish_to = false"
                        >
                          Cancel
                        </v-btn>
                        <v-btn
                          text
                          color="primary"
                          @click="$refs.menu_publish_to.save(state.publish_to)"
                        >
                          OK
                        </v-btn>
                      </v-date-picker>
                    </v-menu>
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
        <v-row>
          <v-col cols="12">
            <v-card outlined>
              <v-card-text>
                <v-card-subtitle>
                  コンテンツモード
                </v-card-subtitle>

                <div>
                  <v-radio-group
                    v-model="state.post.content_mode"
                    mandatory
                  >
                    <v-radio
                      label="通常モード"
                      :value="ContentMode.NORMAL"
                    />
                    <v-radio
                      label="コンテンツ無しモード"
                      :value="ContentMode.NO_CONTENT"
                    />
                  </v-radio-group>
                </div>

                <div v-if="state.post.content_mode === ContentMode.NO_CONTENT">
                  <v-text-field
                    v-model="state.post.link"
                    label="外部リンク"
                    outlined
                    maxlength="255"
                    counter
                  />
                </div>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </v-col>

      <v-col v-if="state.post.content_mode === ContentMode.NORMAL" cols="12">
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
            <v-card width="100%" outlined class="mb-8 pb-4">
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

              <v-card-subtitle>
                店舗選択
              </v-card-subtitle>

              <div class="ml-4 pa-4 mb-4" style="border: 1px solid #333; border-radius: 5px;">
                <p class="mb-0" style="font-size: 14px;">店舗検索</p>

                <v-row>
                  <v-col cols="12" md="4">
                    <div>
                      <v-text-field
                        v-model="state.search.shopName"
                        outlined
                        hide-details
                        label="店舗名で検索"
                      />
                    </div>
                  </v-col>

                  <v-col cols="12" md="4">
                    <div>
                      <v-select
                        v-model="state.search.areaIds"
                        :items="areaSelectItems"
                        prepend-icon="mdi-map"
                        label="エリア名で検索"
                        outlined
                        hide-details
                      />
                    </div>
                  </v-col>

                  <v-col cols="12" md="4">
                    <div>
                      <v-text-field
                        v-model.number="state.search.instaNumber"
                        label="インスタ番号"
                        outlined
                        hide-details
                        type="number"
                        clearable
                      />
                    </div>
                  </v-col>
                </v-row>
              </div>

              <div class="ml-4" style="max-width: 300px;">
                <v-select
                  v-model="state.post.firebase_shop_ids"
                  :items="shopSelectItems"
                  prepend-icon="mdi-store"
                  label="店舗一覧"
                  outlined
                  multiple
                  hide-details
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
import { computed, defineComponent, reactive, SetupContext, watch, watchEffect } from '@vue/composition-api'
import { Area, Post, Shop } from '@/lib'
import { v4 as createUUID } from 'uuid'
import { filterShopsByAreas } from '~/src/utils/Shop'
import { isString } from '~/src/utils/String'
import { filterAreasByID } from '~/src/utils/Area'
import { ContentMode } from '~/lib/enum/ContentMode'

type State = {
  post: Partial<Post>
  tab: any
  menu: {
    publish_from: any
    publish_to: any
  }
  search: {
    shopName: string
    areaIds: string[]
    instaNumber: number
  }
  publish_from: string|null
  publish_to: string|null
  userChangedPublishFrom: boolean
  userChangedPublishTo: boolean
}

type Props = {
  areas: Area[]
  shops: Shop[]
  post?: Post
  type: 'edit'|'create'
}

export default defineComponent({
  props: {
    areas: {
      type: Array,
      default: () => []
    },

    shops: {
      type: Array,
      default: () => []
    },

    post: {
      type: Object,
      default: undefined
    },

    type: {
      type: String,
      default: 'edit'
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
        publish_from: null,
        publish_to: null,
        content_mode: ContentMode.NORMAL,
        link: '',
        firebase_area_ids: [],
        firebase_shop_ids: []
      } as Partial<Post>,
      tab: '',
      menu: {
        publish_from: '',
        publish_to: ''
      },
      search: {
        shopName: '',
        areaIds: [],
        instaNumber: 0
      },
      publish_from: null,
      publish_to: null,
      userChangedPublishFrom: false,
      userChangedPublishTo: false
    })

    watchEffect(() => {
      if (props.post) {
        state.post = props.post
      }
    })

    watch(() => state.publish_from, () => { state.userChangedPublishFrom = true })
    watch(() => state.publish_to, () => { state.userChangedPublishTo = true })

    const uuid = createUUID()

    const onSubmit = () => {
      if (props.type === 'create') {
        state.post.publish_from = state.publish_from
        state.post.publish_to = state.publish_to
      } else {
        if (state.userChangedPublishFrom) {
          state.post.publish_from = state.publish_from
        }

        if (state.userChangedPublishTo) {
          state.post.publish_to = state.publish_to
        }
      }
      context.emit('submit', state.post)
    }

    const filterShops = computed(() => {
      if (!state.search.shopName && state.search.areaIds.length === 0 && state.search.instaNumber === 0) {
        return props.shops
      }

      const _nameToLower = isString(state.search.shopName) ? state.search.shopName.toLowerCase() : ''
      const shops = props.shops.filter((shop: Shop) => {
        if (_nameToLower && shop.name && !shop.name.toLowerCase().includes(_nameToLower)) {
          return false
        }

        if (state.search.instaNumber !== 0 && state.search.instaNumber !== shop.instaNumber) {
          return false
        }

        return true
      })

      if (state.search.areaIds.length > 0) {
        const areas = filterAreasByID(props.areas, state.search.areaIds)
        return filterShopsByAreas(shops, areas)
      } else {
        return shops
      }
    })

    const areaSelectItems = computed(() => props.areas.map((area: Area) => ({
      text: area.name,
      value: area.id
    })))

    const shopSelectItems = computed(() => filterShops.value.map((shop: Shop) => ({
      text: `${shop.name} - ${shop.prefixName}`,
      value: shop.id
    })))

    return {
      areaSelectItems,
      shopSelectItems,
      state,
      uuid,
      onSubmit,
      ContentMode
    }
  }
})
</script>
