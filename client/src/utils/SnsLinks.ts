import { Shop } from '@/lib'

export type SnsLink = {
  name: string,
  href: string,
  src: string
}

enum snsImage {
  facebook = '/s/facebook.png',
  github = '/s/github.png',
  hp = '/s/hp.png',
  instagram = '/s/instagram.png',
  line = '/s/line.png',
  twitter = '/s/twitter.png',
  youtube = '/s/youtube.png',
  uberEats = '/s/UberEats_Badge_Vertical.png'
}

/**
 * Shopの配列からSnsLinkの配列を作成する
 *
 * @param { Shop } shop
 */
export const shopToSnsLinks = (shop: Shop): SnsLink[] => {
  const snsLinks = [] as SnsLink[]
  shop.instaLink && snsLinks.push({ name: 'instagram', href: shop.instaLink, src: snsImage.instagram })
  shop.twitterLink && snsLinks.push({ name: 'twitter', href: shop.twitterLink, src: snsImage.twitter })
  shop.uberEatsLink && snsLinks.push({ name: 'uberEats', href: shop.uberEatsLink, src: snsImage.uberEats })
  shop.homepageLink && snsLinks.push({ name: 'homepage', href: shop.homepageLink, src: snsImage.hp })
  shop.facebookLink && snsLinks.push({ name: 'facebook', href: shop.facebookLink, src: snsImage.facebook })
  shop.lineLink && snsLinks.push({ name: 'line', href: shop.lineLink, src: snsImage.line })
  shop.youtubeLink && snsLinks.push({ name: 'youtube', href: shop.youtubeLink, src: snsImage.youtube })
  return snsLinks
}
