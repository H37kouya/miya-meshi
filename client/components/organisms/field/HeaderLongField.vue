<template>
  <div>
    <div style="width: 100%;">
      <v-container v-if="screenSm" class="d-none d-sm-block">
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
        :src="$device.isMobile ? '/s/miyameshi-phone-top.jpg' : '/s/miyameshi-pc-top.jpg'"
        :aspect-ratio="screenSm ? undefined : 1.78"
        :max-height="screenSm ? '586px' : '160px'"
      />

      <div class="text-right px-4 developer-name d-sm-none">
        <small class="developer-name-small">運営: みやメシ応援隊 開発: U-lab</small>
      </div>

      <div class="text-center border-y border-dark-gray miya-meshi-about-container">
        <nuxt-link
          class="text-decoration-none w-100 d-flex justify-center align-center link"
          to="/about/miyameshi#title"
        >
          みやメシ応援隊とは
        </nuxt-link>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api'
import { useGetScreenSize } from '@/src/CompositonFunctions/utils/UseGetScreenSize'

export default defineComponent({
  setup () {
    const { screenSm, screenMd } = useGetScreenSize()

    return {
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

.miya-meshi-about-container {
  height: 60px;

  @include mq(md) {
    height: 80px;
  }

  .link {
    height: 100%;
    font-size: 1.25rem;
    font-weight: bolder;
    background: #90B496;
    color: #fff;
  }
}
</style>
