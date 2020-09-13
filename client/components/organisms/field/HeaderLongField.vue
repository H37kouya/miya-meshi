<template>
  <div>
    <div style="width: 100%;" class="pos-relative">
      <v-img
        src="/s/miyameshi-top.png"
        width="100%"
        aspect-ratio="1.78"
        max-height="160px"
      />

      <template v-if="!state.loading">
        <v-card class="news">
          <v-img src="/s/miyameshi-ticket.jpg" />
        </v-card>
      </template>

      <div class="text-right pt-6 px-4 developer-name">
        <small class="developer-name-small">運営: みやメシ応援隊 開発: U-lab</small>
      </div>
    </div>

    <div>
      <SearchField />
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, reactive } from '@nuxtjs/composition-api'

export default defineComponent({
  setup () {
    const state = reactive({
      loading: true
    })

    onMounted(() => {
      setTimeout(() => {
        state.loading = false
      }, 500)
    })

    return {
      state
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
