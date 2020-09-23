<template>
  <v-container class="max-width-450 miyameshi-wrapper mr-md-0 px-4 px-md-8">
    <v-row justify="space-between" align="center">
      <div>
        <p class="mb-2 sentence prefix-title">
          運営
        </p>
        <p class="mb-0 sentence">
          宇都宮の飲食店を支えたい
        </p>
        <p class="footer-group-title">
          みやメシ応援隊
        </p>

        <ul class="d-flex link-inline-list border-black pa-0 mb-2">
          <li>
            <a
              href="https://note.com/miyameshi_ouen/n/nf920b05d1ad2"
              target="_blank"
              rel="noopener"
              class="sentence link-inline-list-item u-black--text"
            >
              みやメシ応援隊とは
            </a>
          </li>
          <li>
            <a
              href="https://note.com/miyameshi_ouen"
              target="_blank"
              rel="noopener"
              class="sentence link-inline-list-item u-black--text"
            >
              note
            </a>
          </li>
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
.footer-group-title {
  font-size: 1.5rem;
  font-weight: bolder;
  margin-bottom: 4px !important;
}

.link-inline-list {
  list-style: none;

  li {
    padding: 0 0.5rem;
  }

  li:first-child {
    padding: 0 0.5rem 0 0;
  }

  li:not(:last-child) {
    border-right: 1px solid;
  }
}

.link-inline-list-item {
  text-decoration: none;

  &:hover {
    text-decoration: underline;
  }
}

.sentence {
  font-size: 0.7rem;

  @include mq(sm) {
    font-size: 0.8rem;
  }
}

.miyameshi-wrapper {
  height: 200px;

  @include mq(md) {
    background: #fff;
    border-radius: 0.5rem;
    padding: 1rem;
  }
}

.prefix-title {
  font-weight: bolder;
}
</style>
