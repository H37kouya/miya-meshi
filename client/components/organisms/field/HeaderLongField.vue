<template>
  <div>
    <div style="width: 100%;" class="pos-relative">
      <v-container class="d-none d-sm-block">
        <v-row justify="space-around" align="center">
          <v-col class="py-0">
            <nuxt-link to="/">
              <v-img
                src="/s/miya-meshi.png"
                width="100px"
              />
            </nuxt-link>
          </v-col>

          <v-col class="py-0">
            <HeaderIconField />
          </v-col>

          <v-col class="py-0 d-none d-md-block">
            <div class="d-flex justify-end">
              <div>
                <v-img
                  src="/s/icon-door.png"
                  width="50px"
                  alt="扉のアイコン"
                />
              </div>
            </div>
          </v-col>
        </v-row>
      </v-container>

      <v-img
        :src="screenSm ? '/s/miyameshi-pc-top.jpg' : '/s/miyameshi-top.png'"
        width="100%"
        :aspect-ratio="screenSm ? undefined : 1.78"
        :max-height="screenSm ? '586px' : '160px'"
      />

      <template v-if="!state.loading">
        <v-card class="d-sm-none news">
          <v-img src="/s/miyameshi-ticket.jpg" />
        </v-card>
      </template>

      <div class="text-right pt-6 px-4 developer-name d-sm-none">
        <small class="developer-name-small">運営: みやメシ応援隊 開発: U-lab</small>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, reactive } from '@nuxtjs/composition-api'
import { useGetScreenSize } from '@/src/CompositonFunctions/utils/UseGetScreenSize'

export default defineComponent({
  setup () {
    const state = reactive({
      loading: true
    })

    const { screenSm, screenMd } = useGetScreenSize()

    onMounted(() => {
      setTimeout(() => {
        state.loading = false
      }, 500)
    })

    return {
      state,
      screenSm,
      screenMd
    }
  }
})
</script>

<style lang="scss" scoped>
@import "heder_field";

.top-image {
  background-color: grey;
  width: 100%;
  height: 160px;
}

.news {
  position: absolute;
  bottom: 15%;
  left: 50%;
  transform: translateX(-50%);
  background-color: darkgray;
  max-width: 200px;
  max-height: 120px;
}
</style>
