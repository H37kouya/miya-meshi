import fs from 'fs'
import * as admin from 'firebase-admin'
import 'firebase/firestore'
import { Collection } from '../lib/enum/Collection'
const serviceAccount = require('../serviceAccount.json')
require('dotenv').config()

const BASE_URL = 'https://miyameshi.com'

admin.initializeApp({
  credential: admin.credential.cert(serviceAccount),
  databaseURL: process.env.FIREBASE_ADMIN_DATABASE_URL,
  projectId: process.env.FIREBASE_PROJECT_ID
})
const $fireStore = admin.firestore()

const xml = `<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:mobile="http://www.google.com/schemas/sitemap-mobile/1.0" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
{{ children }}
</urlset>`

const staticRoutes: readonly string[] = [
  '/',
  '/insta',
  '/shops',
  '/keywords/area',
  '/keywords/detail',
  '/about/miyameshi'
]

const shopRoutes = async (fireStore: FirebaseFirestore.Firestore): Promise<string[]> => {
  const _shops = await fireStore
    .collection(Collection.SHOPS)
    .where('public', '==', true)
    .get()

  const _routes = [] as string[]
  _shops.forEach((_shop) => {
    _routes.push(_shop.id)
  })

  return _routes.map((_route: string) => `/shops/${_route}`)
}

const areaRoutes = async (fireStore: FirebaseFirestore.Firestore): Promise<string[]> => {
  const _areas = await fireStore
    .collection(Collection.AREAS)
    .get()

  const _routes = [] as string[]
  _areas.forEach((_area) => {
    _routes.push(_area.id)
  })

  return _routes.map((_route: string) => `/shops/area/${_route}`)
}

const handler = async () => {
  const _shopRoutes = await shopRoutes($fireStore)
  const _areaRoutes = await areaRoutes($fireStore)

  const routes = [
    ...staticRoutes,
    ..._areaRoutes,
    ..._shopRoutes
  ]

  let xmlChildren = ''
  routes.forEach((_route: string) => {
    xmlChildren += `<url><loc>${BASE_URL}${_route}</loc></url>\n`
  })

  const writableXml = xml.replace('{{ children }}', xmlChildren)

  fs.writeFileSync('../assets/json/sitemap.json', JSON.stringify(routes, null, '\t'))
  fs.writeFileSync('../static/sitemap.xml', writableXml)
}

handler()
