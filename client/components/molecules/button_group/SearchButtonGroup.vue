<template>
  <v-container class="pl-6 py-0 pr-0 max-width-480">
    <div class="d-flex justify-end align-center search-container pb-2 pr-2">
      <p class="mb-0 pl-1 pr-2 search-title text-right">
        絞り込み
      </p>

      <TakeoutIcon
        :selected="btnStatus.takeout"
        @click="onInput('takeout', btnStatus)"
      />
      <OpenBuzIcon
        :selected="btnStatus.openBuz"
        @click="onInput('openBuz', btnStatus)"
      />

      <NowLocationIcon
        :selected="btnStatus.nowLocation"
        @click="onInput('nowLocation', btnStatus)"
      />

      <TimeZoneIcon
        :selected="btnStatus.timeZone"
        @click="onInput('timeZone', btnStatus)"
      />
    </div>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@nuxtjs/composition-api'
import { useBtnStatus, BtnStatus } from '@/src/CompositonFunctions/btnStatus/UseBtnStatus'

type Props = {
  btnStatus: BtnStatus
}

export default defineComponent({
  props: {
    btnStatus: {
      type: Object,
      required: true
    }
  },

  setup (props: Props, context: SetupContext) {
    const { onInput } = useBtnStatus(context)

    return {
      onInput
    }
  }
})
</script>

<style lang="scss" scoped>
.search-container {
  background-color: #f3f3e2;
  border-top-left-radius: 1rem;
  border-bottom-left-radius: 1rem;
}

.search-title {
  font-size: 0.8rem;
}

.width-70 {
  width: 70px;
}
</style>
