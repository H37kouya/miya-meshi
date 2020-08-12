<template>
  <div
    class="search-button-container"
    draggable="true"
  >
    <v-row justify="center">
      <v-col cols="6" class="pa-1 px-3">
        <TakeoutIcon selected />
      </v-col>

      <v-col cols="6" class="pa-1">
        <OpenBuzIcon />
      </v-col>
    </v-row>

    <v-row justify="center">
      <v-col cols="6" class="pa-1 px-3">
        <NowLocationIcon />
      </v-col>

      <v-col cols="6" class="pa-1">
        <AreaIcon />
      </v-col>
    </v-row>
  </div>
</template>

<style lang="scss" scoped>
.search-button-container {
  position: fixed;
  right: 20px;
  bottom: 50px;
  background-color: #f3f3e2;
  padding: 0.5rem;
  border-radius: 10px;
  max-width: 200px;
}
</style>
