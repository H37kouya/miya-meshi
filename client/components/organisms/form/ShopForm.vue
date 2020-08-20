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
          <v-card-title>サイト設定</v-card-title>

          <v-card-subtitle>店舗公開設定</v-card-subtitle>
          <v-card-text class="pb-0">
            <v-switch
              v-model="state.shop.public"
              :label="state.shop.public ? '公開' : '非公開'"
              class="mt-0"
            />
          </v-card-text>

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
                  v-model="state.shop.canTakeOut"
                  :label="state.shop.canTakeOut ? '可能' : '不可能'"
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
                <BusinessHourShopTextField
                  v-model="state.shop.businessHour1"
                  :number="1"
                />

                <BusinessHourShopTextField
                  v-model="state.shop.businessHour2"
                  :number="2"
                />

                <RegularHolidayShopTextField
                  v-model="state.shop.regularHoliday"
                />

                <SeatShopTextField
                  v-model="state.shop.seat"
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
              v-model="state.shop.instaNumber"
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
import { Shop, ShopJa, DEFAULT_IMAGE } from '@/src/types/Shop'
import { ShopFormState } from '@/src/types/ShopFormState'
import { isShop } from '@/src/utils/Shop'
import { createUUID, kanji2num, zenkakuToHankaku } from '@/src/utils/String'
import { PriceRange } from '~/src/types/PriceRange'
import { getLongitudeAndLatitudeByAddress } from '~/src/infra/geolocation/Geolocation'
import { getAddressByPostal } from '~/src/infra/postal/Postal'

type Props = {
  shop?: Shop,
  priceRangeList: PriceRange[]
}

export default defineComponent({
  props: {
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
        parkingLot: undefined,
        regularHoliday: undefined,
        seat: undefined,
        latitude: 0,
        longitude: 0
      }
    })

    const uuid = {
      image: createUUID(),
      menuImage: createUUID()
    }

    const priceRangeListForSelect = computed(() => {
      return props.priceRangeList.map(priceRange => priceRange.name)
    })

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
      state.shop.priceRange = newVal ? newVal.priceRange : state.shop.priceRange
      state.shop.public = newVal ? newVal.public : state.shop.public
      state.shop.address = newVal ? newVal.address : state.shop.address
      state.shop.buildingName = newVal ? newVal.buildingName : state.shop.buildingName
      state.shop.postal = newVal ? newVal.postal : state.shop.postal
      state.shop.tel = newVal ? newVal.tel : state.shop.tel
      state.shop.canTakeout = newVal ? newVal.canTakeout : state.shop.canTakeout
      state.shop.businessHour1 = newVal ? newVal.businessHour1 : state.shop.businessHour1
      state.shop.businessHour2 = newVal ? newVal.businessHour2 : state.shop.businessHour2
      state.shop.parkingLot = newVal ? newVal.parkingLot : state.shop.parkingLot
      state.shop.regularHoliday = newVal ? newVal.regularHoliday : state.shop.regularHoliday
      state.shop.seat = newVal ? newVal.seat : state.shop.seat
      state.shop.instaNumber = newVal ? newVal.instaNumber : state.shop.instaNumber
      state.shop.instaShopLink = newVal ? newVal.instaShopLink : state.shop.instaShopLink
      state.shop.latitude = newVal ? newVal.latitude : state.shop.latitude
      state.shop.longitude = newVal ? newVal.longitude : state.shop.longitude
    })

    const onSubmit = () => context.emit('submit', state.shop)

    return {
      state,
      ShopJa,
      uuid,
      priceRangeListForSelect,
      onGetAddress,
      onGetAddressByPostal,
      onSubmit
    }
  }
})
</script>
