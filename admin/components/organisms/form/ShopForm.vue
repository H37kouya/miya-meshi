<template>
  <v-form class="w-100" @submit.prevent="onSubmit">
    <v-row>
      <v-col cols="12" sm="8">
        <v-card outlined>
          <v-card-title>店舗について</v-card-title>

          <v-card-text>
            <PrefixNameShopTextField
              v-model="state.shop.prefixName"
            />

            <NameShopTextField
              v-model="state.shop.name"
            />
          </v-card-text>
        </v-card>
      </v-col>

      <v-col cols="12" sm="4">
        <v-card outlined>
          <v-card-title class="pb-2 pb-sm-4">サイト設定</v-card-title>

          <v-row>
            <v-col class="py-2 py-sm-4" cols="6">
              <v-card-subtitle class="py-2 py-sm-4">店舗公開設定</v-card-subtitle>
              <v-card-text class="pb-0">
                <v-switch
                  v-model="state.shop.public"
                  :label="state.shop.public ? '公開' : '非公開'"
                  class="mt-0"
                />
              </v-card-text>
            </v-col>

            <v-col class="py-2 py-sm-4" cols="6">
              <v-card-subtitle class="py-2 py-sm-4">公開モード</v-card-subtitle>
              <v-card-text class="pb-0">
                <v-switch
                  v-model="state.shop.displayMode"
                  :label="state.shop.displayMode === displayMode.SIMPLE ? '簡易掲載' : '通常公開'"
                  :true-value="displayMode.DEFAULT"
                  :false-value="displayMode.SIMPLE"
                  class="mt-0"
                />
              </v-card-text>
              <p class="font-small mb-0">現在、「{{ state.shop.displayMode === displayMode.SIMPLE ? '簡易掲載' : '通常公開' }}」です。</p>
            </v-col>
          </v-row>

          <v-card-subtitle>優先度</v-card-subtitle>
          <v-card-text class="pb-3">
            <ShopPrioritySlider
              v-model="state.shop.priority"
            />
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="12">
        <v-card outlined>
          <v-card-title>店舗紹介</v-card-title>

          <v-row>
            <v-col cols="12" sm="8" class="mb-0 mb-sm-3">
              <v-card-text class="pb-0">
                <DescriptionShopTextField
                  v-model="state.shop.description"
                />

                <ShopIntroTextarea
                  v-model="state.shop.intro"
                />
              </v-card-text>

              <v-card-subtitle>
                テイクアウト可能店舗かどうか
              </v-card-subtitle>

              <v-card-text>
                <v-switch
                  v-model="state.shop.canTakeout"
                  :label="state.shop.canTakeout ? '可能' : '不可能'"
                  class="mt-0"
                />

                <v-select
                  v-model="state.shop.priceRange"
                  :items="priceRangeListForSelect"
                  label="価格帯"
                />
              </v-card-text>
            </v-col>

            <v-col cols="12" sm="4" class="mt-0 mt-sm-3">
              <v-card-text>
                <DialogWithTimePicker
                  v-model="state.shop.businessStartHour1"
                  label="営業開始時間1"
                />

                <DialogWithTimePicker
                  v-model="state.shop.businessEndHour1"
                  label="営業終了時間1"
                />

                <DialogWithTimePicker
                  v-model="state.shop.businessLoHour1"
                  label="ラストオーダー1"
                />

                <DialogWithTimePicker
                  v-model="state.shop.businessStartHour2"
                  label="営業開始時間2"
                />

                <DialogWithTimePicker
                  v-model="state.shop.businessEndHour2"
                  label="営業終了時間2"
                />

                <DialogWithTimePicker
                  v-model="state.shop.businessLoHour2"
                  label="ラストオーダー2"
                />

                <RegularHolidayShopTextField
                  v-model="state.shop.regularHoliday"
                />

                <SeatShopTextField
                  v-model="state.shop.seat"
                />

                <v-select
                  v-model="state.shop.dishes"
                  :items="dishesListForSelect"
                  :menu-props="{ maxHeight: '400' }"
                  label="料理選択"
                  multiple
                />

                <v-select
                  v-model="state.shop.keywords"
                  :items="keywordsListForSelect"
                  :menu-props="{ maxHeight: '400' }"
                  label="キーワード選択"
                  multiple
                />

                <v-select
                  v-model="state.shop.timeZone"
                  :items="timeZoneJa"
                  :menu-props="{ maxHeight: '400' }"
                  label="時間帯"
                  multiple
                />
              </v-card-text>
            </v-col>
          </v-row>
        </v-card>
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="12" sm="8">
        <v-card outlined>
          <v-card-title>お問い合わせ</v-card-title>

          <v-card-text class="d-flex">
            <v-col cols="12">
              <TelTextField
                v-model="state.shop.tel"
              />

              <v-row>
                <v-col cols="8">
                  <PostalTextField
                    v-model="state.shop.postal"
                  />
                </v-col>

                <v-col cols="4">
                  <v-btn color="primary" large @click="onGetAddressByPostal">
                    住所検索
                  </v-btn>
                </v-col>
              </v-row>

              <AddressTextField
                v-model="state.shop.address"
              />

              <BuildingNameTextField
                v-model="state.shop.buildingName"
              />

              <v-btn color="primary" class="mb-2" @click="onGetAddress">
                住所から緯度経度を取得
              </v-btn>

              <v-row>
                <v-col cols="12" sm="6">
                  <v-text-field
                    v-model.number="state.shop.latitude"
                    :label="ShopJa.LATITUDE"
                    outlined
                    type="number"
                    step="0.0001"
                  />
                </v-col>

                <v-col cols="12" sm="6">
                  <v-text-field
                    v-model.number="state.shop.longitude"
                    :label="ShopJa.LONGITUDE"
                    type="number"
                    step="0.0001"
                    outlined
                  />
                </v-col>
              </v-row>
            </v-col>
          </v-card-text>
        </v-card>
      </v-col>

      <v-col cols="12" sm="4">
        <v-card outlined>
          <v-card-title>みやメシ応援隊のインスタ</v-card-title>

          <v-card-text>
            <v-text-field
              v-model.number="state.shop.instaNumber"
              :label="ShopJa.INSTA_NUMBER"
              type="number"
              prefix="No."
              outlined
            />

            <LinkTextField
              v-model="state.shop.instaShopLink"
              :label="ShopJa.INSTA_SHOP_LINK"
            />
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="12">
        <v-card outlined>
          <v-card-title>リンク一覧</v-card-title>

          <v-card-text>
            <v-row>
              <v-col cols="12" sm="6" class="pb-0 pb-sm-3">
                <LinkTextField
                  v-model="state.shop.facebookLink"
                  :label="ShopJa.FACEBOOK_LINK"
                  prepend-inner-icon="mdi-facebook"
                />

                <LinkTextField
                  v-model="state.shop.instaLink"
                  :label="ShopJa.INSTA_LINK"
                  prepend-inner-icon="mdi-instagram"
                />

                <LinkTextField
                  v-model="state.shop.twitterLink"
                  :label="ShopJa.TWITTER_LINK"
                  prepend-inner-icon="mdi-twitter"
                />

                <LinkTextField
                  v-model="state.shop.uberEatsLink"
                  :label="ShopJa.UBER_EATS_LINK"
                  prepend-inner-icon="mdi-alpha-u-box-outline"
                />
              </v-col>

              <v-col cols="12" sm="6" class="pt-0 pt-sm-3">
                <LinkTextField
                  v-model="state.shop.homepageLink"
                  :label="ShopJa.HOMEPAGE_LINK"
                  prepend-inner-icon="mdi-home-circle"
                />

                <LinkTextField
                  v-model="state.shop.lineLink"
                  :label="ShopJa.LINE_LINK"
                  prepend-inner-icon="mdi-alpha-l-box-outline"
                />

                <LinkTextField
                  v-model="state.shop.youtubeLink"
                  :label="ShopJa.YOUTUBE_LINK"
                  prepend-inner-icon="mdi-youtube"
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
              :path="`/shops/${uuid.image}`"
              :past-image-link="state.shop.imageLink"
              @input="(v) => state.shop.imageLink = v"
            />

            <UploadImageFile
              :path="`/shops/${uuid.menuImage}`"
              :past-image-link="state.shop.menuImageLink[0]"
              label="メニュー画像"
              @input="(v) => state.shop.menuImageLink[0] = v"
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
import { DEFAULT_IMAGE } from '@/src/types/Shop'
import { Shop as ShopJa } from '@/lang/ja/Shop'
import { ShopFormState } from '@/src/types/ShopFormState'
import { isShop } from '@/src/utils/Shop'
import { v4 as createUUID } from 'uuid'
import { Shop, Dish, PriceRange, Keyword } from '@/lib'
import { getLongitudeAndLatitudeByAddress } from '@/src/infra/geolocation/Geolocation'
import { getAddressByPostal } from '@/src/infra/postal/Postal'
import { useTimeZone } from '@/src/CompositonFunctions/timeZones/UseTimeZone'
import { DisplayMode } from '@/lib/enum/DisplayMode'

