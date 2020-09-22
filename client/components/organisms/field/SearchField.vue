<template>
  <div style="background-color: #f5f5f5;">
    <v-container class="max-width-350">
      <v-row justify="center">
        <v-col cols="6" class="pa-2">
          <ToTopPageButton width="100%" />
        </v-col>

        <v-col cols="6" class="pa-2">
          <ToSearchShopButton width="100%" />
        </v-col>
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
