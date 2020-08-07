<template>
  <v-form @submit.prevent="onSubmit">
    <v-row>
      <v-col cols="12">
        <v-switch
          v-model="state.shop.public"
          :label="state.shop.public ? '公開' : '非公開'"
          class="mt-0"
        />
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="8">
        <ShopNameTextField
          v-model="state.shop.name"
        />
      </v-col>

      <v-col cols="4">
        <ShopPrioritySlider
          v-model="state.shop.priority"
        />
      </v-col>
    </v-row>

    <ShopIntroTextField
      v-model="state.shop.intro"
    />

    <ShopDescriptionTextArea
      v-model="state.shop.description"
    />

    <p>リンク一覧</p>
    <v-row>
      <v-col cols="12" sm="6">
        <LinkTextField
          v-model="state.shop.facebookLink"
          :label="ShopJa.FACEBOOK_LINK"
          prepend-inner-icon="mdi-facebook"
        />
      </v-col>

      <v-col cols="12" sm="6">
        <LinkTextField
          v-model="state.shop.instaLink"
          :label="ShopJa.INSTA_LINK"
          prepend-inner-icon="mdi-instagram"
        />
      </v-col>

      <v-col cols="12" sm="6">
        <LinkTextField
          v-model="state.shop.twitterLink"
          :label="ShopJa.TWITTER_LINK"
          prepend-inner-icon="mdi-twitter"
        />
      </v-col>

      <v-col cols="12" sm="6">
        <LinkTextField
          v-model="state.shop.homepageLink"
          :label="ShopJa.HOMEPAGE_LINK"
          prepend-inner-icon="mdi-home-circle"
        />
      </v-col>

      <v-col cols="12" sm="6">
        <LinkTextField
          v-model="state.shop.lineLink"
          :label="ShopJa.LINE_LINK"
          prepend-inner-icon="mdi-alpha-l-box-outline"
        />
      </v-col>

      <v-col cols="12" sm="6">
        <LinkTextField
          v-model="state.shop.uberEatsLink"
          :label="ShopJa.UBER_EATS_LINK"
          prepend-inner-icon="mdi-alpha-u-box-outline"
        />
      </v-col>

      <v-col cols="12" sm="6">
        <LinkTextField
          v-model="state.shop.youtubeLink"
          :label="ShopJa.YOUTUBE_LINK"
          prepend-inner-icon="mdi-youtube"
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
import { Shop, ShopJa } from '@/src/types/Shop'
import { ShopFormState } from '@/src/types/ShopFormState'
import { isShop } from '@/src/utils/Shop'

type Props = {
  shop?: Shop
}

export default defineComponent({
  props: {
    shop: {
      default: undefined,
      validator (v) {
        return isShop(v)
      }
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive<ShopFormState>({
      shop: {
        name: undefined,
        description: undefined,
        intro: undefined,
        facebookLink: undefined,
        homepageLink: undefined,
        instaLink: undefined,
        lineLink: undefined,
        twitterLink: undefined,
        uberEatsLink: undefined,
        youtubeLink: undefined,
        priority: 1,
        public: false
      }
    })

    watch(() => props.shop, (newVal, _) => {
      state.shop.name = newVal ? newVal.name : undefined
      state.shop.description = newVal ? newVal.description :undefined
      state.shop.intro = newVal ? newVal.intro : undefined
      state.shop.facebookLink = newVal ? newVal.facebookLink : undefined
      state.shop.homepageLink = newVal ? newVal.homepageLink : undefined
      state.shop.instaLink = newVal ? newVal.instaLink : undefined
      state.shop.lineLink = newVal ? newVal.lineLink : undefined
      state.shop.twitterLink = newVal ? newVal.twitterLink : undefined
      state.shop.uberEatsLink = newVal ? newVal.uberEatsLink : undefined
      state.shop.youtubeLink = newVal ? newVal.youtubeLink : undefined
      state.shop.priority = newVal ? newVal.priority : 1
      state.shop.public = newVal ? newVal.public : false
    })

    const onSubmit = () => context.emit('submit', state.shop)

    return {
      state,
      ShopJa,
      onSubmit
    }
  }
})
</script>
