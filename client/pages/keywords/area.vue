<template>
  <div>
    <v-container class="u-light-grey-background py-2 breadcrumbs-container mb-2">
      <v-breadcrumbs :items="breadcrumbs" class="py-0 px-0 px-sm-6" />
    </v-container>

    <MainText id="search_area">
      エリア変更
    </MainText>

    <div class="u-light-grey-background">
      <div class="d-flex justify-center py-2">
        <v-container class="max-width-480 text-center">
          <div>
            <AreaSearchList
              :areas="areas"
              :now-area="nowArea"
              :selected-ids="state.areaSelectedID"
              :query="nowQuery"
              @update-now-area="onUpdateNowArea"
            />
          </div>
        </v-container>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, onMounted, reactive, SetupContext, useMeta } from '@nuxtjs/composition-api'
import { useArea } from '@/src/CompositonFunctions/areas/UseArea'
import { useDish } from '@/src/CompositonFunctions/dishes/UseDishes'
import { Breadcrumb } from '@/lib'
import { isArray, nullOrStringArrayToStringArray } from '@/src/utils/Array'
import { isString } from '@/src/utils/String'

type State = {
  areaSelectedID: string[]
}

export default defineComponent({
  setup (_, context: SetupContext) {
    const state = reactive<State>({
      areaSelectedID: [] as string[]
    })

    const { areas, nowArea, onUpdateNowArea } = useArea(context.root)
    const { dishes } = useDish(context.root)

    onMounted(() => {
      const _areaQuery = context.root.$route.query.areas
      if (isArray(_areaQuery)) {
        state.areaSelectedID = nullOrStringArrayToStringArray(_areaQuery)
      } else {
        state.areaSelectedID = [_areaQuery]
      }
    })

    const nowQuery = computed(() => {
      const _canTakeout = context.root.$route.query.canTakeout
      const _dishesQuery = context.root.$route.query.dishes
      const _timezonesQuery = context.root.$route.query.timezones

      return {
        dishes: _dishesQuery,
        timezones: _timezonesQuery,
        canTakeout: isString(_canTakeout) ? _canTakeout : undefined
      }
    })

    const to = computed(() => {
      const _canTakeout = context.root.$route.query.canTakeout
      const _dishesQuery = context.root.$route.query.dishes
      const _timezonesQuery = context.root.$route.query.timezones

      if (state.areaSelectedID.length === 0) {
        return {
          path: '/shops',
          query: {
            dishes: _dishesQuery,
            timezones: _timezonesQuery,
            canTakeout: isString(_canTakeout) ? _canTakeout : undefined
          }
        }
      }

      return {
        path: `/shops/area/${state.areaSelectedID[0]}`,
        query: {
          dishes: _dishesQuery,
          timezones: _timezonesQuery,
          canTakeout: isString(_canTakeout) ? _canTakeout : undefined
        }
      }
    })

    const breadcrumbs = computed(() => {
      return [
        { exact: true, text: 'Home', to: '/' },
        { exact: true, text: 'お店から探す', to: to.value },
        { exact: false, text: 'エリア変更', to: '/keywords/area' }
      ] as Breadcrumb[]
    })

    useMeta({
      title: 'エリア変更'
    })

    return {
      areas,
      breadcrumbs,
      dishes,
      onUpdateNowArea,
      nowArea,
      nowQuery,
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
