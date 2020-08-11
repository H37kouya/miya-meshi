<template>
  <div style="background-color: #f5f5f5;">
    <v-container class="max-width-350">
      <div class="mb-2">
        <SearchTextField />
      </div>

      <div class="mb-2">
        <v-btn outlined width="100%" small class="justify-end">
          <span class="search-keyword">
            キーワードから探す
          </span>
        </v-btn>
      </div>

      <v-row justify="center">
        <ToSearchShopButton class="mr-2" />

        <ToSearchFoodButton />
      </v-row>
    </v-container>
  </div>
</template>

<style lang="scss" scoped>
.search-keyword {
  &::after {
    content: '▼';
  }
}
</style>
