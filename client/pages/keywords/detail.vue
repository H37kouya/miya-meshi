<template>
  <div>
    <DefaultMainText id="search_detail">
      詳細検索
    </DefaultMainText>

    <div class="u-light-grey-background">
      <v-container class="max-width-480">
        <p class="mb-0">
          <nuxt-link to="/keywords" class="to-keyword">
            検索に戻る
          </nuxt-link>
        </p>
      </v-container>

      <div class="d-flex justify-center py-2">
        <v-container class="max-width-480 text-center">
          <p class="detail-text">
            検索したいキーワードをタップしてください
          </p>

          <div class="d-flex justify-center">
            <KeywordMainText id="search_by_area" :level="2">
              地域
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
              料理
            </KeywordMainText>
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
import { computed, defineComponent, reactive, SetupContext } from '@vue/composition-api'
import { MetaInfo } from 'vue-meta'
import { useArea } from '@/src/CompositonFunctions/areas/UseArea'

const times = ['朝', '昼', '夜']

export default defineComponent({
  setup (_, context: SetupContext) {
    const state = reactive({
      areaSelectedID: [] as string[],
      timeSelectedName: [] as string[]
    })

    const { areas } = useArea(context.root)

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
      areas,
      onAreaClick,
      onTimeClick,
      times,
      to,
      state
    }
  },

  head: (): MetaInfo => ({
    title: '詳細検索',
    meta: [
      { property: 'og:type', content: 'article' }
    ]
  })
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
