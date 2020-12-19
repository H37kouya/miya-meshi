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

            <v-text-field
              v-model="state.shop.nameKana"
              :label="`店舗よみ(かな)`"
              placeholder="みやめしおうえんたい"
              type="text"
              outlined
              inputmode="kana"
              maxlength="100"
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
                  v-model="state.shop.release"
                  :label="state.shop.release ? '公開' : '非公開'"
                  class="mt-0"
                />
              </v-card-text>

              <v-card-subtitle class="py-0">
                公開時間
              </v-card-subtitle>

              <v-card-text>
                <v-menu
                  ref="menu_publishFrom"
                  v-model="state.menu.publishFrom"
                  :close-on-content-click="false"
                  :return-value.sync="state.publishFrom"
                  label="公開開始日時"
                  transition="scale-transition"
                  offset-y
                  min-width="290px"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                      v-model="state.publishFrom"
                      :placeholder="state.shop.publishFrom"
                      label="公開開始日時"
                      prepend-icon="mdi-calendar"
                      readonly
                      v-bind="attrs"
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-date-picker
                    v-model="state.publishFrom"
                    no-title
                    scrollable
                  >
                    <v-spacer></v-spacer>
                    <v-btn
                      text
                      color="primary"
                      @click="state.menu.publishFrom = false"
                    >
                      Cancel
                    </v-btn>
                    <v-btn
                      text
                      color="primary"
                      @click="$refs.menu_publishFrom.save(state.publishFrom)"
                    >
                      OK
                    </v-btn>
                  </v-date-picker>
                </v-menu>

                <v-menu
                  ref="menu_publishTo"
                  v-model="state.menu.publishTo"
                  :close-on-content-click="false"
                  :return-value.sync="state.publishTo"
                  label="公開終了日時"
                  transition="scale-transition"
                  offset-y
                  min-width="290px"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                      v-model="state.publishTo"
                      :placeholder="state.shop.publishTo"
                      label="公開終了日時"
                      prepend-icon="mdi-calendar"
                      readonly
                      v-bind="attrs"
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-date-picker
                    v-model="state.publishTo"
                    no-title
                    scrollable
                  >
                    <v-spacer></v-spacer>
                    <v-btn
                      text
                      color="primary"
                      @click="state.menu.publishTo = false"
                    >
                      Cancel
                    </v-btn>
                    <v-btn
                      text
                      color="primary"
                      @click="$refs.menu_publishTo.save(state.publishTo)"
                    >
                      OK
                    </v-btn>
                  </v-date-picker>
                </v-menu>
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

              <v-card-text>
                <v-row>
                  <v-col cols="12" md="4" class="pt-0">
                    <v-card-subtitle class="px-2">
                      テイクアウト可能店舗かどうか
                    </v-card-subtitle>

                    <v-switch
                      v-model="state.shop.canTakeout"
                      :label="state.shop.canTakeout ? '可能' : '不可能'"
                      class="mt-0"
                    />
                  </v-col>

                  <v-col cols="12" md="4" class="pt-0">
                    <v-card-subtitle class="px-2">
                      予約可能店舗かどうか
                    </v-card-subtitle>

                    <v-switch
                      v-model="state.shop.canReservation"
                      :label="state.shop.canReservation ? '可能' : '不可能'"
                      class="mt-0"
                    />
                  </v-col>

                  <v-col cols="12" md="4" class="pt-0">
                    <v-card-subtitle class="px-2">
                      GoToEatを行っているかどうか
                    </v-card-subtitle>

                    <v-switch
                      v-model="state.shop.canGotoeat"
                      :label="state.shop.canGotoeat ? '実施中' : '非実施'"
                      class="mt-0"
                    />
                  </v-col>
                </v-row>

                <v-row>
                  <v-col cols="12" md="6">
                    <v-select
                      v-model="state.shop.priceRange"
                      :items="priceRangeListForSelect"
                      label="価格帯"
                    />

                    <v-select
                      v-model="state.shop.dishes"
                      :items="dishesListForSelect"
                      :menu-props="{ maxHeight: '400' }"
                      label="ジャンル選択"
                      multiple
                    />
                  </v-col>

                  <v-col cols="12" md="6">
                    <v-select
                      v-model="state.shop.keywords"
                      :items="keywordsListForSelect"
                      :menu-props="{ maxHeight: '400' }"
                      label="タグ選択"
                      multiple
                    />

                    <v-select
                      v-model="state.shop.timeZone"
                      :items="timeZoneJa"
                      :menu-props="{ maxHeight: '400' }"
                      label="時間帯"
                      multiple
                    />
                  </v-col>
                </v-row>

                <v-text-field
                  v-model.number="state.shop.reservervationMaxNumber"
                  label="予約最大人数"
                  placeholder="10"
                  outlined
                  suffix="人"
                />

                <v-text-field
                  v-model.number="state.shop.creditCard"
                  label="クレジットカード"
                  placeholder="非対応"
                  outlined
                />

                <v-text-field
                  v-model.number="state.shop.electronicMoney"
                  label="電子マネー"
                  placeholder="Suicaなどの交通系電子マネー"
                  outlined
                />
              </v-card-text>
            </v-col>

            <v-col cols="12" sm="4" class="mt-0">
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

                <DialogWithTimePicker
                  v-model="state.shop.businessStartHour3"
                  label="営業開始時間3"
                />

                <DialogWithTimePicker
                  v-model="state.shop.businessEndHour3"
                  label="営業終了時間3"
                />

                <DialogWithTimePicker
                  v-model="state.shop.businessLoHour3"
                  label="ラストオーダー3"
                />

                <RegularHolidayShopTextField
                  v-model="state.shop.regularHoliday"
                />

                <SeatShopTextField
                  v-model="state.shop.seat"
                />

                <v-text-field
                  v-model="state.shop.privateRoom"
                  label="個室"
                  placeholder="個室4室あります"
                  maxlength="50"
                  outlined
                />

                <v-text-field
                  v-model="state.shop.aboutSmoking"
                  label="禁煙・喫煙"
                  placeholder="全席禁煙"
                  maxlength="50"
                  outlined
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

              <v-textarea
                v-model="state.shop.access"
                label="交通情報"
                placeholder="例) JR宇都宮駅西口から
