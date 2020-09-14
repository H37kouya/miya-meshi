<template>
  <footer
    class="pa-0"
  >
    <RecruitmentFooterField />

    <SearchField />

    <div class="d-md-flex justify-center">
      <div class="miya-meshi-container pt-md-8 pb-md-2">
        <MiyaMeshiFooterField />
      </div>

      <div class="ulab-container pt-md-8 pb-md-2">
        <UlabFooterField />
      </div>
    </div>

    <div class="d-none d-md-block sitemap-container pb-10">
      <v-container class="sitemap-wrapper">
        <h2 class="mb-2">サイトマップ</h2>

        <div>
          <ul class="d-flex link-inline-list">
            <li class="link-inline-list-item">
              <nuxt-link class="sentence text-decoration-none" to="/">トップページ</nuxt-link>
            </li>
            <li class="link-inline-list-item">
              <nuxt-link class="sentence text-decoration-none" to="/shops">店舗から探す</nuxt-link>
            </li>
            <li class="link-inline-list-item">
              <nuxt-link class="sentence text-decoration-none" to="/insta">インスタからのおすすめ</nuxt-link>
            </li>
            <li class="link-inline-list-item">
              <a
                class="sentence text-decoration-none"
                href="https://forms.gle/gAknXAaCrfsr8UdA8"
                target="_blank"
                rel="noopener"
              >
                お問い合わせ
              </a>
            </li>
          </ul>
        </div>
      </v-container>
    </div>

    <div class="copyright-container">
      <CopylightFooterField />
    </div>
  </footer>
</template>

<style lang="scss" scoped>
.miya-meshi-container {
  width: 100%;
  background-color: #fff;
  color: $u-black;
  padding: 0 0.5rem;

  @include mq(md) {
    color: #333;
    background-color: #EEECE5;
  }
}

.ulab-container {
  width: 100%;
  background-color: #333;
  color: #fff;
  padding: 0 0.5rem;

  @include mq(md) {
    color: #333;
    background-color: #EEECE5;
  }
}

.copyright-container {
  border-top: 1px #969696 solid;
  background-color: #333;
}

.sitemap-container {
  color: #333;
  background-color: #EEECE5;
}

.sitemap-wrapper {
  max-width: 904px;
}

.link-inline-list {
  list-style: none;
  padding-left: 0;

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
  font-size: 0.9rem;
  text-decoration: none;

  &:hover {
    text-decoration: underline;
  }
}

.sentence {
  color: #333 !important;
}

a.sentence {
  color: #333 !important;
}
</style>
