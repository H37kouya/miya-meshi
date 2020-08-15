<template>
  <v-container class="max-width-350">
    <v-row justify="space-between" align="center">
      <div>
        <p class="mb-2 sentence">
          運営
        </p>
        <p class="mb-0 sentence">
          宇都宮の飲食店を支えたい
        </p>
        <p class="footer-group-title">
          みやメシ応援隊
        </p>

        <ul class="d-flex link-inline-list border-black pa-0 mb-2">
          <li><a href="" class="sentence link-inline-list-item u-black--text">みやメシとは？</a></li>
          <li><a href="" class="sentence link-inline-list-item u-black--text">みやメシHistory</a></li>
        </ul>

        <div>
          <v-btn icon class="mr-2" href="https://www.instagram.com/miyameshi_ouentai/" target="_blank" rel="noopener">
            <v-icon color="#333" large>
              mdi-instagram
            </v-icon>
          </v-btn>

          <v-btn icon href="https://twitter.com/miyameshiouen" target="_blank" rel="noopener">
            <v-icon color="#333" large>
              mdi-twitter
            </v-icon>
          </v-btn>
        </div>
      </div>

      <div>
        <MiyaMeshiImage />
      </div>
    </v-row>
  </v-container>
</template>

<style lang="scss" scoped>
@import "components/atoms/footer_field/footer_field";
</style>
