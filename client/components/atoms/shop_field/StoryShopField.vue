<template>
  <div>
    <DefaultMainText :level="2">
      ストーリー
    </DefaultMainText>

    <div class="u-light-grey-background">
      <div class="d-flex justify-center">
        <div class="max-width-480 pa-4" :style="style">
          <div class="text-container pa-5 rounded-lg">
            <p class="main-text mb-0">
              {{ text }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent } from '@vue/composition-api'

type Props = {
  text: string,
  src: string
}
export default defineComponent({
  props: {
    text: {
      type: String,
      required: true
    },
    src: {
      type: String,
      default: undefined
    }
  },
  setup (props: Props, _) {
    const style = computed(() => {
      if (!props.src) {
        return undefined
      }

      return `background-image: url(${props.src});background-size: cover;`
    })

    return {
      style
    }
  }
})
</script>

<style lang="scss">
.text-container {
  background-color: rgba(#fff, 0.9);
}

.main-text {
  &::before {
    content: '';
    padding: 0.5rem;
  }
}
</style>
