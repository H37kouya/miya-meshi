<template>
  <div>
    <v-text-field dense hide-details outlined>
      <template #append-outer>
        <v-btn outlined class="m-minus-1" color="grey darken-4" height="40px">
          <span class="search-typography">検索</span>
        </v-btn>
      </template>
    </v-text-field>
  </div>
</template>

<style lang="scss" scoped>
.m-minus-1 {
  margin-top: -0.55rem;
}
</style>
