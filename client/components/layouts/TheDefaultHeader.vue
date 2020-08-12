<template>
  <header>
    <div style="width: 100%;" class="pos-relative">
      <div class="top-image" />

      <div class="news" />

      <div class="text-right pt-4 px-4 u-black--text">
        <small>運営: みやメシ応援隊 開発: U-lab</small>
      </div>
    </div>

    <div>
      <SearchField />
    </div>
  </header>
</template>

<script>
export default {
  props: {
    value: {
      type: Boolean,
      default: false
    }
  },

  computed: {
    drawer: {
      get () {
        return this.value
      },
      set (newVal) {
        return this.$emit('input', newVal)
      }
    },

    getTitle: () => 'みやメシ応援隊'
  }
}
</script>

<style lang="scss" scoped>
.top-image {
  background-color: grey;
  width: 100%;
  height: 160px;
}

.news {
  position: absolute;
  bottom: 10%;
  left: 50%;
  transform: translateX(-50%);
  background-color: darkgray;
  width: 160px;
  height: 120px;
}
</style>