type Props = {
  shop?: Shop,
  dishes: Dish[],
  keywords: Keyword[],
  priceRangeList: PriceRange[]
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

    shop: {
      default: undefined,
      validator (v) {
        return isShop(v)
      }
    },

    priceRangeList: {
      type: Array,
      default: []
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
        priority: 3,
        priceRange: undefined,
        public: true,
        address: undefined,
        buildingName: undefined,
        postal: undefined,
        tel: undefined,
        canTakeout: true,
        instaNumber: 0,
        instaShopLink: undefined,
        businessHour1: undefined,
        businessHour2: undefined,
        businessStartHour1: undefined,
        businessEndHour1: undefined,
        businessLoHour1: undefined,
        businessStartHour2: undefined,
        businessEndHour2: undefined,
        businessLoHour2: undefined,
        parkingLot: undefined,
        regularHoliday: undefined,
        seat: undefined,
        dishes: [] as string[],
        keywords: [] as string[],
        latitude: 0,
        longitude: 0,
        timeZone: [],
        displayMode: DisplayMode.DEFAULT
      }
    })

    const uuid = {
      image: createUUID(),
      menuImage: createUUID()
    }

    const priceRangeListForSelect = computed(() => {
      return props.priceRangeList.map(priceRange => priceRange.name)
    })

    const dishesListForSelect = computed(() => {
      return props.dishes.map(dish => ({
        value: dish.id,
        text: dish.name,
      }))
    })

    const keywordsListForSelect = computed(() => {
      return props.keywords.map(keyword => keyword.name)
    })

    const { timeZoneJa } = useTimeZone()

    const onGetAddress = async () => {
      if (!state.shop.address) {
        return alert('住所を入力してください')
      }

      const data = await getLongitudeAndLatitudeByAddress(state.shop.address)

      if (!data) {
        return alert('住所から緯度経度を取得できませんでした')
      }

      const { latitude, longitude } = data

      state.shop.latitude = latitude
      state.shop.longitude = longitude
    }

    const onGetAddressByPostal = async () => {
      if (!state.shop.postal) {
        return alert('郵便番号を入力してください')
      }

      const address = await getAddressByPostal(state.shop.postal)
      if (!address) {
        return alert('郵便番号から住所を取得できませんでした')
      }
      state.shop.address = address
    }

    watch(() => props.shop, (newVal, _) => {
      state.shop = newVal ? newVal : state.shop
    })

    const onSubmit = () => context.emit('submit', state.shop)

    return {
      dishesListForSelect,
      state,
      ShopJa,
      uuid,
      keywordsListForSelect,
      timeZoneJa,
      displayMode: DisplayMode,
      priceRangeListForSelect,
      onGetAddress,
      onGetAddressByPostal,
      onSubmit
    }
  }
})
</script>
