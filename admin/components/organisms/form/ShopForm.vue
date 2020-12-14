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
              v-model="state.shop.name_lana"
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
                      :placeholder="state.shop.publish_from"
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
                      :placeholder="state.shop.publish_to"
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
              </v-card-text>
            </v-col>

            <v-col class="py-2 py-sm-4" cols="6">
              <v-card-subtitle class="py-2 py-sm-4">公開モード</v-card-subtitle>
              <v-card-text class="pb-0">
                <v-switch
                  v-model="state.shop.display_mode"
                  :label="state.shop.display_mode === displayMode.SIMPLE ? '簡易掲載' : '通常公開'"
                  :true-value="displayMode.DEFAULT"
                  :false-value="displayMode.SIMPLE"
                  class="mt-0"
                />
              </v-card-text>
              <p class="font-small mb-0">現在、「{{ state.shop.display_mode === displayMode.SIMPLE ? '簡易掲載' : '通常公開' }}」です。</p>
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
                      v-model="state.shop.can_takeout"
                      :label="state.shop.can_takeout ? '可能' : '不可能'"
                      class="mt-0"
                    />
                  </v-col>

                  <v-col cols="12" md="4" class="pt-0">
                    <v-card-subtitle class="px-2">
                      予約可能店舗かどうか
                    </v-card-subtitle>

                    <v-switch
                      v-model="state.shop.can_reservation"
                      :label="state.shop.can_reservation ? '可能' : '不可能'"
                      class="mt-0"
                    />
                  </v-col>

                  <v-col cols="12" md="4" class="pt-0">
                    <v-card-subtitle class="px-2">
                      GoToEatを行っているかどうか
                    </v-card-subtitle>

                    <v-switch
                      v-model="state.shop.can_gotoeat"
                      :label="state.shop.can_gotoeat ? '実施中' : '非実施'"
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
                  v-model.number="state.shop.reservervation_max_number"
                  label="予約最大人数"
                  placeholder="10"
                  outlined
                  suffix="人"
                />

                <v-text-field
                  v-model.number="state.shop.credit_card"
                  label="クレジットカード"
                  placeholder="非対応"
                  outlined
                />

                <v-text-field
                  v-model.number="state.shop.electronic_money"
                  label="電子マネー"
                  placeholder="Suicaなどの交通系電子マネー"
                  outlined
                />
              </v-card-text>
            </v-col>

            <v-col cols="12" sm="4" class="mt-0">
              <v-card-text>
                <DialogWithTimePicker
                  v-model="state.shop.business_start_hour1"
                  label="営業開始時間1"
                />

                <DialogWithTimePicker
                  v-model="state.shop.business_end_hour1"
                  label="営業終了時間1"
                />

                <DialogWithTimePicker
                  v-model="state.shop.business_lo_hour1"
                  label="ラストオーダー1"
                />

                <DialogWithTimePicker
                  v-model="state.shop.business_start_hour2"
                  label="営業開始時間2"
                />

                <DialogWithTimePicker
                  v-model="state.shop.business_end_hour2"
                  label="営業終了時間2"
                />

                <DialogWithTimePicker
                  v-model="state.shop.business_lo_hour2"
                  label="ラストオーダー2"
                />

                <DialogWithTimePicker
                  v-model="state.shop.business_start_hour3"
                  label="営業開始時間3"
                />

                <DialogWithTimePicker
                  v-model="state.shop.business_end_hour3"
                  label="営業終了時間3"
                />

                <DialogWithTimePicker
                  v-model="state.shop.business_lo_hour3"
                  label="ラストオーダー3"
                />

                <RegularHolidayShopTextField
                  v-model="state.shop.regular_holiday"
                />

                <SeatShopTextField
                  v-model="state.shop.seat"
                />

                <v-text-field
                  v-model="state.shop.private_room"
                  label="個室"
                  placeholder="個室4室あります"
                  maxlength="50"
                  outlined
                />

                <v-text-field
                  v-model="state.shop.about_smoking"
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
              v-model.number="state.shop.insta_number"
              :label="ShopJa.INSTA_NUMBER"
              type="number"
              prefix="No."
              outlined
            />

            <LinkTextField
              v-model="state.shop.insta_shop_link"
              :label="ShopJa.INSTA_SHOP_LINK"
            />

            <v-textarea
              v-model="state.shop.insta_iframe"
              label="インスタ埋め込み"
              outlined
              hide-details
            />

            <div class="text-right mb-2">
              <a href="https://mag.app-liv.jp/archive/125990/" rel="noopener" target="_blank">埋め込みのやり方</a>
            </div>

            <div>
              <div v-html="state.shop.insta_iframe" />
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
                  v-model="state.shop.facebook_link"
                  :label="ShopJa.FACEBOOK_LINK"
                  prepend-inner-icon="mdi-facebook"
                />

                <LinkTextField
                  v-model="state.shop.insta_link"
                  :label="ShopJa.INSTA_LINK"
                  prepend-inner-icon="mdi-instagram"
                />

                <LinkTextField
                  v-model="state.shop.twitter_link"
                  :label="ShopJa.TWITTER_LINK"
                  prepend-inner-icon="mdi-twitter"
                />

                <LinkTextField
                  v-model="state.shop.ubereats_link"
                  :label="ShopJa.UBER_EATS_LINK"
                  prepend-inner-icon="mdi-alpha-u-box-outline"
                />
              </v-col>

              <v-col cols="12" sm="6" class="pt-0 pt-sm-3">
                <LinkTextField
                  v-model="state.shop.homepage_link"
                  :label="ShopJa.HOMEPAGE_LINK"
                  prepend-inner-icon="mdi-home-circle"
                />

                <LinkTextField
                  v-model="state.shop.line_link"
                  :label="ShopJa.LINE_LINK"
                  prepend-inner-icon="mdi-alpha-l-box-outline"
                />

                <LinkTextField
                  v-model="state.shop.youtube_link"
                  :label="ShopJa.YOUTUBE_LINK"
                  prepend-inner-icon="mdi-youtube"
                />

                <LinkTextField
                  v-model="state.shop.gotoeat_link"
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
              :past-image-link="state.shop.menu_image_link"
              label="メニュー画像"
              @input="(v) => state.shop.menu_image_link = v"
            />

            <UploadMultipleImageFile
              :default-image="DEFAULT_IMAGE"
              :path="uuid.appearanceImages.map((appearanceImage) => `/shop_appearances/${appearanceImage}`)"
              :past-image-link="state.shop.appearance_image_link"
              label="店舗外観"
              @input="(v) => state.shop.appearance_image_link = v"
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
        prefix_name: '',
        name: '',
        description: '',
        intro: '',
        image_link: DEFAULT_IMAGE,
        menu_image_link: [
          DEFAULT_IMAGE,
          DEFAULT_IMAGE,
          DEFAULT_IMAGE,
          DEFAULT_IMAGE,
          DEFAULT_IMAGE,
          DEFAULT_IMAGE
        ],
        facebook_link: '',
        homepage_link: '',
        insta_link: '',
        line_link: '',
        twitter_link: '',
        ubereats_link: '',
        youtube_link: '',
        gotoeat_link: '',
        priority: 3,
        price_range: '',
        release: true,
        address: '',
        building_name: '',
        postal: '',
        tel: '',
        can_takeout: true,
        insta_number: 0,
        insta_shop_link: '',
        business_start_hour1: null,
        business_end_hour1: null,
        business_lo_hour1: null,
        business_start_hour2: null,
        business_end_hour2: null,
        business_lo_hour2: null,
        business_start_hour3: null,
        business_end_hour3: null,
        business_lo_hour3: null,
        parking_lot: '',
        regular_holiday: '',
        seat: '',
        dishes: [] as string[],
        keywords: [] as string[],
        latitude: 0,
        longitude: 0,
        timeZone: [],
        name_kana: '',
        access: '',
        can_reservation: true,
        reservervation_max_number: '',
        credit_card: '',
        about_smoking: '',
        electronic_money: '',
        total_number_of_seats: '',
        private_room: '',
        insta_iframe: '',
        can_gotoeat: false,
        appearance_image_link: [
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
        display_mode: DisplayMode.DEFAULT
      } as Partial<Shop>,
      publish_from: null,
      publish_to: null,
      menu: {
        publish_from: '',
        publish_to: ''
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

    watch(() => state.publish_from, () => { state.userChangedPublishFrom = true })
    watch(() => state.publish_to, () => { state.userChangedPublishTo = true })

    const onSubmit = () => {
      if (props.type === 'create') {
        state.shop.publish_from = state.publish_from
        state.shop.publish_to = state.publish_to
      } else {
        if (state.userChangedPublishFrom) {
          state.shop.publish_from = state.publish_from
        }

        if (state.userChangedPublishTo) {
          state.shop.publish_to = state.publish_to
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