３番乗り場（JRバス関東）清原台団地行、芳賀町役場行、祖母井行、茂木行、ベルモール行など 乗車時間約15分「宇大前」下車徒歩1分 "
                outlined
              />
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

            <v-textarea
              v-model="state.shop.instaIframe"
              label="インスタ埋め込み"
              outlined
              hide-details
            />

            <div class="text-right mb-2">
              <a href="https://mag.app-liv.jp/archive/125990/" rel="noopener" target="_blank">埋め込みのやり方</a>
            </div>

            <div>
              <div v-html="state.shop.instaIframe" />
            </div>
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
                  v-model="state.shop.ubereatsLink"
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

                <LinkTextField
                  v-model="state.shop.gotoeatLink"
                  label="Go To Eat"
                  prepend-inner-icon="mdi-alpha-g-box-outline"
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

            <UploadMultipleImageFile
              :default-image="DEFAULT_IMAGE"
              :path="uuid.menuImages.map((menuImage) => `/shops/${menuImage}`)"
              :past-image-link="state.shop.menuImageLink"
              label="メニュー画像"
              @input="(v) => state.shop.menuImageLink = v"
            />

            <UploadMultipleImageFile
              :default-image="DEFAULT_IMAGE"
              :path="uuid.appearanceImages.map((appearanceImage) => `/shop_appearances/${appearanceImage}`)"
              :past-image-link="state.shop.appearanceImageLink"
              label="店舗外観"
              @input="(v) => state.shop.appearanceImageLink = v"
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
  type: 'edit'|'create'
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

    type: {
      type: String,
      default: 'edit'
    },

    priceRangeList: {
      type: Array,
      default: []
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive({
      shop: {
        prefixName: '',
        name: '',
        description: '',
        intro: '',
        imageLink: DEFAULT_IMAGE,
        menuImageLink: [
          DEFAULT_IMAGE,
          DEFAULT_IMAGE,
          DEFAULT_IMAGE,
          DEFAULT_IMAGE,
          DEFAULT_IMAGE,
          DEFAULT_IMAGE
        ],
        facebookLink: '',
        homepageLink: '',
        instaLink: '',
        lineLink: '',
        twitterLink: '',
        ubereatsLink: '',
        youtubeLink: '',
        gotoeatLink: '',
        priority: 3,
        priceRange: '',
        release: true,
        address: '',
        buildingName: '',
        postal: '',
        tel: '',
        canTakeout: true,
        instaNumber: 0,
        instaShopLink: '',
        businessStartHour1: null,
        businessEndHour1: null,
        businessLoHour1: null,
        businessStartHour2: null,
        businessEndHour2: null,
        businessLoHour2: null,
        businessStartHour3: null,
        businessEndHour3: null,
        businessLoHour3: null,
        parkingLot: '',
        regularHoliday: '',
        seat: '',
        dishes: [] as string[],
        keywords: [] as string[],
        latitude: 0,
        longitude: 0,
        timeZone: [],
        nameKana: '',
        access: '',
        canReservation: true,
        reservervationMaxNumber: '',
        creditCard: '',
        aboutSmoking: '',
        electronicMoney: '',
        totalNumberOfSeats: '',
        privateRoom: '',
        instaIframe: '',
        canGotoeat: false,
        appearanceImageLink: [
          DEFAULT_IMAGE,
          DEFAULT_IMAGE,
          DEFAULT_IMAGE,
          DEFAULT_IMAGE,
          DEFAULT_IMAGE,
          DEFAULT_IMAGE,
          DEFAULT_IMAGE,
          DEFAULT_IMAGE,
          DEFAULT_IMAGE,
          DEFAULT_IMAGE
        ],
        displayMode: DisplayMode.DEFAULT
      } as Partial<Shop>,
      publishFrom: null,
      publishTo: null,
      menu: {
        publishFrom: '',
        publishTo: ''
      },
      userChangedPublishFrom: false,
      userChangedPublishTo: false
    })

    const uuid = {
      image: createUUID(),
      menuImage: createUUID(),
      menuImages: [
        createUUID(),
        createUUID(),
        createUUID(),
        createUUID(),
        createUUID(),
        createUUID()
      ],
      appearanceImages: [
        createUUID(),
        createUUID(),
        createUUID(),
        createUUID(),
        createUUID(),
        createUUID(),
        createUUID(),
        createUUID(),
        createUUID(),
        createUUID()
      ]
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

    watch(() => state.publishFrom, () => { state.userChangedPublishFrom = true })
    watch(() => state.publishTo, () => { state.userChangedPublishTo = true })

    const onSubmit = () => {
      if (props.type === 'create') {
        state.shop.publishFrom = state.publishFrom
        state.shop.publishTo = state.publishTo
      } else {
        if (state.userChangedPublishFrom) {
          state.shop.publishFrom = state.publishFrom
        }

        if (state.userChangedPublishTo) {
          state.shop.publishTo = state.publishTo
        }
      }
      context.emit('submit', state.shop)
    }

    return {
      DEFAULT_IMAGE,
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
