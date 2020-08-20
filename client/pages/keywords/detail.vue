<template>
  <div>
    <DefaultMainText>
      詳細検索
    </DefaultMainText>

    <div class="u-light-grey-background">
      <div class="d-flex justify-center py-2">
        <v-container class="max-width-480 text-center">
          <p class="detail-text">
            検索したいキーワードをタップしてください
          </p>

          <div class="d-flex justify-center">
            <KeywordMainText :level="2">
              地域
            </KeywordMainText>
          </div>

          <div>
            <AreaDetailTable
              :areas="state.areas"
              :selected-ids="state.areaSelectedID"
              @click="onAreaClick"
            />
          </div>

          <div class="d-flex justify-center">
            <KeywordMainText :level="2">
              料理
            </KeywordMainText>
          </div>

          <div class="d-flex justify-center">
            <KeywordMainText :level="2">
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
import { computed, defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { getAreaList } from '@/src/infra/firestore/Area'
import { Area } from '@/src/types/Area'

const times = ['朝', '昼', '夜']

export default defineComponent({
  setup (_, context: SetupContext) {
    const state = reactive({
      areas: [] as Area[],
      areaSelectedID: [] as string[],
      timeSelectedName: [] as string[]
    })

    watchEffect(async () => {
      state.areas = await getAreaList(context.root.$fireStore)
    })

    const onAreaClick = (id: string) => {
      const areaID = state.areaSelectedID.find((aID: string) => id === aID)
      if (areaID) {
        state.areaSelectedID = state.areaSelectedID.filter((aID: string) => id !== aID)
      } else {
        state.areaSelectedID.push(id)
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
      return {
        path: '/search',
        query: {
          areas: state.areaSelectedID
        }
      }
    })

    return {
      onAreaClick,
      onTimeClick,
      times,
      to,
      state
    }
  }
})
</script>

<style lang="scss" scoped>
.detail-text {
  font-size: 0.8rem;
}
</style>
