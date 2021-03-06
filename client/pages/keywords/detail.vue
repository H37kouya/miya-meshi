<template>
  <div>
    <MainText id="search_detail">
      詳細検索
    </MainText>

    <div class="u-light-grey-background">
      <v-container class="py-0">
        <v-breadcrumbs :items="breadcrumbs" class="pb-0 px-0 px-sm-6" />
      </v-container>

      <div class="d-flex justify-center py-2">
        <v-container class="max-width-480 text-center">
          <p class="detail-text">
            検索したいキーワードをタップしてください
          </p>

          <div class="d-flex justify-center">
            <KeywordMainText id="search_by_area" :level="2">
              エリア
            </KeywordMainText>
          </div>

          <div>
            <AreaDetailTable
              :areas="areas"
              :selected-ids="state.areaSelectedID"
              @click="onAreaClick"
            />
          </div>

          <div class="d-flex justify-center">
            <KeywordMainText id="search_by_food" :level="2">
              ジャンル
            </KeywordMainText>
          </div>

          <div>
            <DishDetailTable
              :dishes="dishes"
              :selected-ids="state.dishSelectedID"
              @click="onDishClick"
            />
          </div>

          <div class="d-flex justify-center">
            <KeywordMainText id="search_by_time" :level="2">
              時間帯
            </KeywordMainText>
          </div>

          <div>
            <TimeDetailTable :times="times" :selected-times="state.timeSelectedName" @click="onTimeClick" />
          </div>

          <div class="mt-4">
            <v-btn color="#ffa26d" large :to="to">
              検索
            </v-btn>
          </div>
        </v-container>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, onMounted, reactive, useContext, useMeta } from '@nuxtjs/composition-api'
import { useArea } from '@/src/CompositonFunctions/areas/UseArea'
import { useDish } from '@/src/CompositonFunctions/dishes/UseDishes'
import { Breadcrumb, Time } from '@/lib'
import { DETAIL_LIST_ITEM } from '@/components/atoms/table/DetailListItemType'
import { isArray, nullOrStringArrayToStringArray } from '@/src/utils/Array'
import { isString } from '@/src/utils/String'

const times = [{ id: 'morning', name: '朝' }, { id: 'lunch', name: '昼' }, { id: 'night', name: '夜' }] as Time[]

type State = {
  areaSelectedID: string[],
  dishSelectedID: string[]
  timeSelectedName: string[]
}

export default defineComponent({
  setup () {
    const state = reactive<State>({
      areaSelectedID: [] as string[],
      dishSelectedID: [] as string[],
      timeSelectedName: [
        'morning',
        'lunch',
        'night'
      ] as string[]
    })
    const { store, query } = useContext()

    const { areas } = useArea(store)
    const { dishes } = useDish(store)

    onMounted(() => {
      const _areaQuery = query.value.areas
      const _dishesQuery = query.value.dishes
      const _timezonesQuery = query.value.timezones
      if (isArray(_areaQuery)) {
        state.areaSelectedID = nullOrStringArrayToStringArray(_areaQuery)
      }

      if (isArray(_dishesQuery)) {
        state.dishSelectedID = nullOrStringArrayToStringArray(_dishesQuery)
      }

      if (isArray(_timezonesQuery)) {
        state.timeSelectedName = nullOrStringArrayToStringArray(_timezonesQuery)
      }
    })

    const onAreaClick = (id: string) => {
      if (id === DETAIL_LIST_ITEM.ALL) {
        if (state.areaSelectedID.length > 0) {
          state.areaSelectedID = []
        }

        return
      }

      const areaID = state.areaSelectedID.find((aID: string) => id === aID)
      if (areaID) {
        state.areaSelectedID = state.areaSelectedID.filter((aID: string) => id !== aID)
      } else {
        state.areaSelectedID.push(id)
      }
    }

    const onDishClick = (id: string) => {
      if (id === DETAIL_LIST_ITEM.ALL) {
        if (state.dishSelectedID.length > 0) {
          state.dishSelectedID = []
        }

        return
      }

      const dishID = state.dishSelectedID.find((dID: string) => id === dID)
      if (dishID) {
        state.dishSelectedID = state.dishSelectedID.filter((dID: string) => id !== dID)
      } else {
        state.dishSelectedID.push(id)
      }
    }

    const onTimeClick = (name: string) => {
      const time = state.timeSelectedName.find((t: string) => t === name)
      if (time) {
        state.timeSelectedName = state.timeSelectedName.filter((t: string) => t !== name)
      } else {
        state.timeSelectedName.push(name)
      }
    }

    const to = computed(() => {
      const _canTakeout = query.value.canTakeout

      return {
        path: '/shops',
        query: {
          areas: state.areaSelectedID,
          dishes: state.dishSelectedID,
          timezones: state.timeSelectedName,
          canTakeout: isString(_canTakeout) ? _canTakeout : undefined
        }
      }
    })

    const breadcrumbs = computed(() => {
      return [
        { exact: true, text: 'Home', to: '/' },
        { exact: true, text: 'お店から探す', to: to.value },
        { exact: false, text: '詳細検索', to: '/keywords/detail' }
      ] as Breadcrumb[]
    })

    useMeta({
      title: '詳細検索'
    })

    return {
      areas,
      breadcrumbs,
      dishes,
      onAreaClick,
      onDishClick,
      onTimeClick,
      times,
      to,
      state
    }
  },

  head: {}
})
</script>

<style lang="scss" scoped>
.detail-text {
  font-size: 0.8rem;
}

.to-keyword {
  font-size: 0.8rem;
  text-decoration: none;

  &::before {
    content: '←';
  }
}
</style>
