<template>
  <v-form class="w-100" @submit.prevent="onSubmit">
    <v-row>
      <v-col cols="12" sm="8">
        <v-card outlined>
          <v-card-title>メニューについて</v-card-title>

          <v-card-text class="mb-0">
            <NameMenuTextField
              v-model="state.menu.name"
              hide-details
            />
          </v-card-text>

          <div class="d-flex align-center">
            <div>
              <v-card-subtitle>
                テイクアウト可能メニューかどうか
              </v-card-subtitle>

              <v-card-text>
                <v-switch
                  v-model="state.menu.canTakeout"
                  :label="state.menu.canTakeout ? '可能' : '不可能'"
                  class="mt-0"
                />
              </v-card-text>
            </div>

            <div>
              <v-card-subtitle class="py-2">
                タグ選択
              </v-card-subtitle>

              <v-card-text>
                <v-select
                  v-model="state.menu.keywords[0]"
                  :items="keywordsListForSelect"
                  :menu-props="{ maxHeight: '400' }"
                  label="タグ選択"
                  hide-details
                />
              </v-card-text>
            </div>
          </div>
        </v-card>
      </v-col>

      <v-col cols="12" sm="4">
        <v-card outlined>
          <v-card-title>メニュー設定</v-card-title>

          <v-card-subtitle>メニュー公開設定</v-card-subtitle>

          <v-card-text class="pb-0">
            <v-switch
              v-model="state.menu.public"
              :label="state.menu.public ? '公開' : '非公開'"
              class="mt-0"
            />
          </v-card-text>

          <v-card-subtitle>優先度</v-card-subtitle>

          <v-card-text class="pb-3">
            <ShopPrioritySlider
              v-model="state.menu.priority"
            />
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="12">
        <v-card outlined>
          <v-card-title>値段設定</v-card-title>

          <v-card-text class="d-flex align-center">
            <v-col cols="8" sm="4">
              <PriceTextField
                v-model="state.menu.price"
              />
            </v-col>

            <v-col>
              <v-switch
                v-model="state.menu.isTaxIncluded"
                :label="state.menu.isTaxIncluded ? '税込' : '税抜'"
                class="mt-0"
              />
            </v-col>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="12">
        <v-card outlined>
          <v-card-title>メニュー紹介</v-card-title>

          <v-card-text>
            <DescriptionMenuTextField
              v-model="state.menu.description"
              placeholder="現在、登録しても公開ページ上に反映されません。"
            />

            <MenuIntroTextarea
              v-model="state.menu.intro"
              placeholder="現在、登録しても公開ページ上に反映されません。"
            />

            <v-row>
              <v-col cols="12" sm="4">
                <v-select
                  v-model="state.menu.dishes"
                  :items="dishesListForSelect"
                  :menu-props="{ maxHeight: '400' }"
                  label="ジャンル選択"
                  multiple
                />
              </v-col>

              <v-col cols="12" sm="4">
                <v-select
                  v-model="state.menu.keywords[0]"
                  :items="keywordsListForSelect"
                  :menu-props="{ maxHeight: '400' }"
                  label="タグ選択"
                />
              </v-col>

              <v-col cols="12" sm="4">
                <v-select
                  v-model="state.menu.timeZone"
                  :items="timeZoneSelect"
                  :menu-props="{ maxHeight: '400' }"
                  label="時間帯"
                  multiple
                />
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <v-row>
      <v-col>
        <v-card outlined>
          <v-card-title>画像設定</v-card-title>
          <v-card-subtitle>画像のアップロードをしたとき、このページの追加を必ず押してください。</v-card-subtitle>

          <v-card-text>
            <UploadImageFile
              :path="`/menus/${uuid}`"
              :past-image-link="state.menu.image"
              @input="(v) => state.menu.image = v"
            />
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <div class="d-flex justify-end">
      <v-btn type="submit" color="primary" x-large>
        追加
      </v-btn>
    </div>
  </v-form>
</template>

<script lang="ts">
import { computed, defineComponent, reactive, SetupContext, watch } from '@vue/composition-api'
import { DEFAULT_IMAGE } from '@/src/types/Menu'
import { MenuFormState } from '@/src/types/MenuFormState'
import { isMenu } from '@/src/utils/Menu'
import { Dish, Keyword, Menu } from '@/lib'
import { v4 as createUUID } from 'uuid'

type Props = {
  dishes: Dish[],
  keywords: Keyword[],
  menu?: Menu
}

export default defineComponent({
  props: {
    dishes: {
      type: Array,
      default: []
    },

    keywords: {
      type: Array,
      default: []
    },

    menu: {
      default: undefined,
      validator (v) {
        return isMenu(v)
      }
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive<MenuFormState>({
      menu: {
        name: undefined,
        description: undefined,
        intro: undefined,
        image: DEFAULT_IMAGE,
        public: true,
        dishes: [] as string[],
        keywords: [''] as string[],
        price: 0,
        priority: 3,
        isTaxIncluded: false,
        canTakeout: true,
        timeZone: [] as string[]
      }
    })

    const uuid = createUUID()

    watch(() => props.menu, (newVal, _) => {
      console.log(newVal)
      console.log(state.menu.keywords)
      state.menu.name = newVal ? newVal.name : state.menu.name
      state.menu.description = newVal ? newVal.description : state.menu.description
      state.menu.intro = newVal ? newVal.intro : state.menu.intro
      state.menu.image = newVal ? newVal.image : state.menu.image
      state.menu.public = newVal ? newVal.public : state.menu.public
      state.menu.price = newVal ? newVal.price : state.menu.price
      state.menu.priority = newVal ? newVal.priority : state.menu.priority
      state.menu.isTaxIncluded = newVal ? newVal.isTaxIncluded : state.menu.isTaxIncluded
      state.menu.canTakeout = newVal ? newVal.canTakeout : state.menu.canTakeout
      state.menu.dishes = newVal ? newVal.dishes : state.menu.dishes
      state.menu.keywords = newVal && newVal.keywords ? newVal.keywords : state.menu.keywords
      state.menu.timeZone = newVal ? newVal.timeZone : state.menu.timeZone
    })

    const dishesListForSelect = computed(() => {
      return props.dishes.map(dish => ({
        value: dish.id,
        text: dish.name,
      }))
    })

    const keywordsListForSelect = computed(() => {
      return [
        '',
        ...props.keywords.map(keyword => keyword.name)
      ]
    })

    const timeZoneSelect = computed(() => {
      return ['朝', '昼', '夜']
    })

    const onSubmit = () => context.emit('submit', state.menu)

    return {
      dishesListForSelect,
      keywordsListForSelect,
      timeZoneSelect,
      state,
      uuid,
      onSubmit
    }
  }
})
</script>
