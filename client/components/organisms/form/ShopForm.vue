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
        <ShopPrefixNameTextField
          v-model="state.shop.prefixName"
        />
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

    <v-row>
      <v-col cols="12">
        <p>店舗紹介文</p>
      </v-col>

      <v-col cols="12">
        <ShopDescriptionTextField
          v-model="state.shop.description"
        />
      </v-col>

      <v-col cols="12">
        <ShopIntroTextarea
          v-model="state.shop.intro"
        />
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="12" md="4" class="d-flex flex-row">
        <span class="pt-1 pr-2">
          テイクアウト可能店舗かどうか
        </span>

        <v-switch
          v-model="state.shop.canTakeOut"
          :label="state.shop.canTakeOut ? '可能' : '不可能'"
          class="mt-0"
        />
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="12">
        <p>お問い合わせ</p>
      </v-col>

      <v-col cols="12" sm="6">
        <TelTextField
          v-model="state.shop.tel"
        />
      </v-col>

      <v-col cols="12" sm="6">
        <PostalTextField
          v-model="state.shop.postal"
        />
      </v-col>

      <v-col cols="12" sm="6">
        <AddressTextField
          v-model="state.shop.address"
        />
      </v-col>

      <v-col cols="12" sm="6">
        <BuildingNameTextField
          v-model="state.shop.buildingName"
        />
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="12">
        <p>リンク一覧</p>
      </v-col>

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

    <v-row>
      <v-col>
        <UploadImageFile
          :path="`/shops/${uuid.image}`"
          :past-image-link="state.shop.imageLink"
          @input="(v) => state.shop.imageLink = v"
        />
      </v-col>
    </v-row>

    <v-row>
      <v-col>
        <UploadImageFile
          :path="`/shops/${uuid.menuImage}`"
          :past-image-link="state.shop.menuImageLink[0]"
          label="メニュー画像"
          @input="(v) => state.shop.menuImageLink[0] = v"
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
import { Shop, ShopJa, DEFAULT_IMAGE } from '@/src/types/Shop'
import { ShopFormState } from '@/src/types/ShopFormState'
import { isShop } from '@/src/utils/Shop'
import { createUUID } from '@/src/utils/String'

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
        prefixName: undefined,
        name: undefined,
        description: undefined,
        intro: undefined,
        imageLink: DEFAULT_IMAGE,
        menuImageLink: [DEFAULT_IMAGE],
        facebookLink: undefined,
        homepageLink: undefined,
        instaLink: undefined,
        lineLink: undefined,
        twitterLink: undefined,
        uberEatsLink: undefined,
        youtubeLink: undefined,
        priority: 1,
        public: false,
        address: '栃木県宇都宮市',
        buildingName: undefined,
        postal: undefined,
        tel: undefined,
        canTakeout: true
      }
    })

    const uuid = {
      image: createUUID(),
      menuImage: createUUID()
    }

    watch(() => props.shop, (newVal, _) => {
      state.shop.name = newVal ? newVal.name : state.shop.name
      state.shop.prefixName = newVal ? newVal.prefixName : state.shop.prefixName
      state.shop.description = newVal ? newVal.description : state.shop.description
      state.shop.intro = newVal ? newVal.intro : state.shop.intro
      state.shop.imageLink = newVal ? newVal.imageLink : state.shop.imageLink
      state.shop.menuImageLink = newVal ? newVal.menuImageLink : state.shop.menuImageLink
      state.shop.facebookLink = newVal ? newVal.facebookLink : state.shop.facebookLink
      state.shop.homepageLink = newVal ? newVal.homepageLink : state.shop.homepageLink
      state.shop.instaLink = newVal ? newVal.instaLink : state.shop.instaLink
      state.shop.lineLink = newVal ? newVal.lineLink : state.shop.lineLink
      state.shop.twitterLink = newVal ? newVal.twitterLink : state.shop.twitterLink
      state.shop.uberEatsLink = newVal ? newVal.uberEatsLink : state.shop.uberEatsLink
      state.shop.youtubeLink = newVal ? newVal.youtubeLink : state.shop.youtubeLink
      state.shop.priority = newVal ? newVal.priority : state.shop.priority
      state.shop.public = newVal ? newVal.public : state.shop.public
      state.shop.address = newVal ? newVal.address : state.shop.address
      state.shop.buildingName = newVal ? newVal.buildingName : state.shop.buildingName
      state.shop.postal = newVal ? newVal.postal : state.shop.postal
      state.shop.tel = newVal ? newVal.tel : state.shop.tel
      state.shop.canTakeout = newVal ? newVal.canTakeout : state.shop.canTakeout
    })

    const onSubmit = () => context.emit('submit', state.shop)

    return {
      state,
      ShopJa,
      uuid,
      onSubmit
    }
  }
})
</script>
