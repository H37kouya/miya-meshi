<template>
  <v-form class="w-100" @submit.prevent="onSubmit">
    <v-row>
      <v-col cols="8">
        <v-card outlined>
          <v-card-title>店舗について</v-card-title>

          <v-card-text>
            <MenuNameTextField
              v-model="state.menu.name"
            />
          </v-card-text>
        </v-card>
      </v-col>

      <v-col cols="4">
        <v-card outlined>
          <v-card-title>サイト設定</v-card-title>

          <v-card-subtitle>店舗公開設定</v-card-subtitle>

          <v-card-text>
            <v-switch
              v-model="state.menu.public"
              :label="state.menu.public ? '公開' : '非公開'"
              class="mt-0"
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
            <v-col cols="4">
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
          <v-card-title>店舗紹介</v-card-title>

          <v-card-subtitle>
            テイクアウト可能店舗かどうか
          </v-card-subtitle>

          <v-card-text>
            <v-switch
              v-model="state.menu.canTakeOut"
              :label="state.menu.canTakeOut ? '可能' : '不可能'"
              class="mt-0"
            />

            <MenuDescriptionTextField
              v-model="state.menu.description"
            />

            <MenuIntroTextarea
              v-model="state.menu.intro"
            />
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
import { defineComponent, reactive, SetupContext, watch } from '@vue/composition-api'
import { DEFAULT_IMAGE, Menu } from '@/src/types/Menu'
import { MenuFormState } from '@/src/types/MenuFormState'
import { isMenu } from '@/src/utils/Menu'
import { createUUID } from '~/src/utils/String'

type Props = {
  menu?: Menu
}

export default defineComponent({
  props: {
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
        price: 0,
        isTaxIncluded: false,
        canTakeOut: false
      }
    })

    const uuid = createUUID()

    watch(() => props.menu, (newVal, _) => {
      state.menu.name = newVal ? newVal.name : state.menu.name
      state.menu.description = newVal ? newVal.description : state.menu.description
      state.menu.intro = newVal ? newVal.intro : state.menu.intro
      state.menu.image = newVal ? newVal.image : state.menu.image
      state.menu.public = newVal ? newVal.public : state.menu.public
      state.menu.price = newVal ? newVal.price : state.menu.price
      state.menu.isTaxIncluded = newVal ? newVal.isTaxIncluded : state.menu.isTaxIncluded
      state.menu.canTakeOut = newVal ? newVal.canTakeOut : state.menu.canTakeOut
    })

    const onSubmit = () => context.emit('submit', state.menu)

    return {
      state,
      uuid,
      onSubmit
    }
  }
})
</script>
