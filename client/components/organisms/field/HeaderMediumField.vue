<template>
  <div class="w-100">
    <div class="d-sm-none">
      <v-img
        src="/s/miyameshi-header-white2.png"
        width="100%"
        max-height="160px"
        aspect-ratio="5.77"
      />

      <div class="text-right px-4 developer-name">
        <small class="developer-name-small">運営: みやメシ応援隊 開発: U-lab</small>
      </div>
    </div>

    <div class="d-none d-sm-block border-b border-dark-gray">
      <v-container>
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
    </div>
  </div>
</template>

<style lang="scss" scoped>
@import "heder_field";

.top-image {
  background-color: grey;
  width: 100%;
  height: 120px;
}
</style>
